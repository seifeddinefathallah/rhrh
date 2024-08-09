<!-- resources/views/leave_types/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Types de Congés</h1>
        <a href="{{ route('leave_types.create') }}" class="btn btn-primary mb-3">Créer un Nouveau Type de Congé</a>

        @if ($leaveTypes->isEmpty())
            <p>Aucun type de congé trouvé.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Max Jours</th>
                    <th>Certificat Médical Nécessaire</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($leaveTypes as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->max_days }}</td>
                        <td>
                            {{ $type->requires_medical_certificate ? 'Oui' : 'Non' }}
                        </td>
                        <td>
                            <a href="{{ route('leave_types.show', $type) }}" class="btn btn-info btn-sm">Afficher</a>
                            <a href="{{ route('leave_types.edit', $type) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('leave_types.destroy', $type) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de congé ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
