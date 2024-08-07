@extends('layouts.app')

@section('content')

<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y"> 
  
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
             
                <div>
                    <h2 class="font-semibold text-xl text-center leading-tight" style="color: #03428e;" >
                        {{ __(' Details') }}
                    </h2>
                    <div class="mt-5 row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" ><strong>Type:</strong></label>

                            <p>{{ $loanRequest->type }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" ><strong>Montant:</strong></label>
                            <p>{{ number_format($loanRequest->amount, 2) }} 
                                @if($loanRequest->currency === 'TND')
                                TND
                                @else
                                €
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Statut:</strong></label>
                            <p>
                                @if ($loanRequest->status === 'En attente')
                                <span class="badge bg-label-warning me-1">{{ ucfirst($loanRequest->status) }}</span>
                                @elseif ($loanRequest->status === 'Approuvé')
                                <span class="badge bg-label-success me-1">{{ ucfirst($loanRequest->status) }}</span>
                                @elseif ($loanRequest->status === 'Rejeté')
                                <span class="badge bg-label-danger me-1">{{ ucfirst($loanRequest->status) }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" ><strong>Commentaires:</strong></label>
                            <p>{{ $loanRequest->comments }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Date:</strong></label>
                            <p>{{ \Carbon\Carbon::parse($loanRequest->created_at)->format('Y-m-d') }}</p>
                        </div>

                        <div class="mb-4">
                            <a href="{{ route('loan_requests.index') }}" class="btn btn-secondary float-end">Retour à la liste</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
