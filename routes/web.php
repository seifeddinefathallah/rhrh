<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImportEmployeeController;
use App\Http\Controllers\AdministrativeRequestController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EntiteController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\AuthorizationRequestController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\ApprovalHistoryController;
use App\Http\Controllers\PlayerIdController;

Route::get('/', function () {
    connectify('success', 'Connection Found', 'Connected');
    return view('welcome');
});

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'twostep'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('users');
        Route::get('users-export', 'export')->name('users.export');
        Route::post('users-import', 'import')->name('users.import');
    });
});
Route::get('/profile/generate-pdf', [ProfileController::class, 'generatePDF'])->name('profile.generate-pdf');
Route::post('/save-player-id', function (Request $request) {
    $user = Auth::user();
    if ($user) {
        $user->onesignal_player_id = $request->player_id;
        $user->save();
    }

    return response()->json(['status' => 'Player ID saved']);
});
Route::get('generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF']);
Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index')->name('users');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});


Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
Route::post('employees/import', [EmployeeController::class, 'import'])->name('employees.import');
Route::get('/employees/export', [EmployeeController::class, 'export'])->name('employees.export');
Route::get('/entites/{entite}/departements', [EmployeeController::class, 'getDepartementsByEntite']);
Route::get('/departements/{departement}/postes', [EmployeeController::class, 'getPostesByDepartement']);
Route::get('/countries', [EmployeeController::class, 'getCountries'])->name('countries');
Route::get('/cities/{country}', [EmployeeController::class, 'getCitiesByCountry'])->name('cities.by.country');

Route::get('/requests', [AdministrativeRequestController::class, 'index'])->name('requests.index');
//Route::get('/requests/create', [AdministrativeRequestController::class, 'create'])->name('requests.create');
//Route::post('/requests', [AdministrativeRequestController::class, 'store'])->name('requests.store');
Route::get('/requests/{request}/edit', [AdministrativeRequestController::class, 'edit'])->name('requests.edit');
Route::put('/requests/{administrativeRequest}', [AdministrativeRequestController::class, 'update'])->name('requests.update');
Route::delete('/requests/{request}', [AdministrativeRequestController::class, 'destroy'])->name('requests.destroy');
Route::get('/requests/{id}/approve', [AdministrativeRequestController::class, 'approveRequest']);
Route::middleware(['auth'])->group(function () {
    Route::get('/requests/create', [App\Http\Controllers\AdministrativeRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [App\Http\Controllers\AdministrativeRequestController::class, 'store'])->name('requests.store');
});
Route::resource('entites', EntiteController::class);

Route::get('/departements', [DepartementController::class, 'index'])->name('departements.index');
Route::get('/departements/create', [DepartementController::class, 'create'])->name('departements.create');
Route::post('/departements', [DepartementController::class, 'store'])->name('departements.store');
Route::get('/departements/{departement}/edit', [DepartementController::class, 'edit'])->name('departements.edit');
Route::put('/departements/{departement}', [DepartementController::class, 'update'])->name('departements.update');
Route::delete('/departements/{departement}', [DepartementController::class, 'destroy'])->name('departements.destroy');
Route::get('/departements/{departement}/assign-entite', [DepartementController::class, 'showAssignEntiteForm'])->name('departements.assign.entite.form');
Route::post('/departements/{departement}/assign-entite', [DepartementController::class, 'assignEntite'])->name('departements.assign.entite');

Route::resource('postes', PosteController::class);

Route::get('/authorizations', [AuthorizationRequestController::class, 'index'])->name('authorizations.index');
Route::get('/authorizations/create', [AuthorizationRequestController::class, 'create'])->name('authorizations.create');
Route::post('/authorizations', [AuthorizationRequestController::class, 'store'])->name('authorizations.store');
Route::get('/authorizations/{authorization}', [AuthorizationRequestController::class, 'show'])->name('authorizations.show');
Route::put('/authorizations/{authorization}', [AuthorizationRequestController::class, 'update'])->name('authorizations.update');
Route::delete('/authorizations/{authorization}', [AuthorizationRequestController::class, 'destroy'])->name('authorizations.destroy');
Route::post('authorizations/{authorization}/approve', [AuthorizationRequestController::class, 'approve'])->name('authorizations.approve');
Route::put('/authorizations/{authorization}/reject', [AuthorizationRequestController::class, 'reject'])->name('authorizations.reject');
Route::get('/authorizations/{authorization}/edit', [AuthorizationRequestController::class, 'edit'])->name('authorizations.edit');
/*Route::get('/authorizations/update-temporary-balances', function () {
    return view('update-temporary-balances');
});*/
Route::get('/temporary-balances/update', function () {
    return view('authorizations.update-temporary-balances'); // Ensure this view file exists
})->name('authorizations.update-temporary-balances');

Route::post('/temporary-balances/update', [AuthorizationRequestController::class, 'updateTemporaryBalances'])->name('temporary-balances.update');

//Route::post('/authorizations/update-temporary-balances', [AuthorizationRequestController::class, 'updateTemporaryBalances'])->name('authorizations.update-temporary-balances');
Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');

Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');
Route::get('/contracts/{id}', [ContractController::class, 'show'])->name('contracts.show');
Route::get('/contracts/{id}/edit', [ContractController::class, 'edit'])->name('contracts.edit');
Route::put('/contracts/{id}', [ContractController::class, 'update'])->name('contracts.update');
Route::delete('/contracts/{id}', [ContractController::class, 'destroy'])->name('contracts.destroy');

Route::post('/send-generated-pdf', [DocumentController::class, 'sendGeneratedPdf']);

Route::middleware('auth')->group(function () {
    Route::post('/save-player-id', [PlayerIdController::class, 'store'])->name('player-id.store');
    Route::delete('/remove-player-id', [PlayerIdController::class, 'destroy'])->name('player-id.destroy');
});
Route::post('/users/update-onesignal-player-id', [UserController::class, 'updateOneSignalPlayerId'])
    ->middleware('auth') // Ensure user is authenticated
    ->name('users.updateOneSignalPlayerId');
Route::middleware(['auth'])->group(function () {
    Route::resource('loan_requests', LoanRequestController::class);
    Route::post('/loan_requests/{loanRequest}/update-status', [ApprovalHistoryController::class, 'update'])->name('loan_requests.update_status');
});
use App\Http\Controllers\SubscriptionController;

Route::post('/save-subscription-id', [SubscriptionController::class, 'store']);
require __DIR__.'/auth.php';
