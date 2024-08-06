@extends('layouts.app')

@section('content')

<div class="layout-container" style="width: 85%; margin-left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
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
                    <button type="submit" class="btn btn-secondary float-end">Choisir </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('selectDemandeForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire

    // Récupère la valeur sélectionnée
    const type = document.getElementById('type').value;

    // Détermine l'URL de redirection en fonction de la valeur sélectionnée
    let redirectUrl;

    switch (type) {
        case 'intervention_requests':
            redirectUrl = '{{ route('intervention-requests.index') }}';
            break;
        case 'supply_requests':
            redirectUrl = '{{ route('supply_requests.index') }}';
            break;
        case 'material_requests':
            redirectUrl = '{{ route('material_requests.index') }}';
            break;
        case 'specific_requests':
            redirectUrl = '{{ route('specific_requests.index') }}';
            break;
        default:
            alert('Type de demande non reconnu');
            return;
    }

    // Redirige vers l'URL appropriée
    window.location.href = redirectUrl;
});
</script>

@endsection
