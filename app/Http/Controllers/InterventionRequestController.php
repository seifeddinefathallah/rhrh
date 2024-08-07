<?php

namespace App\Http\Controllers;

use App\Models\InterventionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Mail\InterventionRequestCreated;
use App\Mail\InterventionRequestApproved;
use App\Mail\InterventionRequestRejected;
use Illuminate\Support\Facades\Mail;


class InterventionRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $requests = InterventionRequest::all();
        return view('intervention-requests.index', compact('requests'));
    }

    public function create()
    {
        return view('intervention-requests.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'request_date' => 'required|date',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        if ($validator->fails()) {
            return redirect()->route('intervention-requests.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Parse request_date to Carbon instance
            $requestDate = Carbon::parse($request->input('request_date'));

            // Create a new intervention request
            $interventionRequest = InterventionRequest::create([
                'employee_id' => Auth::user()->employee->id,
                'description' => $request->input('description'),
                'request_date' => $requestDate->format('Y-m-d'), // Format to Y-m-d
                'status' => $request->input('status'),
            ]);
            Mail::to($interventionRequest->employee->email_professionnel)->send(new InterventionRequestCreated($interventionRequest));
            return redirect()->route('intervention-requests.index')
                ->with('success', 'Demande d\'intervention créée avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('intervention-requests.create')
                ->with('error', 'Une erreur est survenue lors de la création de la demande: ' . $e->getMessage());
        }
    }

    public function edit(InterventionRequest $interventionRequest)
    {
        return view('intervention-requests.edit', compact('interventionRequest'));
    }

    public function update(Request $request, InterventionRequest $interventionRequest)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'request_date' => 'required|date',

        ]);

        if ($validator->fails()) {
            return redirect()->route('intervention-requests.edit', $interventionRequest)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Parse request_date to Carbon instance
            $requestDate = Carbon::parse($request->input('request_date'));

            // Update the intervention request
            $interventionRequest->update([
                'description' => $request->input('description'),
                'request_date' => $requestDate->format('Y-m-d'),

            ]);

            return redirect()->route('intervention-requests.index')
                ->with('success', 'Demande d\'intervention mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('intervention-requests.edit', $interventionRequest)
                ->with('error', 'Une erreur est survenue lors de la mise à jour de la demande: ' . $e->getMessage());
        }
    }

    public function destroy(InterventionRequest $interventionRequest)
    {
        $interventionRequest->delete();

        return redirect()->route('intervention-requests.index')
            ->with('success', 'Demande d\'intervention supprimée avec succès.');
    }
    public function approve(InterventionRequest $interventionRequest)
    {
        try {
            $interventionRequest->update(['status' => 'approved']);
            Mail::to($interventionRequest->employee->email_professionnel)->send(new InterventionRequestApproved($interventionRequest));
            return redirect()->route('intervention-requests.index')
                ->with('success', 'Demande d\'intervention approuvée avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('intervention-requests.index')
                ->with('error', 'Une erreur est survenue lors de l\'approbation de la demande: ' . $e->getMessage());
        }
    }

    public function reject(InterventionRequest $interventionRequest)
    {
        try {
            $interventionRequest->update(['status' => 'rejected']);
            Mail::to($interventionRequest->employee->email_professionnel)->send(new InterventionRequestRejected($interventionRequest));
            return redirect()->route('intervention-requests.index')
                ->with('success', 'Demande d\'intervention rejetée avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('intervention-requests.index')
                ->with('error', 'Une erreur est survenue lors du rejet de la demande: ' . $e->getMessage());
        }
    }
}
