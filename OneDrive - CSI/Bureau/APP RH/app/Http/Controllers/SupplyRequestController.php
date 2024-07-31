<?php

namespace App\Http\Controllers;

use App\Models\SupplyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\SupplyRequestCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupplyRequestStatusUpdated;

class SupplyRequestController extends Controller
{
    public function index()
    {
        $requests = SupplyRequest::all();
        return view('supply_requests.index', compact('requests'));
    }

    public function create()
    {
        return view('supply_requests.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->route('supply_requests.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Optionnel : Vous pouvez vérifier ici si l'utilisateur a un employé associé
            $employeeId = Auth::user()->employee->id;

            // Créez une nouvelle demande de fournitures
            $supplyRequest = SupplyRequest::create([
                'employee_id' => $employeeId, // Assurez-vous que ce champ est défini et valide
                'item_name' => $request->input('item_name'),
                'quantity' => $request->input('quantity'),
            ]);
            Mail::to($supplyRequest->employee->email_professionnel)
                ->send(new SupplyRequestCreated($supplyRequest));
            return redirect()->route('supply_requests.index')
                ->with('success', 'Supply request created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('supply_requests.create')
                ->with('error', 'Une erreur est survenue lors de la création de la demande: ' . $e->getMessage());
        }
    }

    public function show(SupplyRequest $supplyRequest)
    {
        return view('supply_requests.show', compact('supplyRequest'));
    }

    public function edit(SupplyRequest $supplyRequest)
    {
        return view('supply_requests.edit', compact('supplyRequest'));
    }

    public function update(Request $request, SupplyRequest $supplyRequest)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        $supplyRequest->update($request->all());

        return redirect()->route('supply_requests.index')
            ->with('success', 'Supply request updated successfully.');
    }

    public function destroy(SupplyRequest $supplyRequest)
    {
        $supplyRequest->delete();

        return redirect()->route('supply_requests.index')
            ->with('success', 'Supply request deleted successfully.');
    }
    public function approve(SupplyRequest $supplyRequest)
    {
        $supplyRequest->update(['status' => 'approved']);
        Mail::to($supplyRequest->employee->email_professionnel)
            ->send(new SupplyRequestStatusUpdated($supplyRequest));
        return redirect()->route('supply_requests.index')
            ->with('success', 'Supply request approved successfully.');
    }

    public function reject(SupplyRequest $supplyRequest)
    {
        $supplyRequest->update(['status' => 'rejected']);
        Mail::to($supplyRequest->employee->email_professionnel)
            ->send(new SupplyRequestStatusUpdated($supplyRequest));
        return redirect()->route('supply_requests.index')
            ->with('success', 'Supply request rejected successfully.');
    }
}

