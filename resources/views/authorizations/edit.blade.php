<!-- resources/views/authorizations/edit.blade.php -->
        @extends('layouts.app')

        @section('content')
        <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
            <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="card-header text-center" style="color: #03428e;">
            {{ __('Edit Authorization Request') }}
           </h4>

                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('authorizations.update', $authorization->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <input type="text" name="type" id="type" value="{{ old('type', $authorization->type) }}" class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                            @error('type')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $authorization->start_date) }}" class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                            @error('start_date')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $authorization->end_date) }}" class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                            @error('end_date')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
