<?php

namespace App\Http\Controllers;

use App\Models\InterventionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class InterventionRequestController extends Controller
{
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
            InterventionRequest::create([
                'employee_id' => Auth::user()->employee->id,
                'description' => $request->input('description'),
                'request_date' => $requestDate->format('Y-m-d'), // Format to Y-m-d
                'status' => $request->input('status'),
            ]);

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
            'status' => 'required|in:pending,approved,rejected',
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
                'status' => $request->input('status'),
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
}
