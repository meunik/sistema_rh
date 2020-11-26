<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use TJGazel\Toastr\Facades\Toastr;

class UsersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Nome',
            'email' => 'E-mail',
            'password' => 'Senha'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
        ];
    }

}
