
@extends('layouts.app')

@section('content')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Les demandes') }}
                    </h2>
                    <div class="mb-4">
                        <a href="{{ route('loan_requests.create') }}" class="btn btn-success">Create Loan</a>
                    </div>
                    @livewire('loan-request-search')
                </div>
            </div>
        </div>
    </div>
@endsection
