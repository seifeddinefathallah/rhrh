<?php

namespace App\Http\Controllers;


use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use App\Services\HolidayService; // Importer le service HolidayService
use Berkayk\OneSignal\OneSignalFacade as OneSignal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveRequestRejected;
use App\Mail\LeaveRequestApproved;
use App\Mail\LeaveRequestCreated;

class LeaveRequestController extends Controller
{
    protected $holidayService;

    public function __construct(HolidayService $holidayService)
    {
        $this->middleware('auth');
        $this->holidayService = $holidayService; // Injecter le service HolidayService
    }

    public function index()
    {
        $totalApproved = LeaveRequest::where('status', 'approved')->count();

        $pendingByType = \DB::table('leave_requests')
            ->join('leave_types', 'leave_requests.leave_type_id', '=', 'leave_types.id')
            ->where('leave_requests.status', 'pending')
            ->select('leave_types.name', \DB::raw('count(*) as total'))
            ->groupBy('leave_types.name')
            ->get()
            ->keyBy('name');

        $leaveTypes = \DB::table('leave_types')->select('name')->get();

        $pendingByTypeWithNames = [];

        foreach ($leaveTypes as $leaveType) {
            $pendingByTypeWithNames[] = [
                'name' => $leaveType->name,
                'total' => $pendingByType->has($leaveType->name) ? $pendingByType[$leaveType->name]->total : 0,
            ];
        }

        return view('leave_requests.index', compact('totalApproved', 'pendingByTypeWithNames'));
    }

    /*public function create()
    {
        $leaveTypes = LeaveType::all();
        return view('leave_requests.create', compact('leaveTypes'));
    }*/

    public function create()
    {
        // Remplacez 1 par l'ID de l'employé connecté
        $employeeId = auth()->user()->id;

        $leaveTypes = LeaveType::all();
        $leaveBalances = LeaveBalance::where('employee_id', $employeeId)->get();

        return view('leave_requests.create', compact('leaveTypes', 'leaveBalances'));
    }

    public function store(Request $request)
    {
        $leaveType = LeaveType::find($request->leave_type_id);

        if (!$leaveType) {
            return redirect()->back()->withErrors(['leave_type_id' => 'Type de congé invalide.']);
        }

        $rules = [
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
        ];

        if ($leaveType->requires_medical_certificate) {
            $rules['medical_certificate'] = 'nullable|file|mimes:pdf,jpeg,png|max:2048';
        }

        $request->validate($rules);

        $medicalCertificatePath = null;
        if ($request->hasFile('medical_certificate')) {
            $medicalCertificatePath = $request->file('medical_certificate')->store('public/medical_certificates');
        }

        $certificateUploadDeadline = null;
        if ($leaveType->requires_medical_certificate) {
            $certificateUploadDeadline = now()->addHours(48);
        }

        $leaveRequest = LeaveRequest::create([
            'employee_id' => Auth::user()->employee->id,
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'medical_certificate' => $medicalCertificatePath,
            'certificate_upload_deadline' => $certificateUploadDeadline,
        ]);
        Mail::to($leaveRequest->employee->user->email)->send(new LeaveRequestCreated($leaveRequest));
        return redirect()->route('leave_requests.index')
            ->with('success', 'Demande de congé soumise avec succès. Vous avez 48 heures pour uploader le certificat médical.');
    }

    public function edit(LeaveRequest $leaveRequest)
    {
        $leaveTypes = LeaveType::all();
        return view('leave_requests.edit', compact('leaveRequest', 'leaveTypes'));
    }

    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $leaveType = LeaveType::findOrFail($request->leave_type_id);

        $rules = [
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
        ];

        if ($leaveType->requires_medical_certificate) {
            $rules['medical_certificate'] = 'nullable|file|mimes:pdf,jpeg,png|max:2048';
        }

        $request->validate($rules);

        $medicalCertificatePath = $leaveRequest->medical_certificate;
        if ($request->hasFile('medical_certificate')) {
            $medicalCertificatePath = $request->file('medical_certificate')->store('public/medical_certificates');
        }

        $leaveRequest->update([
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'medical_certificate' => $medicalCertificatePath,
        ]);

        return redirect()->route('leave_requests.index')
            ->with('success', 'Demande de congé mise à jour avec succès.');
    }

    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return redirect()->route('leave_requests.index')
            ->with('success', 'Demande de congé supprimée avec succès.');
    }

    public function approve(LeaveRequest $leaveRequest)
    {
        try {
            $startDate = Carbon::parse($leaveRequest->start_date);
            $endDate = Carbon::parse($leaveRequest->end_date);
            $duration = $startDate->diffInDays($endDate) + 1;

            $leaveType = $leaveRequest->leaveType;
            $employee = $leaveRequest->employee;

            $leaveBalance = LeaveBalance::where('employee_id', $employee->id)
                ->where('leave_type_id', $leaveType->id)
                ->first();

            if (!$leaveBalance || $leaveBalance->remaining_days < $duration) {
                return redirect()->route('leave_requests.index')
                    ->withErrors('Insufficient leave balance for this leave type.');
            }

            // Calculate holidays within the leave period
            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
                if ($this->holidayService->isHoliday($currentDate)) {
                    $duration--; // Reduce duration if it's a holiday
                }
                $currentDate->addDay();
            }

            // Update the leave request status to 'approved'
            $leaveRequest->update(['status' => 'approved']);

            // Decrease the remaining balance of the leave type
            $leaveBalance->remaining_days -= $duration;
            $leaveBalance->save();
            Mail::to($leaveRequest->employee->user->email)->send(new LeaveRequestApproved($leaveRequest));
            $notificationMessageForApproval = "Demande de congé approuvée.";
            $employeeSubscriptions = DB::table('push_subscriptions')
                ->where('user_id', $employee->user_id)
                ->pluck('subscription_id')
                ->toArray();

            $this->sendOneSignalNotification_($notificationMessageForApproval, $employeeSubscriptions, 'approved');

            return redirect()->route('leave_requests.index')
                ->with('success', 'Request approved successfully. Leave balance updated.');
        } catch (\Exception $e) {
            return redirect()->route('leave_requests.index')
                ->with('error', 'Une erreur est survenue lors de l\'approbation de la demande: ' . $e->getMessage());
        }
    }

    public function reject(LeaveRequest $leaveRequest)
    {
        try {
            $leaveRequest->update(['status' => 'rejected']);
            Mail::to($leaveRequest->employee->user->email)->send(new LeaveRequestRejected($leaveRequest));
            $notificationMessageForRejection = "Demande de congé rejetée.";
            $employeeSubscriptions = DB::table('push_subscriptions')
                ->where('user_id', $leaveRequest->employee->user_id)
                ->pluck('subscription_id')
                ->toArray();

            $this->sendOneSignalNotification_($notificationMessageForRejection, $employeeSubscriptions, 'rejected');
            return redirect()->route('leave_requests.index')
                ->with('success', 'Demande d\'intervention rejetée avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('leave_requests.index')
                ->with('error', 'Une erreur est survenue lors du rejet de la demande: ' . $e->getMessage());
        }
    }
    public function dashboard()
    {
        try {
            // Récupérer l'identifiant de l'employé connecté
            $employeeId = Auth::user()->employee->id; // ou Auth::user()->id si vous utilisez une autre méthode pour obtenir l'ID

            // Log de l'identifiant de l'employé connecté
            Log::info('Récupération des jours restants pour l\'employé avec ID: ' . $employeeId);

            // Récupérer les jours restants pour l'employé connecté avec les noms des types de congé
            $leaveBalances = LeaveBalance::where('employee_id', $employeeId)
                ->join('leave_types', 'leave_balances.leave_type_id', '=', 'leave_types.id')
                ->select('leave_types.name', 'leave_balances.remaining_days')
                ->get();

            // Log du nombre de jours restants récupérés
            Log::info('Nombre de jours restants récupérés: ' . $leaveBalances->count());

            // Log des données récupérées
            Log::info('Jours restants récupérés: ', $leaveBalances->toArray());

            return view('dashboard', compact('leaveBalances'));
        } catch (\Exception $e) {
            // Log des erreurs éventuelles
            Log::error('Erreur lors de la récupération des jours restants: ' . $e->getMessage());

            // Vous pouvez également retourner une vue d'erreur ou rediriger l'utilisateur
            return redirect()->back()->withErrors('Une erreur est survenue lors de la récupération des jours restants.');
        }
    }
    public function getApprovedLeaveRequests()
    {
        Log::info('Méthode getApprovedLeaveRequests appelée');
        try {
            // Récupérer l'ID de l'employé connecté
            $employeeId = Auth::user()->employee->id;

            // Log de l'identifiant de l'employé connecté
            Log::info('Récupération des jours restants pour l\'employé avec ID: ' . $employeeId);

            // Récupérer les demandes de congés approuvées pour l'employé connecté
            $approvedRequests = LeaveRequest::where('leave_requests.status', 'approved')
                ->where('leave_requests.employee_id', $employeeId)
                ->join('leave_types', 'leave_requests.leave_type_id', '=', 'leave_types.id')
                ->select('leave_requests.*', 'leave_types.name as leave_type_name', 'leave_types.id as leave_type_id')
                ->get();

            Log::info('Nombre de demandes récupérées: ' . $approvedRequests->count());

            // Fonction pour générer une couleur basée sur l'ID
            function generateColorFromId($id) {
                $colors = [
                    '#93c3fd', '#00b5cc', '#fdb913', '#F25757', '#912b6a', '#0570f2',
                    '#ff7f7f', '#7fff7f', '#7f7fff', '#ffff7f', '#ff7fff', '#7fffff'
                ];
                return $colors[$id % count($colors)];
            }

            $events = $approvedRequests->map(function ($request) {
                // Assigner une couleur basée sur l'ID du type de congé
                $backgroundColor = generateColorFromId($request->leave_type_id);

                return [
                    'id' => $request->id,
                    'title' => $request->leave_type_name,
                    'start' => $request->start_date->toDateString(),
                    'end' => $request->end_date->toDateString(),
                    'backgroundColor' => $backgroundColor // Utiliser la couleur générée
                ];
            });

            return response()->json($events);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des demandes de congés approuvées: ' . $e->getMessage());
            return response()->json(['error' => 'Une erreur est survenue.'], 500);
        }
    }


    // Method to generate the create leave request URL with a specific start date
    public function generateCreateRequestUrl(Request $request)
    {
        $startDate = $request->query('start');
        return response()->json([
            'url' => route('leave_requests.create') . '?start=' . urlencode($startDate),
        ]);
    }

    // LeaveRequestController.php
    public function showPendingByType($name)
    {
        $leaveType = LeaveType::where('name', $name)->first();

        if (!$leaveType) {
            abort(404, 'Type de congé non trouvé');
        }

        $leaveRequests = LeaveRequest::with('employee', 'leaveType') // Eager load relationships
        ->where('leave_type_id', $leaveType->id)
            ->where('status', 'pending')
            ->get();

        return view('leave_requests.pending_by_type', [
            'leaveRequests' => $leaveRequests,
            'name' => $name
        ]);
    }
}
