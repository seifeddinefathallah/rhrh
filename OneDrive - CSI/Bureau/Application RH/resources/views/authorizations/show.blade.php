@extends('layouts.app')

@section('content')

<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
            <h4 class="card-header text-center" style="color: #03428e;">
                {{ __('Authorization Details') }}
            </h4>
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Informations d'Autorisation -->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Type:</strong></label>
                                    <p>{{ $authorization->type }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Start Date:</strong></label>
                                    <p>{{ \Carbon\Carbon::parse($authorization->start_date)->format('Y-m-d') }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>End Date:</strong></label>
                                    <p>{{ \Carbon\Carbon::parse($authorization->end_date)->format('Y-m-d') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Duration Type:</strong></label>
                                    <p>{{ ucfirst($authorization->duration_type) }}</p>
                                </div>
                                @if ($authorization->duration_type === 'half_day')
                                <div class="mb-3">
                                    <label class="form-label"><strong>Duration:</strong></label>
                                    <p>4 hours</p>
                                </div>
                                @elseif ($authorization->duration_type === 'hours' || $authorization->duration_type === 'half_hours')
                                <div class="mb-3">
                                    <label class="form-label"><strong>Duration:</strong></label>
                                    <p>{{ $authorization->duration }}</p>
                                </div>
                                @endif
                                <div class="mb-3">
                                    <label class="form-label"><strong>Status:</strong></label>
                                    <p>
                                        @if ($authorization->status === 'pending')
                                        <span class="badge bg-label-warning me-1">{{ ucfirst($authorization->status) }}</span>
                                        @elseif ($authorization->status === 'approved')
                                        <span class="badge bg-label-success me-1">{{ ucfirst($authorization->status) }}</span>
                                        @elseif ($authorization->status === 'rejected')
                                        <span class="badge bg-label-danger me-1">{{ ucfirst($authorization->status) }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bouton de retour -->
                <div class="mt-4 ">
                    <a href="{{ route('authorizations.index') }}" class="btn btn-primary float-end">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
