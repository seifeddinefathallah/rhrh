<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-xl font-bold mb-4">Update Temporary Balances</h1>

        <form method="POST" action="{{ route('temporary-balances.update') }}">
            @csrf
            <div class="mb-4">
                <label for="period" class="block text-sm font-medium text-gray-700">Période :</label>
                <select id="period" name="period" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="day">Jour</option>
                    <option value="month">Mois</option>
                    <option value="year">Année</option>
                    <!-- Ajouter d'autres périodes personnalisées si nécessaire -->
                </select>
            </div>

            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Date de début :</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin :</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="sortie_hours" class="block text-sm font-medium text-gray-700">Heures de sortie :</label>
                <input type="number" id="sortie_hours" name="sortie_hours" step="0.1" value="{{ old('sortie_hours') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="teletravail_days" class="block text-sm font-medium text-gray-700">Jours de télétravail :</label>
                <input type="number" id="teletravail_days" name="teletravail_days" step="0.1" value="{{ old('teletravail_days') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Enregistrer</button>
        </form>
    </div>
</x-app-layout>
