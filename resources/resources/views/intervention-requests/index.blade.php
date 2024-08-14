@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    
       
           
          
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Demandes d'Interventions</h2>
         
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
       
        @livewire('intervention-request-search')
        
                </div>
    </div>
</div>
@endsection
