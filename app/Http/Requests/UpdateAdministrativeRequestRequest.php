<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdministrativeRequestRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autoriser l'accès pour les tests, ajustez selon vos besoins
    }

    public function rules()
    {
        return [
            'status' => 'required|string', // Exemple de règle de validation
        ];
    }
}
