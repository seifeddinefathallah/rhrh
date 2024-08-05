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
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\ApprovalHistoryController;
use App\Http\Controllers\PlayerIdController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\InterventionRequestController;
use App\Http\Controllers\SupplyRequestController;
use App\Http\Controllers\MaterialRequestController;
use App\Http\Controllers\SpecificRequestController;

Route::get('/', function () {
    connectify('success', 'Connection Found', 'Connected');
    return view('welcome');
});
Route::get('/pusher', function () {
    ;
    return view('pusher');
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


Route::get('/employees', [EmployeeController::class, 'index'])->middleware(['auth'])->name('employees.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->middleware(['auth'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->middleware(['auth'])->name('employees.store');
Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->middleware(['auth'])->name('employees.show');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->middleware(['auth'])->name('employees.edit');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->middleware(['auth'])->name('employees.update');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->middleware(['auth'])->name('employees.destroy');
Route::post('employees/import', [EmployeeController::class, 'import'])->middleware(['auth'])->name('employees.import');
Route::get('/employees/export', [EmployeeController::class, 'export'])->middleware(['auth'])->name('employees.export');
Route::get('/entites/{entite}/departements', [EmployeeController::class, 'getDepartementsByEntite']);
Route::get('/departements/{departement}/postes', [EmployeeController::class, 'getPostesByDepartement']);
Route::get('/countries', [EmployeeController::class, 'getCountries'])->name('countries');
Route::get('/cities/{country}', [EmployeeController::class, 'getCitiesByCountry'])->name('cities.by.country');

Route::get('/requests', [AdministrativeRequestController::class, 'index'])->middleware(['auth'])->name('requests.index');
Route::get('/requests/create', [AdministrativeRequestController::class, 'create'])->middleware(['auth'])->name('requests.create');
Route::post('/requests', [AdministrativeRequestController::class, 'store'])->middleware(['auth'])->name('requests.store');
Route::get('/requests/{request}/edit', [AdministrativeRequestController::class, 'edit'])->middleware(['auth'])->name('requests.edit');
Route::put('/requests/{administrativeRequest}', [AdministrativeRequestController::class, 'update'])->middleware(['auth'])->name('requests.update');
Route::delete('/requests/{request}', [AdministrativeRequestController::class, 'destroy'])->middleware(['auth'])->name('requests.destroy');
Route::post('requests/{id}/approve', [AdministrativeRequestController::class, 'approveRequest'])->middleware(['auth'])->name('requests.approve');
Route::post('requests/{id}/reject', [AdministrativeRequestController::class, 'rejectRequest'])->middleware(['auth'])->name('requests.reject');

Route::resource('entites', EntiteController::class);

Route::get('/departements', [DepartementController::class, 'index'])->middleware(['auth'])->name('departements.index');
Route::get('/departements/create', [DepartementController::class, 'create'])->middleware(['auth'])->name('departements.create');
Route::get('/departements/{departement}', [DepartementController::class, 'show'])->middleware(['auth'])->name('departements.show');
Route::post('/departements', [DepartementController::class, 'store'])->middleware(['auth'])->name('departements.store');
Route::get('/departements/{departement}/edit', [DepartementController::class, 'edit'])->middleware(['auth'])->name('departements.edit');
Route::put('/departements/{departement}', [DepartementController::class, 'update'])->middleware(['auth'])->name('departements.update');
Route::delete('/departements/{departement}', [DepartementController::class, 'destroy'])->middleware(['auth'])->name('departements.destroy');
Route::get('/departements/{departement}/assign-entite', [DepartementController::class, 'showAssignEntiteForm'])->middleware(['auth'])->name('departements.assign.entite.form');
Route::post('/departements/{departement}/assign-entite', [DepartementController::class, 'assignEntite'])->middleware(['auth'])->name('departements.assign.entite');

Route::resource('postes', PosteController::class);

Route::get('/authorizations', [AuthorizationRequestController::class, 'index'])->middleware(['auth'])->name('authorizations.index');
Route::get('/authorizations/create', [AuthorizationRequestController::class, 'create'])->middleware(['auth'])->name('authorizations.create');
Route::post('/authorizations', [AuthorizationRequestController::class, 'store'])->middleware(['auth'])->name('authorizations.store');
Route::get('/authorizations/{authorization}', [AuthorizationRequestController::class, 'show'])->middleware(['auth'])->name('authorizations.show');
Route::put('/authorizations/{authorization}', [AuthorizationRequestController::class, 'update'])->middleware(['auth'])->name('authorizations.update');
Route::delete('/authorizations/{authorization}', [AuthorizationRequestController::class, 'destroy'])->middleware(['auth'])->name('authorizations.destroy');
Route::put('/authorizations/{authorization}/approve', [AuthorizationRequestController::class, 'approve'])->middleware(['auth'])->name('authorizations.approve');
Route::put('/authorizations/{authorization}/reject', [AuthorizationRequestController::class, 'reject'])->middleware(['auth'])->name('authorizations.reject');
Route::get('/authorizations/{authorization}/edit', [AuthorizationRequestController::class, 'edit'])->middleware(['auth'])->name('authorizations.edit');
Route::get('/temporary-balances/update', function () {
    return view('authorizations.update-temporary-balances'); // Ensure this view file exists
})->name('authorizations.update-temporary-balances');

Route::post('/temporary-balances/update', [AuthorizationRequestController::class, 'updateTemporaryBalances'])->middleware(['auth'])->name('temporary-balances.update');

//Rou


Route::get('/contracts', [ContractController::class, 'index'])->middleware(['auth'])->name('contracts.index');

Route::get('/contracts/create', [ContractController::class, 'create'])->middleware(['auth'])->name('contracts.create');
Route::post('/contracts', [ContractController::class, 'store'])->middleware(['auth'])->name('contracts.store');
Route::get('/contracts/{id}', [ContractController::class, 'show'])->middleware(['auth'])->name('contracts.show');
Route::get('/contracts/{id}/edit', [ContractController::class, 'edit'])->middleware(['auth'])->name('contracts.edit');
Route::put('/contracts/{id}', [ContractController::class, 'update'])->middleware(['auth'])->name('contracts.update');
Route::delete('/contracts/{id}', [ContractController::class, 'destroy'])->middleware(['auth'])->name('contracts.destroy');

Route::post('/send-generated-pdf', [DocumentController::class, 'sendGeneratedPdf']);



Route::middleware(['auth'])->group(function () {
    Route::resource('loan_requests', LoanRequestController::class);
    Route::post('/loan_requests/{loanRequest}/update-status', [ApprovalHistoryController::class, 'update'])->middleware(['auth'])->name('loan_requests.update_status');
});


Route::resource('contract-types', 'App\Http\Controllers\ContractTypeController');



Route::get('/contract-types', [ContractTypeController::class, 'index'])->middleware(['auth'])->name('contract-types.index');
Route::get('/contract-types/create', [ContractTypeController::class, 'create'])->middleware(['auth'])->name('contract-types.create');
Route::post('/contract-types', [ContractTypeController::class, 'store'])->middleware(['auth'])->name('contract-types.store');
Route::get('/contract-types/{id}', [ContractTypeController::class, 'show'])->middleware(['auth'])->name('contract-types.show');
Route::get('/contract-types/{id}/edit', [ContractTypeController::class, 'edit'])->middleware(['auth'])->name('contract-types.edit');
Route::put('/contract-types/{id}', [ContractTypeController::class, 'update'])->middleware(['auth'])->name('contract-types.update');
Route::delete('/contract-types/{id}', [ContractTypeController::class, 'destroy'])->middleware(['auth'])->name('contract-types.destroy');
Route::resource('contract-types', ContractTypeController::class);
Route::get('contract-types/search', [ContractTypeController::class, 'search'])->middleware(['auth'])->name('contract-types.search');



Route::get('/intervention-requests', [InterventionRequestController::class, 'index'])->middleware(['auth'])->name('intervention-requests.index');
Route::get('/intervention-requests/create', [InterventionRequestController::class, 'create'])->middleware(['auth'])->name('intervention-requests.create');
Route::post('/intervention-requests', [InterventionRequestController::class, 'store'])->middleware(['auth'])->name('intervention-requests.store');
Route::get('/intervention-requests/{interventionRequest}', [InterventionRequestController::class, 'show'])->middleware(['auth'])->name('intervention-requests.show');
Route::put('/intervention-requests/{interventionRequest}', [InterventionRequestController::class, 'update'])->middleware(['auth'])->name('intervention-requests.update');
Route::delete('/intervention-requests/{interventionRequest}', [InterventionRequestController::class, 'destroy'])->middleware(['auth'])->name('intervention-requests.destroy');
Route::get('/intervention-requests/{interventionRequest}/edit', [InterventionRequestController::class, 'edit'])->middleware(['auth'])->name('intervention-requests.edit');
Route::patch('intervention-requests/{intervention_request}/approve', [InterventionRequestController::class, 'approve'])->middleware(['auth'])->name('intervention-requests.approve');
Route::patch('intervention-requests/{intervention_request}/reject', [InterventionRequestController::class, 'reject'])->middleware(['auth'])->name('intervention-requests.reject');

// Routes pour les demandes de fournitures
Route::get('/supply-requests', [SupplyRequestController::class, 'index'])->middleware(['auth'])->name('supply_requests.index');
Route::get('/supply-requests/create', [SupplyRequestController::class, 'create'])->middleware(['auth'])->name('supply_requests.create');
Route::post('/supply-requests', [SupplyRequestController::class, 'store'])->middleware(['auth'])->name('supply_requests.store');
Route::get('/supply-requests/{supplyRequest}', [SupplyRequestController::class, 'show'])->middleware(['auth'])->name('supply_requests.show');
Route::put('/supply-requests/{supplyRequest}', [SupplyRequestController::class, 'update'])->middleware(['auth'])->name('supply_requests.update');
Route::delete('/supply-requests/{supplyRequest}', [SupplyRequestController::class, 'destroy'])->middleware(['auth'])->name('supply_requests.destroy');
Route::get('/supply-requests/{supplyRequest}/edit', [SupplyRequestController::class, 'edit'])->middleware(['auth'])->name('supply_requests.edit');
Route::put('/supply_requests/{supplyRequest}/approve', [SupplyRequestController::class, 'approve'])->middleware(['auth'])->name('supply_requests.approve');
Route::put('/supply_requests/{supplyRequest}/reject', [SupplyRequestController::class, 'reject'])->middleware(['auth'])->name('supply_requests.reject');


Route::get('/material-requests', [MaterialRequestController::class, 'index'])->middleware(['auth'])->name('material_requests.index');
Route::get('/material-requests/create', [MaterialRequestController::class, 'create'])->middleware(['auth'])->name('material_requests.create');
Route::post('/material-requests', [MaterialRequestController::class, 'store'])->middleware(['auth'])->name('material_requests.store');
Route::get('/material-requests/{materialRequest}', [MaterialRequestController::class, 'show'])->middleware(['auth'])->name('material_requests.show');
Route::put('/material-requests/{materialRequest}', [MaterialRequestController::class, 'update'])->middleware(['auth'])->name('material_requests.update');
Route::delete('/material-requests/{materialRequest}', [MaterialRequestController::class, 'destroy'])->middleware(['auth'])->name('material_requests.destroy');
Route::get('/material-requests/{materialRequest}/edit', [MaterialRequestController::class, 'edit'])->middleware(['auth'])->name('material_requests.edit');
Route::put('/material-requests/{materialRequest}/approve', [MaterialRequestController::class, 'approve'])->middleware(['auth'])->name('material_requests.approve');
Route::put('/material-requests/{materialRequest}/reject', [MaterialRequestController::class, 'reject'])->middleware(['auth'])->name('material_requests.reject');



Route::get('/specific-requests', [SpecificRequestController::class, 'index'])->middleware(['auth'])->name('specific_requests.index');
Route::get('/specific-requests/create', [SpecificRequestController::class, 'create'])->middleware(['auth'])->name('specific_requests.create');
Route::post('/specific-requests', [SpecificRequestController::class, 'store'])->middleware(['auth'])->name('specific_requests.store');
Route::get('/specific-requests/{specificRequest}', [SpecificRequestController::class, 'show'])->middleware(['auth'])->name('specific_requests.show');
Route::put('/specific-requests/{specificRequest}', [SpecificRequestController::class, 'update'])->middleware(['auth'])->name('specific_requests.update');
Route::delete('/specific-requests/{specificRequest}', [SpecificRequestController::class, 'destroy'])->middleware(['auth'])->name('specific_requests.destroy');
Route::get('/specific-requests/{specificRequest}/edit', [SpecificRequestController::class, 'edit'])->middleware(['auth'])->name('specific_requests.edit');
Route::put('/specific-requests/{specificRequest}/approve', [SpecificRequestController::class, 'approve'])->middleware(['auth'])->name('specific_requests.approve');
Route::put('/specific-requests/{specificRequest}/reject', [SpecificRequestController::class, 'reject'])->middleware(['auth'])->name('specific_requests.reject');

Route::post('/save-subscription-id', [SubscriptionController::class, 'store']);
require __DIR__.'/auth.php';
