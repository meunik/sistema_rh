<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use TJGazel\Toastr\Facades\Toastr;

class ClinicasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'cnpj' => 'required',
            'rasao_social' => 'required',
            'apelido' => 'required',
            'estado' => 'required',
            'gerente_operacional' => 'required',
            'enfermeiro_responsavel' => 'required',
            'rod' => 'required',
            'tecnicos_par' => 'required',
            'tecnicos_impar' => 'required',
            'tecnicos_diaristas' => 'required',
            'maquinas_hd' => 'required',
            'maquinas_hdp' => 'required',
            'maquinas_hds' => 'required',
            'maquinas_prisma' => 'required',
            'osmoses' => 'required'
        ];
    }
    public function attributes()
    {
        return [
            'cnpj' => 'CNPJ',
            'rasao_social' => 'Rasao Social',
            'apelido' => 'Apelido',
            'estado' => 'Estado',
            'gerente_operacional' => 'Gerente Operacional',
            'enfermeiro_responsavel' => 'Enfermeiro Responsavel',
            'rod' => 'rod',
            'tecnicos_par' => 'Tecnicos Par',
            'tecnicos_impar' => 'Tecnicos Impar',
            'tecnicos_diaristas' => 'Tecnicos Diaristas',
            'maquinas_hd' => 'Maquinas HD',
            'maquinas_hdp' => 'Maquinas DP',
            'maquinas_hds' => 'Maquinas HDF',
            'maquinas_prisma' => 'Maquinas Contínuas',
            'osmoses' => 'Osmoses'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
        ];
    }

}
