<?php

namespace App\Services;

use App\Http\Requests\ColegasRequest;
use Illuminate\Support\Facades\DB;
use TJGazel\Toastr\Facades\Toastr;
use App\Models\Colegas;

class ColegasService
{
    public static function create($request)
    {
        DB::beginTransaction();

        $colega = Colegas::create([
            'nome' => $request->nome,
            'hospitais_id' => $request->hospitais_id
        ]);

        if(isset($request->data_de_nascimento)){$colega->data_de_nascimento = $request->data_de_nascimento;}
        if(isset($request->chapa)){$colega->chapa = $request->chapa;}
        if(isset($request->centro_de_custo)){$colega->centro_de_custo = $request->centro_de_custo;}
        if(isset($request->funcao)){$colega->funcao = $request->funcao;}
        if(isset($request->secao)){$colega->secao = $request->secao;}
        if(isset($request->admissao)){$colega->admissao = $request->admissao;}
        if(isset($request->codigo_horario)){$colega->codigo_horario = $request->codigo_horario;}
        if(isset($request->horario)){$colega->horario = $request->horario;}
        if(isset($request->jornada)){$colega->jornada = $request->jornada;}
        if(isset($request->telefone)){$colega->telefone = $request->telefone;}
        if(isset($request->grupo_de_risco)){$colega->grupo_de_risco = $request->grupo_de_risco;}

        $colega->save();

        if($colega) {
            DB::commit();
            toastr()->success('Registrado com sucesso!');
        } else {
            DB::rollBack();
            toastr()->error('Desconhecido.');
        }
    }
    public static function Update($request)
    {
        $colega = Colegas::where('id',$request->id)->first();

        if(isset($request->nome)){$colega->nome = $request->nome;}
        if(isset($request->hospitais_id)){$colega->hospitais_id = $request->hospitais_id;}
        if(isset($request->data_de_nascimento)){$colega->data_de_nascimento = $request->data_de_nascimento;}
        if(isset($request->chapa)){$colega->chapa = $request->chapa;}
        if(isset($request->centro_de_custo)){$colega->centro_de_custo = $request->centro_de_custo;}
        if(isset($request->funcao)){$colega->funcao = $request->funcao;}
        if(isset($request->secao)){$colega->secao = $request->secao;}
        if(isset($request->admissao)){$colega->admissao = $request->admissao;}
        if(isset($request->codigo_horario)){$colega->codigo_horario = $request->codigo_horario;}
        if(isset($request->horario)){$colega->horario = $request->horario;}
        if(isset($request->jornada)){$colega->jornada = $request->jornada;}
        if(isset($request->telefone)){$colega->telefone = $request->telefone;}
        if(isset($request->grupo_de_risco)){$colega->grupo_de_risco = $request->grupo_de_risco;}

        $colega->save();

        toastr()->success('Registrado com sucesso!');
    }
}
