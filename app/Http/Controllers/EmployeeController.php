<?php

namespace App\Http\Controllers;

use App\Models\DefaultBalance;
use App\Models\DepartementEntite;
use App\Models\Employee;
use App\Models\User;
use App\Models\Entite;
use App\Models\Poste;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeCreated;
use App\Mail\EmployeeUpdated;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;
use App\Exports\EmployeesExport;
use Nnjeim\World\Models\Country; // Import the Country model from the package
use Nnjeim\World\Models\State;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;
use App\Notifications\NewEmployeeNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Livewire\EmployeeSearch;
use Livewire\Livewire;
use App\Events\EmployeeNotification;
use App\Http\Livewire\EmployeeNotifications;
use App\Events\MessageSent;

class EmployeeController extends Controller
{
    /*public function index()
    {
        /*$employees = Employee::with('poste.departement.entites')->get();
        return view('employees.index', compact('employees'));

    }*/
    public function index(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $employees = Employee::when($searchTerm, function ($query) use ($searchTerm) {
            $query->where('nom', 'like', '%' . $searchTerm . '%')
                ->orWhere('prenom', 'like', '%' . $searchTerm . '%');

        })
            ->latest()
            ->with('poste.departement.entites')
            ->paginate(10);
            //->get();

        return view('employees.index', compact('employees'));
    }
    public function create()
    {
        $entites = Entite::with('departements.postes')->get();
        return view('employees.create', compact('entites'));
    }

    public function store(Request $request)
    {
       //dd($request->all());

        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date|after:1940-01-01',
            'email_professionnel' => [
                'required',
                'email',
                'unique:employees,email_professionnel',
                function ($attribute, $value, $fail) {
                    $allowed_domains = ['csi-corporation.com', 'csi-maghreb.com', 'csi-international.com'];
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowed_domains)) {
                        $fail("The $attribute domain must be one of: " . implode(', ', $allowed_domains));
                    }
                }
            ],
            'email_personnel' => [
                'nullable',
                'email',
                function ($attribute, $value, $fail) {
                    $allowed_domains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'live.com', 'aol.com', 'mail.com', 'protonmail.com', 'zoho.com', 'yandex.com'];
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowed_domains)) {
                        $fail("The $attribute domain must be one of: " . implode(', ', $allowed_domains));
                    }
                },
            ],
            'matricule' => [
                'required',
                'string',
                'numeric',
                'unique:employees,matricule'
            ],
            'telephone' => 'required|string|numeric',
            'code_postal' => 'required|string|numeric',
            'ville' => 'required|string',
            'state' => 'required|string',
            'pays' => 'required|string',
            'adresse' => 'required|string',
            'situation_familiale' => 'required|string',
            'nombre_enfants' => 'required|integer',
            'entite_id' => 'required|exists:entites,id',
            'departement_id' => 'required|exists:departements,id',
            'poste_id' => 'required|exists:postes,id',
            'cin_numero' => [
                'nullable',
                'string',
                'unique:employees,cin_numero'
            ],
            'cin_date_delivrance' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $date_naissance = $request->input('date_naissance');
                    $cin_date_delivrance = $request->input('cin_date_delivrance');
                    $pays = $request->input('pays');
                    if ($cin_date_delivrance && $date_naissance && $pays == 'TN') {
                        $diff = date_diff(date_create($date_naissance), date_create($cin_date_delivrance));
                        if ($diff->y < 18) {
                            $fail("The $attribute must be at least 18 years after the date of birth");
                        }
                    }
                },
            ],
            'carte_sejour_numero' => 'nullable|string',
            'carte_sejour_date_delivrance' => 'nullable|date',
            'carte_sejour_date_expiration' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $carte_sejour_date_delivrance = $request->input('carte_sejour_date_delivrance');
                    if ($carte_sejour_date_delivrance && $value) {
                        if (strtotime($value) <= strtotime($carte_sejour_date_delivrance)) {
                            $fail("The $attribute must be after the carte de séjour delivery date");
                        }
                    }
                },
            ],
            'carte_sejour_type' => 'nullable|string',
            'passeport_numero' => [
                'nullable',
                'string',
                'unique:employees,passeport_numero'
            ],
            'passeport_date_delivrance' => 'nullable|date',
            'passeport_date_expiration' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $pays = $request->input('pays');
                    $passeport_date_delivrance = $request->input('passeport_date_delivrance');
                    if ($pays == 'TN' && $value && $passeport_date_delivrance) {
                        $min_date = date('Y-m-d', strtotime($passeport_date_delivrance. ' 5 years'));
                        if (strtotime($value) < strtotime($min_date)) {
                            $fail("The $attribute must be at least 5 years after the passport delivery date for Tunisia");
                        }
                    }
                },
            ],
            'passeport_delai_validite' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $email_professionnel = $request->input('email_professionnel');
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $user = User::where('email', $email_professionnel)->first();
        $defaultPassword = 'Csi@2019';

        if (!$user) {
            $name = strtolower($prenom . ' ' . $nom);
            $username = strtolower($prenom . '.' . $nom);
            $user = User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email_professionnel,
                'password' => Hash::make($defaultPassword),
            ]);
        }


        $employeeData = [
            'user_id' => $user->id,
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $request->date_naissance,
            'email_professionnel' => $email_professionnel,
            'email_personnel' => $request->email_personnel,
            'matricule' => $request->matricule,
            'telephone' => $request->telephone,
            'code_postal' => $request->code_postal,
            'ville' => $request->ville,
            'pays' => $request->pays,
            'state' => $request->state,
            'adresse' => $request->adresse,
            'situation_familiale' => $request->situation_familiale,
            'nombre_enfants' => $request->nombre_enfants,
            'entite_id' => $request->entite_id,
            'departement_id' => $request->departement_id,
            'poste_id' => $request->poste_id,
            'sortie_balance' => 2, // Default value for sortie_balance
            'teletravail_days_balance' => 5,
        ];

        // Adding additional fields for identity documents if provided
        if ($request->filled('cin_numero')) {
            $employeeData['cin_numero'] = $request->cin_numero;
            $employeeData['cin_date_delivrance'] = $request->cin_date_delivrance;
        }

        if ($request->filled('carte_sejour_numero')) {
            $employeeData['carte_sejour_numero'] = $request->carte_sejour_numero;
            $employeeData['carte_sejour_date_delivrance'] = $request->carte_sejour_date_delivrance;
            $employeeData['carte_sejour_date_expiration'] = $request->carte_sejour_date_expiration;
            $employeeData['carte_sejour_type'] = $request->carte_sejour_type;
        }

        if ($request->filled('passeport_numero')) {
            $employeeData['passeport_numero'] = $request->passeport_numero;
            $employeeData['passeport_date_delivrance'] = $request->passeport_date_delivrance;
            $employeeData['passeport_date_expiration'] = $request->passeport_date_expiration;
            $employeeData['passeport_delai_validite'] = $request->passeport_delai_validite;
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('employees', 'public');
            $request->image = $imagePath;
            $employeeData['image'] = $request->image;
        }
        //unset($employeeData['autre_situation_familiale']);
        //$employeeData->image = $imagePath;
        \Log::info('Données d\'employé: ', $employeeData);
        // Create the employee
        $employee = Employee::create($employeeData);
        $defaultBalance = new DefaultBalance();
        $defaultBalance->employee_id = $employee->id;
        $defaultBalance->sortie_balance = 2; // Default sortie_balance value
        $defaultBalance->teletravail_days_balance = 5; // Default teletravail_days_balance value
        $defaultBalance->period = "month";
        $defaultBalance->save();
        /*$defaultBalance = [
            'employee_id' => $employee->id,
            'sortie_balance' => 2, // Default value for sortie_balance
            'teletravail_days_balance' => 5,
        ];
        DefaultBalance::create($defaultBalance);*/
        $existingEmployees = Employee::where('id', '!=', $employee->id)->get();
        foreach ($existingEmployees as $existingEmployee) {
           /* Mail::to($existingEmployee->email)
                ->send(new NewEmployeeNotification($existingEmployee, $employee));*/
            Notification::send($existingEmployee, new NewEmployeeNotification($existingEmployee, $employee));
        }
        //dd($employee->errors());
        // Send email to the new employee
        Mail::to($employee->email_professionnel)->send(new EmployeeCreated($employee, $defaultPassword));
        \Log::info('Trying to send notification...');
        try {
            OneSignal::sendNotificationToAll("New employee registered: {$employee->nom} {$employee->prenom} They will be working as a {$employee->poste->titre} in {$employee->departement->nom} department ");
            \Log::info('Notification sent successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to send OneSignal notification: ' . $e->getMessage());
        }
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }
    public function show($id)
    {
        $employee = Employee::with('poste.departement.entites')->findOrFail($id);
        return view('employees.show', compact('employee'));
    }
    public function edit(Employee $employee)
    {
        $postes = Poste::with('departement')->get();
        $departements = Departement::all();
        $entites = Entite::with('departements.postes')->get();
        return view('employees.edit', compact('employee', 'postes', 'departements', 'entites'));
    }

    public function update(Request $request, Employee $employee)
    {
        //dd($request->all());
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date|after:1940-01-01',
            'email_professionnel' => [
                'required',
                'email',
                'unique:employees,email_professionnel,' . $employee->id, // allow current employee email
                function ($attribute, $value, $fail) {
                    $allowed_domains = ['csi-corporation.com', 'csi-maghreb.com', 'csi-international.com'];
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowed_domains)) {
                        $fail("The $attribute domain must be one of: " . implode(', ', $allowed_domains));
                    }
                }
            ],
            'email_personnel' => [
                'nullable',
                'email',
                function ($attribute, $value, $fail) {
                    $allowed_domains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'live.com', 'aol.com', 'mail.com', 'protonmail.com', 'zoho.com', 'yandex.com'];
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowed_domains)) {
                        $fail("The $attribute domain must be one of: " . implode(', ', $allowed_domains));
                    }
                },
            ],
            'matricule' => 'required|string|numeric',
            'telephone' => 'required|string|numeric',
            'code_postal' => 'required|string|numeric',
            'ville' => 'required|string',
            'state' => 'required|string',
            'pays' => 'required|string',
            'adresse' => 'required|string',
            'situation_familiale' => 'required|string',
            'nombre_enfants' => 'required|integer',
            'entite_id' => 'required|exists:entites,id',
            'departement_id' => 'required|exists:departements,id',
            'poste_id' => 'required|exists:postes,id',
            'cin_numero' => 'nullable|string',
            'cin_date_delivrance' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $date_naissance = $request->input('date_naissance');
                    $cin_date_delivrance = $request->input('cin_date_delivrance');
                    $pays = $request->input('pays');
                    if ($cin_date_delivrance && $date_naissance && $pays == 'TN') {
                        $diff = date_diff(date_create($date_naissance), date_create($cin_date_delivrance));
                        if ($diff->y < 15) {
                            $fail("The $attribute must be at least 15 years after the date of birth");
                        }
                    }
                },
            ],
            'carte_sejour_numero' => 'nullable|string',
            'carte_sejour_date_delivrance' => 'nullable|date',
            'carte_sejour_date_expiration' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $carte_sejour_date_delivrance = $request->input('carte_sejour_date_delivrance');
                    if ($carte_sejour_date_delivrance && $value) {
                        if (strtotime($value) <= strtotime($carte_sejour_date_delivrance)) {
                            $fail("The $attribute must be after the carte de séjour delivery date");
                        }
                    }
                },
            ],
            'carte_sejour_type' => 'nullable|string',
            'passeport_numero' => 'nullable|string',
            'passeport_date_delivrance' => 'nullable|date',
            'passeport_date_expiration' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $pays = $request->input('pays');
                    $passeport_date_delivrance = $request->input('passeport_date_delivrance');
                    if ($pays == 'TN' && $value && $passeport_date_delivrance) {
                        $min_date = date('Y-m-d', strtotime($passeport_date_delivrance. ' 5 years'));
                        if (strtotime($value) < strtotime($min_date)) {
                            $fail("The $attribute must be at least 5 years after the passport delivery date for Tunisia");
                        }
                    }
                },
            ],
            'passeport_delai_validite' => 'nullable|string',
        ]);

        $employee->fill($request->all());

        // Update additional fields for identity documents if provided
        if ($request->filled('cin_numero')) {
            $employee->cin_numero = $request->cin_numero;
            $employee->cin_date_delivrance = $request->cin_date_delivrance;
        }

        if ($request->filled('carte_sejour_numero')) {
            $employee->carte_sejour_numero = $request->carte_sejour_numero;
            $employee->carte_sejour_date_delivrance = $request->carte_sejour_date_delivrance;
            $employee->carte_sejour_date_expiration = $request->carte_sejour_date_expiration;
            $employee->carte_sejour_type = $request->carte_sejour_type;
        }

        if ($request->filled('passeport_numero')) {
            $employee->passeport_numero = $request->passeport_numero;
            $employee->passeport_date_delivrance = $request->passeport_date_delivrance;
            $employee->passeport_date_expiration = $request->passeport_date_expiration;
            $employee->passeport_delai_validite = $request->passeport_delai_validite;
        }
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($employee->image && Storage::disk('public')->exists($employee->image)) {
                Storage::disk('public')->delete($employee->image);
            }

            // Enregistrer la nouvelle image téléchargée
            $imagePath = $request->file('image')->store('employees', 'public');
            $employee->image = $imagePath;
        }



        $employee->save();

        // Send email to the employee with the changes
        Mail::to($employee->email_professionnel)->send(new EmployeeUpdated($employee));
        event(new EmployeeNotification('Employee details updated successfully'));
        $this->emitNotificationToEmployee($employee->user_id, 'Your profile has been updated.');
        notify()->success('Success message!', 'Success Title');
        // Send OneSignal notification to the employee
        \Log::info('Employee updated:', $employee->toArray());

        try {
            // Créer des filtres de notification basés sur les tags
            $filters = [
                ['field' => 'tag', 'key' => 'user_id', 'relation' => '=', 'value' => (string) $employee->user_id]
            ];

            \Log::info('OneSignal Filters:', $filters);

            // Envoyer la notification
            $response = OneSignal::sendNotificationUsingTags(
                "Votre profil a été mis à jour : {$employee->nom} {$employee->prenom}",
                $filters
            );

            \Log::info('OneSignal Response:', (array) $response);

        } catch (\Exception $e) {
            \Log::error('Failed to send OneSignal notification: ' . $e->getMessage());
        }
        broadcast(new MessageSent($employee));
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }
    protected function emitNotificationToEmployee($userId, $message)
    {
        // You can dispatch a browser event or use another method to notify the Livewire component
        Livewire::test(EmployeeNotifications::class)
            ->emit('notifyEmployee', $message);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new EmployeesImport, $request->file('file'));

        return back()->with('success', 'Employees imported successfully.');
    }



    public function getPostesByDepartement(Departement $departement)
    {
        $postes = Poste::where('departement_id', $departement->id)->get();

        return response()->json($postes);
    }
    public function getDepartementsByEntite(Entite $entite)
    {
        try {
            $departements = $entite->departements()->get();
            return response()->json($departements);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch departments for the entity.'], 500);
        }
    }
    public function getCountries()
    {
        $countries = World::countries()->data;
        return response()->json($countries);
    }

    public function getCitiesByCountry($country_id)
    {
        $cities = World::cities(['filters' => ['country_id' => $country_id]])->data;
        return response()->json($cities);
    }
}

