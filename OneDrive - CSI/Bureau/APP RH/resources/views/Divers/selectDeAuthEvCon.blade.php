@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                    {{ __('Sélectionner une demande') }}
                </h2>

                <form id="selectDemandeForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700">Type de demande</label>
                        <select name="type" id="type" class="form-select mt-1 block w-full">
                            @foreach (\App\Models\Divers::TYPES as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-secondary float-end">Choisir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('selectDemandeForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting
    
        // Get the selected value
        const type = document.getElementById('type').value;
    
        // Determine the redirect URL based on the selected value
        let redirectUrl;
    
        switch (type) {
            case 'leave_requests':
                redirectUrl = '{{ route('leave_requests.index') }}';
                break;
            case 'authorizations':
                redirectUrl = '{{ route('authorizations.index') }}';
                break;
            case 'events':
                redirectUrl = '{{ route('events.index') }}';
                break;
            default:
                alert('Type de demande non reconnu');
                return;
        }
    
        // Redirect to the appropriate URL
        window.location.href = redirectUrl;
    });
    </script>
    
@endsection
