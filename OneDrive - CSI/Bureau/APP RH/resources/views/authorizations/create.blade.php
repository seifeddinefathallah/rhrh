@extends('layouts.app')

@section('content')
  

    <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
        <div class=" container-xxl flex-grow-1 container-p-y">  
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200"> 
                     <h2 class="font-semibold text-xl text-center leading-tight mb-6" style="color: #03428e;">
        {{ __('Créer une autorisation') }}
    </h2>
                    <form action="{{ route('authorizations.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Authorization Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Choose authorization type</option>
                                <option value="Sortie">Sortie</option>
                                <option value="Télétravail">Télétravail</option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                            @error('start_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                            @error('end_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                            <input type="time" name="start_time" id="start_time" class="form-control">
                            @error('start_time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                            <input type="time" name="end_time" id="end_time" class="form-control">
                            @error('end_time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="duration_type" class="block text-sm font-medium text-gray-700">Duration Type</label>
                            <input type="text" name="duration_type" id="duration_type" class="form-control" readonly>
                            @error('duration_type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="duration" class="block text-sm font-medium text-gray-700">Duration (auto-calculated)</label>
                            <input type="text" name="duration" id="duration" class="form-control" readonly>
                            @error('duration')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="hidden" name="status" id="status" value="pending">

                        <div class="mt-4 d-flex justify-content-end gap-2"> 
                            <button type="submit" class="btn btn-primary">
                                {{ __('Créer une autorisation') }}
                            </button>
                            <a href="{{ route('authorizations.index') }}" class="btn btn-secondary float-end ">Retour  à la liste</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('type');
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const startTimeInput = document.getElementById('start_time');
            const endTimeInput = document.getElementById('end_time');
            const durationInput = document.getElementById('duration');
            const durationTypeInput = document.getElementById('duration_type');

            function calculateDuration() {
                const startDate = new Date(startDateInput.value + 'T' + startTimeInput.value);
                const endDate = new Date(endDateInput.value + 'T' + endTimeInput.value);
                const duration = endDate - startDate;
                const hours = Math.floor(duration / 3600000);
                const minutes = Math.floor((duration % 3600000) / 60000);

                if (typeSelect.value === 'Sortie') {
                    durationInput.value = `${hours} hours ${minutes} minutes`;
                    durationTypeInput.value = 'hours';
                    durationTypeInput.readOnly = true;
                } else if (typeSelect.value === 'Télétravail') {
                    if (startDate.toDateString() !== endDate.toDateString()) {
                        const days = Math.floor(duration / (24 * 3600000));
                        const remainingHours = Math.floor((duration % (24 * 3600000)) / 3600000);
                        durationInput.value = `${days} days ${remainingHours} hours`;
                        durationTypeInput.value = 'days';
                    } else {
                        if (hours === 4) {
                            durationInput.value = `4 hours`;
                            durationTypeInput.value = 'half day';
                        } else if (hours === 8) {
                            durationInput.value = `8 hours`;
                            durationTypeInput.value = 'full day';
                        } else {
                            durationInput.value = `${hours} hours ${minutes} minutes`;
                            durationTypeInput.value = '';
                        }
                    }
                    durationTypeInput.readOnly = true;
                } else {
                    durationInput.value = `${hours} hours ${minutes} minutes`;
                    durationTypeInput.value = '';
                    durationTypeInput.readOnly = false;
                }
            }

            function validateEndTime() {
                if (typeSelect.value === 'Sortie') {
                    const startDate = new Date(startDateInput.value + 'T' + startTimeInput.value);
                    const endDate = new Date(endDateInput.value + 'T' + endTimeInput.value);
                    const maxEndTime = new Date(startDate.getTime() + 2 * 60 * 60 * 1000);

                    if (endDate > maxEndTime) {
                        endTimeInput.value = startTimeInput.value;
                        alert('La durée de sortie ne peut pas dépasser 2 heures.');
                    }
                }
            }

            typeSelect.addEventListener('change', function () {
                if (typeSelect.value === 'Sortie') {
                    endDateInput.value = startDateInput.value;
                    endDateInput.readOnly = true;
                    durationTypeInput.value = 'hours';
                    durationTypeInput.readOnly = true;
                } else {
                    endDateInput.readOnly = false;
                    durationTypeInput.value = '';
                    durationTypeInput.readOnly = false;
                }
                calculateDuration();
            });

            startDateInput.addEventListener('change', function () {
                if (typeSelect.value === 'Sortie') {
                    endDateInput.value = startDateInput.value;
                }
                calculateDuration();
            });

            endDateInput.addEventListener('change', function () {
                validateEndTime();
                calculateDuration();
            });

            startTimeInput.addEventListener('change', function () {
                if (typeSelect.value === 'Sortie') {
                    validateEndTime();
                }
                calculateDuration();
            });

            endTimeInput.addEventListener('change', function () {
                if (typeSelect.value === 'Sortie') {
                    validateEndTime();
                }
                calculateDuration();
            });

            calculateDuration();
        });
    </script>
@endsection
