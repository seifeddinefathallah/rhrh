@extends('layouts.app')

@section('content')
<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  

        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            {{ __('Authorization Requests') }}
        </h2>

        <!-- Include Vue.js from CDN -->
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

        <!-- Create Button Aligned to the Right -->
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
 
            <div class="p-6 bg-white border-b border-gray-200">
             

                @if ($message = Session::get('success'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: "success",
                            title: "{{ session('success') }}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
                </script>
                @endif

                <table class="table table-striped">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Start Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                End Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duration Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duration
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($authorizations as $authorization)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $authorization->type }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($authorization->start_date)->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($authorization->end_date)->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ ucfirst($authorization->duration_type) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $authorization->duration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($authorization->status === 'pending')
                                <span class="badge bg-label-warning me-1">{{ ucfirst($authorization->status) }}</span>
                                @elseif ($authorization->status === 'approved')
                                <span class="badge bg-label-success me-1">{{ ucfirst($authorization->status) }}</span>
                                @elseif ($authorization->status === 'rejected')
                                <span class="badge bg-label-danger">{{ ucfirst($authorization->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                   
                                        <a class="dropdown-item" href="{{ route('authorizations.show', $authorization->id) }}">
                                            <i class="bx bx-show me-1 text-success"></i> Show
                                        </a>
                               
                                        <a class="dropdown-item" href="{{ route('authorizations.edit', $authorization->id) }}">
                                            <i class="bx bx-edit-alt me-1 text-warning"></i> Edit
                                        </a>
                               
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $authorization->id }}">
                                            <i class="bx bx-trash me-1 text-danger"></i> Delete
                                        </a>
                                 
                                    </div>
                                </div>
                            
                                <!-- Modal de confirmation pour la suppression -->
                                <div class="modal fade" id="deleteModal{{ $authorization->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $authorization->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $authorization->id }}">Confirmer la suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="alert alert-danger alert-dismissible">
                                                Êtes-vous sûr de vouloir supprimer cette autorisation ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <form action="{{ route('authorizations.destroy', $authorization->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mb-3">
                    <a href="{{ route('authorizations.create') }}" class="btn btn-primary float-end">
                        {{ __('Créer une autorization') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
