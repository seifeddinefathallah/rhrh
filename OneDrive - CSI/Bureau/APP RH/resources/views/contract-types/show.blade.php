@extends('layouts.app')

@section('content')
<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <h4 class="card-header" style="color: #03428e;  text-align: center;" >
                {{ __('Contract Type Details') }}
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="row">
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-body">
                    @if($contractType->name)
                        <div class="mb-4">
                            <strong class="text-gray-700">Name:</strong>
                            <p class="text-gray-600">{{ $contractType->name }}</p>
                        </div>
                    @endif
                    @if($contractType->description)
                        <div class="mb-4">
                            <strong class="text-gray-700">Description:</strong>
                            <p class="text-gray-600">{{ $contractType->description }}</p>
                        </div>
                    @endif
                    @if($contractType->country)
                        <div class="mb-4">
                            <strong class="text-gray-700">Country:</strong>
                            <p class="text-gray-600">{{ $contractType->country }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        

                        <!-- Basic -->
                        <div class="col-xl">
                            <div class="card mb-4">
                  
                        <div class="mb-4">
                    @if($contractType->classification)
                        <div class="mb-4">
                            <strong class="text-gray-700">Classification:</strong>
                            <p class="text-gray-600">{{ $contractType->classification }}</p>
                        </div>
                    @endif
                    @if($contractType->coefficient_min && $contractType->coefficient_max)
                        <div class="mb-4">
                            <strong class="text-gray-700">Coefficient Interval:</strong>
                            <p class="text-gray-600">{{ $contractType->coefficient_min }} - {{ $contractType->coefficient_max }}</p>
                        </div>
                    @endif
                    @if($contractType->probation_period)
                        <div class="mb-4">
                            <strong class="text-gray-700">Probation Period (months):</strong>
                            <p class="text-gray-600">{{ $contractType->probation_period }}</p>
                        </div>
                    @endif
                    @if(isset($contractType->renouvellement))
                        <div class="mb-4">
                            <strong class="text-gray-700">Renewal:</strong>
                            <p class="text-gray-600">{{ $contractType->renouvellement ? 'Yes' : 'No' }}</p>
                        </div>
                    @endif
                    @if($contractType->cdt_renouv)
                        <div class="mb-4">
                            <strong class="text-gray-700">CDT Renouv:</strong>
                            <p class="text-gray-600">{{ $contractType->cdt_renouv }}</p>
                        </div>
                    @endif
                </div>
            </div>
            
        </div>
        <div class="mt-4">     
                <a href="{{ route('contract-types.index') }}" class="btn btn-secondary float-end ">Retour</a>
                <a href="{{ route('contract-types.edit', $contractType->id) }}" class="btn btn-primary float-end">Sauvegarder</a>
        </div>
    </div>
</div>
@endsection
