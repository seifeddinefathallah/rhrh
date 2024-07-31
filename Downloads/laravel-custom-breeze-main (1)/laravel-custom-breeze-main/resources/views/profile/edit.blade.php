   @extends('layouts.app')

    @section('content')
   
    <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
            <div class=" container-xxl flex-grow-1 container-p-y"> 
                   <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                             {{ __('Profile') }}
                   </h2>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Add the button here -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <a href="{{ route('profile.generate-pdf') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Generate PDF') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
