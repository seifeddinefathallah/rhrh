<!-- resources/views/authorizations/show.blade.php -->

@extends('layouts.app')

@section('content')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Authorization Details') }}
                    </h2>
                    <div class="mb-4">
                        <strong>Type:</strong> {{ $authorization->type }}
                    </div>

                    <div class="mb-4">
                        <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($authorization->start_date)->format('Y-m-d') }}
                    </div>

                    <div class="mb-4">
                        <strong>End Date:</strong> {{ \Carbon\Carbon::parse($authorization->end_date)->format('Y-m-d') }}
                    </div>

                    <div class="mb-4">
                        <strong>Duration Type:</strong> {{ ucfirst($authorization->duration_type) }}
                    </div>

                    @if ($authorization->duration_type === 'half_day')
                    <div class="mb-4">
                        <strong>Duration:</strong> 4 hours
                    </div>
                    @elseif ($authorization->duration_type === 'hours' || $authorization->duration_type === 'half_hours')
                    <div class="mb-4">
                        <strong>Duration:</strong> {{ $authorization->duration }}
                    </div>
                    @endif

                    <div class="mb-4">
                        <strong>Status:</strong>
                        @if ($authorization->status === 'pending')
                        <span class="badge badge-warning">{{ ucfirst($authorization->status) }}</span>
                        @elseif ($authorization->status === 'approved')
                        <span class="badge badge-success">{{ ucfirst($authorization->status) }}</span>
                        @elseif ($authorization->status === 'rejected')
                        <span class="badge badge-danger">{{ ucfirst($authorization->status) }}</span>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
