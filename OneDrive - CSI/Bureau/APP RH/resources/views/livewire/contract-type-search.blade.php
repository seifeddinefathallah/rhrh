<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Search Form -->
            <input type="text" wire:model.debounce.300ms="search" placeholder="Rechercher par nom, description ou pays de contrat..." class="form-control form-control-navbar" aria-label="Search" />

            <!-- Table -->
            <div class="table-responsive mt-3">
                @if ($contractTypes->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Country</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contractTypes as $contractType)
                                <tr>
                                    <td>{{ $contractType->name }}</td>
                                    <td>{{ $contractType->description }}</td>
                                    <td>{{ $contractType->country }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('contract-types.show', $contractType->id) }}">
                                                    <i class="bx bx-show me-1 text-success"></i> Show
                                                </a>
                                                <a class="dropdown-item" href="{{ route('contract-types.edit', $contractType->id) }}">
                                                    <i class="bx bx-edit-alt me-1 text-warning"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $contractType->id }}">
                                                    <i class="bx bx-trash me-1 text-danger"></i> Delete
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $contractType->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $contractType->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $contractType->id }}">Confirm Delete</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="alert alert-danger alert-dismissible">
                                                        <p>Are you sure you want to delete this contract type?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('contract-types.destroy', $contractType->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
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

                    {{ $contractTypes->links() }} <!-- Pagination Links -->
                @else
                    <p class="text-center">Aucun type de contrat trouvé.</p>
                @endif
            </div>
        </div>
    </div>
</div>
