<?php

// app/Http/Controllers/ImportEmployeeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;
use App\Models\Employee;

class ImportEmployeeController extends Controller
{
    public function showImportForm()
    {
        return view('employees.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:10240' // Validation du fichier
        ]);

        $file = $request->file('file');

        // Importer les employés depuis le fichier Excel
        Excel::import(new EmployeesImport, $file);

        return redirect()->route('employees.index')
            ->with('success', 'Employees imported successfully.');
    }
}
