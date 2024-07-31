@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg"> 
            
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Demandes d'Interventions</h2>
        
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
       
        @livewire('intervention-request-search')
        
        <div class="mb-3">
           <a href="{{ route('intervention-requests.create') }}" class="btn btn-primary float-end">Ajouter une demande</a>
        </div>
    </div>
@endsection
