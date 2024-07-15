<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('users.partials.import-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('User List') }}
                        </h3>

                        <!-- Export Button -->
                        <a href="{{ route('users.export') }}" class="btn btn-warning">
                            {{ __('Export User Data') }}
                        </a>
                    </div>

                    @include('users.partials.user-list', ['users' => $users])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
