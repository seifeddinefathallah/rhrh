<!-- resources/views/partials/users/import-form.blade.php -->
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Upload Users') }}
        </h2>
    </header>

    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center space-x-3">
            <input type="file" name="file" class="form-control">
            <button type="submit" class="btn btn-success">{{ __('Import User Data') }}</button>
        </div>
    </form>

    <x-modal name="import-status" :show="$errors->import->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('users.import') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Import Status') }}
            </h2>

            @if ($errors->import->any())
            <ul class="mt-3 text-sm text-red-600">
                @foreach ($errors->import->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <div class="mt-6 flex justify-end space-x-4">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Close') }}
                </x-secondary-button>

                <button type="submit" class="btn btn-success">
                    {{ __('Retry') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
