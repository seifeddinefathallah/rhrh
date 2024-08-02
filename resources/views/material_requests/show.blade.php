@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg">    
    <h1>Material Request Details</h1>
        <p><strong>Material Name:</strong> {{ $materialRequest->material_name }}</p>
        <p><strong>Description:</strong> {{ $materialRequest->description }}</p>
        <p><strong>Quantity:</strong> {{ $materialRequest->quantity }}</p>
        <p><strong>Status:</strong> {{ $materialRequest->status }}</p>
    </div>
@endsection
