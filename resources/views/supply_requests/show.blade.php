@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
       
    <div class="container-xl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg">
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Supply Request Details</h2>
        <p><strong>Item Name:</strong> {{ $supplyRequest->item_name }}</p>
        <p><strong>Quantity:</strong> {{ $supplyRequest->quantity }}</p>
        <p>
               <strong>Status: </strong> 
               @if($supplyRequest->status === 'pending')
               <span class="badge bg-label-warning me-1">{{ ucfirst($supplyRequest->status) }}</span>
           @elseif($supplyRequest->status === 'approved')
               <span class="badge bg-label-success me-1">{{ ucfirst($supplyRequest->status) }}</span>
           @elseif($request->status === 'rejected')
               <span class="badge bg-label-danger">{{ ucfirst($supplyRequest->status) }}</span>
           @endif
              
            
        </p>
        <div class="mt-4"> 
        <a href="{{ route('supply_requests.index') }}" class="btn btn-secondary float-end" >Retour</a>
    </div>
    </div>
</div>
</div>
@endsection
