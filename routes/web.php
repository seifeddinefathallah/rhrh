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
Route::get('/requests/create', [AdministrativeRequestController::class, 'create'])->name('requests.create');
Route::post('/requests', [AdministrativeRequestController::class, 'store'])->name('requests.store');
Route::get('/requests/{request}/edit', [AdministrativeRequestController::class, 'edit'])->name('requests.edit');
Route::put('/requests/{administrativeRequest}', [AdministrativeRequestController::class, 'update'])->name('requests.update');
Route::delete('/requests/{request}', [AdministrativeRequestController::class, 'destroy'])->name('requests.destroy');
Route::get('/requests/{id}/approve', [AdministrativeRequestController::class, 'approveRequest']);

Route::resource('entites', EntiteController::class);

Route::get('/departements', [DepartementController::class, 'index'])->name('departements.index');
Route::get('/departements/create', [DepartementController::class, 'create'])->name('departements.create');
Route::get('/departements/{departement}', [DepartementController::class, 'show'])->name('departements.show');
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
Route::put('/authorizations/{authorization}/approve', [AuthorizationRequestController::class, 'approve'])->name('authorizations.approve');
Route::put('/authorizations/{authorization}/reject', [AuthorizationRequestController::class, 'reject'])->name('authorizations.reject');
Route::get('/authorizations/{authorization}/edit', [AuthorizationRequestController::class, 'edit'])->name('authorizations.edit');
Route::get('/temporary-balances/update', function () {
    return view('authorizations.update-temporary-balances'); // Ensure this view file exists
})->name('authorizations.update-temporary-balances');

Route::post('/temporary-balances/update', [AuthorizationRequestController::class, 'updateTemporaryBalances'])->name('temporary-balances.update');

//Rou


Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');

Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');
Route::get('/contracts/{id}', [ContractController::class, 'show'])->name('contracts.show');
Route::get('/contracts/{id}/edit', [ContractController::class, 'edit'])->name('contracts.edit');
Route::put('/contracts/{id}', [ContractController::class, 'update'])->name('contracts.update');
Route::delete('/contracts/{id}', [ContractController::class, 'destroy'])->name('contracts.destroy');

Route::post('/send-generated-pdf', [DocumentController::class, 'sendGeneratedPdf']);



Route::middleware(['auth'])->group(function () {
    Route::resource('loan_requests', LoanRequestController::class);
    Route::post('/loan_requests/{loanRequest}/update-status', [ApprovalHistoryController::class, 'update'])->name('loan_requests.update_status');
});


Route::resource('contract-types', 'App\Http\Controllers\ContractTypeController');



Route::get('/contract-types', [ContractTypeController::class, 'index'])->name('contract-types.index');
Route::get('/contract-types/create', [ContractTypeController::class, 'create'])->name('contract-types.create');
Route::post('/contract-types', [ContractTypeController::class, 'store'])->name('contract-types.store');
Route::get('/contract-types/{id}', [ContractTypeController::class, 'show'])->name('contract-types.show');
Route::get('/contract-types/{id}/edit', [ContractTypeController::class, 'edit'])->name('contract-types.edit');
Route::put('/contract-types/{id}', [ContractTypeController::class, 'update'])->name('contract-types.update');
Route::delete('/contract-types/{id}', [ContractTypeController::class, 'destroy'])->name('contract-types.destroy');
Route::resource('contract-types', ContractTypeController::class);
Route::get('contract-types/search', [ContractTypeController::class, 'search'])->name('contract-types.search');



Route::get('/intervention-requests', [InterventionRequestController::class, 'index'])->name('intervention-requests.index');
Route::get('/intervention-requests/create', [InterventionRequestController::class, 'create'])->name('intervention-requests.create');
Route::post('/intervention-requests', [InterventionRequestController::class, 'store'])->name('intervention-requests.store');
Route::get('/intervention-requests/{interventionRequest}', [InterventionRequestController::class, 'show'])->name('intervention-requests.show');
Route::put('/intervention-requests/{interventionRequest}', [InterventionRequestController::class, 'update'])->name('intervention-requests.update');
Route::delete('/intervention-requests/{interventionRequest}', [InterventionRequestController::class, 'destroy'])->name('intervention-requests.destroy');
Route::get('/intervention-requests/{interventionRequest}/edit', [InterventionRequestController::class, 'edit'])->name('intervention-requests.edit');
Route::patch('intervention-requests/{intervention_request}/approve', [InterventionRequestController::class, 'approve'])->name('intervention-requests.approve');
Route::patch('intervention-requests/{intervention_request}/reject', [InterventionRequestController::class, 'reject'])->name('intervention-requests.reject');

// Routes pour les demandes de fournitures
Route::get('/supply-requests', [SupplyRequestController::class, 'index'])->name('supply_requests.index');
Route::get('/supply-requests/create', [SupplyRequestController::class, 'create'])->name('supply_requests.create');
Route::post('/supply-requests', [SupplyRequestController::class, 'store'])->name('supply_requests.store');
Route::get('/supply-requests/{supplyRequest}', [SupplyRequestController::class, 'show'])->name('supply_requests.show');
Route::put('/supply-requests/{supplyRequest}', [SupplyRequestController::class, 'update'])->name('supply_requests.update');
Route::delete('/supply-requests/{supplyRequest}', [SupplyRequestController::class, 'destroy'])->name('supply_requests.destroy');
Route::get('/supply-requests/{supplyRequest}/edit', [SupplyRequestController::class, 'edit'])->name('supply_requests.edit');
Route::put('/supply_requests/{supplyRequest}/approve', [SupplyRequestController::class, 'approve'])->name('supply_requests.approve');
Route::put('/supply_requests/{supplyRequest}/reject', [SupplyRequestController::class, 'reject'])->name('supply_requests.reject');


Route::get('/material-requests', [MaterialRequestController::class, 'index'])->name('material_requests.index');
Route::get('/material-requests/create', [MaterialRequestController::class, 'create'])->name('material_requests.create');
Route::post('/material-requests', [MaterialRequestController::class, 'store'])->name('material_requests.store');
Route::get('/material-requests/{materialRequest}', [MaterialRequestController::class, 'show'])->name('material_requests.show');
Route::put('/material-requests/{materialRequest}', [MaterialRequestController::class, 'update'])->name('material_requests.update');
Route::delete('/material-requests/{materialRequest}', [MaterialRequestController::class, 'destroy'])->name('material_requests.destroy');
Route::get('/material-requests/{materialRequest}/edit', [MaterialRequestController::class, 'edit'])->name('material_requests.edit');
Route::put('/material-requests/{materialRequest}/approve', [MaterialRequestController::class, 'approve'])->name('material_requests.approve');
Route::put('/material-requests/{materialRequest}/reject', [MaterialRequestController::class, 'reject'])->name('material_requests.reject');



Route::get('/specific-requests', [SpecificRequestController::class, 'index'])->name('specific_requests.index');
Route::get('/specific-requests/create', [SpecificRequestController::class, 'create'])->name('specific_requests.create');
Route::post('/specific-requests', [SpecificRequestController::class, 'store'])->name('specific_requests.store');
Route::get('/specific-requests/{specificRequest}', [SpecificRequestController::class, 'show'])->name('specific_requests.show');
Route::put('/specific-requests/{specificRequest}', [SpecificRequestController::class, 'update'])->name('specific_requests.update');
Route::delete('/specific-requests/{specificRequest}', [SpecificRequestController::class, 'destroy'])->name('specific_requests.destroy');
Route::get('/specific-requests/{specificRequest}/edit', [SpecificRequestController::class, 'edit'])->name('specific_requests.edit');
Route::put('/specific-requests/{specificRequest}/approve', [SpecificRequestController::class, 'approve'])->name('specific_requests.approve');
Route::put('/specific-requests/{specificRequest}/reject', [SpecificRequestController::class, 'reject'])->name('specific_requests.reject');

Route::post('/save-subscription-id', [SubscriptionController::class, 'store']);
require __DIR__.'/auth.php';
