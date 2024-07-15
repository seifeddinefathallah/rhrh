<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Assigner des entités au département "{{ $departement->nom }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('departements.assign.entite', $departement->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="entites" class="form-label">Sélectionner des entités</label>
                            <select name="entites[]" id="entites" class="form-control" multiple required>
                                @foreach ($entites as $entite)
                                <option value="{{ $entite->id }}">{{ $entite->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Assigner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
