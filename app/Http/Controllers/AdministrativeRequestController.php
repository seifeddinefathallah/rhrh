<?php

// app/Http/Controllers/AdministrativeRequestController.php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\SpecificRequest;
use Illuminate\Http\Request;
use App\Models\AdministrativeRequest;
use App\Models\Employee;
use App\Http\Requests\CreateAdministrativeRequestRequest;
use App\Http\Requests\UpdateAdministrativeRequestRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAdministrativeRequestNotification;
use App\Mail\UpdateAdministrativeRequestStatusNotification;
use App\Services\PdfService;
use App\Mail\DocumentMail;
use Illuminate\Support\Facades\Auth;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;
use App\Models\PushSubscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Berkayk\OneSignal\OneSignalClient;

class AdministrativeRequestController extends Controller
{
    protected $pdfService;
    protected $oneSignal;

    public function index()
    {
        $approvedCount = AdministrativeRequest::where('status', 'approuvé')->count();
        $rejectedCount = AdministrativeRequest::where('status', 'rejeté')->count();
        $pendingCount = AdministrativeRequest::where('status', 'En attente')->count();

        $requests = AdministrativeRequest::latest()->paginate(10);
        return view('requests.index', compact('requests',  'approvedCount', 'pendingCount', 'rejectedCount'));
    }

    public function requestsByStatus($status)
    {
        $statusMap = [
            'approved' => 'approuvé',
            'pending' => 'en attente',
            'rejected' => 'rejeté',
        ];

        $statusValue = $statusMap[$status] ?? null;

        if (!$statusValue) {
            abort(404, 'Status not found');
        }

        $requests = AdministrativeRequest::where('status', $statusValue)->latest()->paginate(10);

        return view('requests.by_status', compact('requests', 'status'));
    }

    public function create()
    {
        $employee = Auth::user()->employee;
        return view('requests.create', compact('employee'));
    }

    public function store(CreateAdministrativeRequestRequest $request)
    {
        $validatedData = $request->validated();

        // Assurez-vous que vous ajoutez les informations de l'employé
        $validatedData['employee_id'] = Auth::user()->employee->id;

        $demande = AdministrativeRequest::create($validatedData);

        // Récupérer l'employé associé à la demande
        $employee = Employee::findOrFail($request->employee_id);

        // Envoyer l'e-mail de notification pour la création de la demande
        Mail::to($employee->email_professionnel)->send(new NewAdministrativeRequestNotification($employee, $demande));

        $notificationMessageForEmployee = "Demande administrative créée avec succès : {$request->type}";

        // Retrieve all subscription IDs for the employee
        $employeeSubscriptions = DB::table('push_subscriptions')
            ->where('user_id', $employee->user_id)
            ->pluck('subscription_id')
            ->toArray();

        // Send push notifications to all subscription IDs
        $this->sendOneSignalNotification($notificationMessageForEmployee, $employeeSubscriptions);
            return redirect()->route('requests.index')->with('success', 'Demande administrative créée avec succès.');
    }
    protected function sendOneSignalNotification($message, array $subscriptionIds)
    {
        try {
            if (empty($subscriptionIds)) {
                Log::warning('No subscriptions found.');
                return;
            }
            $appUrl = config('app.url');
            $route = 'requests';
            $notificationUrl = "{$appUrl}/{$route}";
            foreach ($subscriptionIds as $subscriptionId) {
                $response = OneSignal::sendNotificationToUser(
                    $message,
                    $subscriptionId,
                    $url = $notificationUrl
                );

                Log::info('Notification sent successfully to subscription ID: ' . $subscriptionId, [
                    'response' => $response
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Error sending notification: ' . $e->getMessage());
        }
    }

    public function edit(AdministrativeRequest $request)
    {
        $employees = Employee::all();
        return view('requests.edit', compact('request', 'employees'));
    }

    public function update(Request $request, AdministrativeRequest $administrativeRequest)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $oldStatus = $administrativeRequest->status;
        $administrativeRequest->update($request->all());

        $employee = $administrativeRequest->employee;

        if ($administrativeRequest->status !== $oldStatus) {
            if ($administrativeRequest->status === 'approuvé') {
                $data = [
                    'title' => 'Document approuvé',
                    'content' => 'Votre document a été approuvé.',
                ];

                // Sélectionnez la vue PDF en fonction du type de demande et du pays de l'employé
                $viewName = $this->getViewNameForRequestType($administrativeRequest->type, $employee->pays, $employee->id);

                $pdf = $this->pdfService->generatePdf($data, $viewName);

                Mail::to($employee->email_professionnel)->send(new DocumentMail($employee, $administrativeRequest, $pdf));
            } else {
                Mail::to($employee->email_professionnel)->send(new UpdateAdministrativeRequestStatusNotification($employee, $administrativeRequest));
            }
        }

        return redirect()->route('requests.index')->with('success', 'Statut de la demande administrative mis à jour avec succès.');
    }

    private function getViewNameForRequestType($type, $country, $employeeId)
    {
        $employee = Employee::find($employeeId); // Récupérer l'employé depuis la base de données

        if (!$employee) {
            abort(404, 'Employé non trouvé');
        }

        if ($type == 'Attestation de travail') {
            if ($country == 'TN') {
                return view('pdf.att_tra_tun', ['employee' => $employee]);
            } elseif ($country == 'FR') {
                return view('pdf.att_tra_fr', ['employee' => $employee]);
            }
        } elseif ($type == 'Attestation de salaire') {
            if ($country == 'TN') {
                return view('pdf.att_sal_tun', ['employee' => $employee]);
            } elseif ($country == 'FR') {
                return view('pdf.att_sal_fr', ['employee' => $employee]);
            }
        }

        // Ajouter d'autres types de demande et pays ici si nécessaire

        // Retourner une vue par défaut si aucun cas ne correspond
        return view('pdf.default', ['employee' => $employee]);
    }


    public function destroy(AdministrativeRequest $request)
    {
        $request->delete();
        return redirect()->route('requests.index')->with('success', 'Demande administrative supprimée avec succès.');
    }
    public function __construct(PdfService $pdfService, OneSignalClient $oneSignal)
    {
        $this->oneSignal = $oneSignal;
        $this->pdfService = $pdfService;
        $this->middleware('auth');
    }

    public function approveRequest($id)
    {
        $administrativeRequest = AdministrativeRequest::findOrFail($id);

        if ($administrativeRequest->status != 'approuvé') {
            $administrativeRequest->status = 'approuvé';
            $administrativeRequest->save();

            $employee = $administrativeRequest->employee;

            $data = [
                'title' => 'Document approuvé',
                'content' => 'Votre document a été approuvé.',
            ];

            $viewName = $this->getViewNameForRequestType($administrativeRequest->type, $employee->pays, $employee->id);
            $pdf = $this->pdfService->generatePdf($data, $viewName);

            Mail::to($employee->email_professionnel)->send(new DocumentMail($employee, $administrativeRequest, $pdf));

            $notificationMessageForApproval = "Your administrative request has been approved.";
            $employeeSubscriptions = DB::table('push_subscriptions')
                ->where('user_id', $employee->user_id)
                ->pluck('subscription_id')
                ->toArray();

            $this->sendOneSignalNotification_($notificationMessageForApproval, $employeeSubscriptions, 'approved');

            return redirect()->route('requests.index')->with('success', 'Demande approuvée avec succès.');
        }

        return redirect()->route('requests.index')->with('error', 'La demande est déjà approuvée.');
    }

    public function rejectRequest($id)
    {
        $administrativeRequest = AdministrativeRequest::findOrFail($id);

        if ($administrativeRequest->status != 'rejeté') {
            $administrativeRequest->status = 'rejeté';
            $administrativeRequest->save();

            $employee = $administrativeRequest->employee;

            Mail::to($employee->email_professionnel)->send(new UpdateAdministrativeRequestStatusNotification($employee, $administrativeRequest));

            $notificationMessageForRejection = "Your administrative request has been rejected.";
            $employeeSubscriptions = DB::table('push_subscriptions')
                ->where('user_id', $employee->user_id)
                ->pluck('subscription_id')
                ->toArray();

            $this->sendOneSignalNotification_($notificationMessageForRejection, $employeeSubscriptions, 'rejected');


            return redirect()->route('requests.index')->with('success', 'Demande rejetée avec succès.');
        }

        return redirect()->route('requests.index')->with('error', 'La demande est déjà rejetée.');
    }

    protected function sendOneSignalNotification_($message, array $subscriptionIds, $status)
    {
        try {
            if (empty($subscriptionIds)) {
                Log::warning('No subscriptions found.');
                return;
            }

            // Define the URL to which the user will be redirected when they click the notification
            $appUrl = config('app.url'); // Fetch the APP_URL from .env

            // Set route based on status
            $route = $status === 'approved' ? 'requests.approved' : 'requests.rejected'; // Replace with actual route names
            $notificationUrl = "{$appUrl}/{$route}"; // Construct the full URL

            foreach ($subscriptionIds as $subscriptionId) {
                $response = OneSignal::sendNotificationToUser(
                    $message,
                    $subscriptionId,
                    $url = $notificationUrl // Add the URL parameter
                );

                Log::info('Notification sent successfully to subscription ID: ' . $subscriptionId, [
                    'response' => $response
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Error sending notification: ' . $e->getMessage());
        }
    }

}
