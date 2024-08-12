<?php

namespace App\Http\Controllers;

use App\Mail\MaterialRequestStatusUpdated;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\MaterialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class LeaveRequestController extends Controller
{
    // Afficher la liste des demandes de congés
    public function index()
    {
        $leaveRequests = LeaveRequest::with('leaveType')->get();
        return view('leave_requests.index', compact('leaveRequests'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $leaveTypes = LeaveType::all();
        return view('leave_requests.create', compact('leaveTypes'));
    }

    // Stocker une nouvelle demande de congé
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
            $medicalCertificatePath = $request->file('medical_certificate')->store('medical_certificates');
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

        return redirect()->route('leave_requests.index')
            ->with('success', 'Demande de congé soumise avec succès. Vous avez 48 heures pour uploader le certificat médical.');
    }
    // Afficher le formulaire d'édition
    public function edit(LeaveRequest $leaveRequest)
    {
        $leaveTypes = LeaveType::all();
        return view('leave_requests.edit', compact('leaveRequest', 'leaveTypes'));
    }

    // Mettre à jour une demande de congé existante
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
            $medicalCertificatePath = $request->file('medical_certificate')->store('medical_certificates');
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

    // Supprimer une demande de congé
    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return redirect()->route('leave_requests.index')
            ->with('success', 'Demande de congé supprimée avec succès.');
    }
    public function approve(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update(['status' => 'approved']);

        return redirect()->route('leave_requests.index')->with('success', 'Request approved successfully.');
    }

    public function reject(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update(['status' => 'rejected']);
        return redirect()->route('leave_requests.index')->with('success', 'Request rejected successfully.');
    }
}
