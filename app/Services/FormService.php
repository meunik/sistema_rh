<?php

namespace App\Services;

use App\Models\Covid;

class FormService
{
    public static function atestado($request, $data)
    {
        if(isset($request->data_final)){$data->data_final = $request->data_final;}
        if(isset($request->cids_id)){$data->cids_id = $request->cids_id;}
        if(isset($request->cid_categoria_id)){$data->cid_categoria_id = $request->cid_categoria_id;}
        if(isset($request->cid_sub_categoria_id)){$data->cid_sub_categoria_id = $request->cid_sub_categoria_id;}
        if(isset($request->motivo)){$data->motivo = $request->motivo;}
        if(isset($request->motivoSelect)){$data->motivoSelect = $request->motivoSelect;}
        if(isset($request->dias_atestado)){$data->dias_atestado = $request->dias_atestado;}
    }

    public static function ferias($request, $data)
    {
        if(isset($request->data_final)){$data->data_final = $request->data_final;}
    }

    public static function demitido($request, $colegas)
    {
        if(isset($request->data_inicial)){$colegas->demissao = $request->data_inicial;}
        $colegas->save();
    }

    public static function covid($request, $data)
    {
        if(isset($request->covid)){$data->covid = $request->covid;}
        if(isset($request->data_final)){$data->data_final = $request->data_final;}
        if(isset($request->observacao)){$data->observacao = $request->observacao;}

        $covid = Covid::firstOrCreate(['colegas_id' => $request->id]);

        if($covid) {
            if(isset($request->data_dos_sintomas)){$covid->data_dos_sintomas = $request->data_dos_sintomas;}
            if(isset($request->data_do_teste)){$covid->data_do_teste = $request->data_do_teste;}
            if(isset($request->tipo_do_teste)){$covid->tipo_do_teste = $request->tipo_do_teste;}
            if(isset($request->observacao)){$covid->observacao = $request->observacao;}
            $covid->save();
        }
    }

    public static function grupoDeRisco($request, $data)
    {
        if(isset($request->data_final)){$data->data_final = $request->data_final;}
        if(isset($request->observacao)){$data->observacao = $request->observacao;}
        if(isset($request->grupo_de_risco)){$data->grupo_de_risco = $request->grupo_de_risco;}
    }

    public static function afastamentoInss($request, $data)
    {
        if(isset($request->data_inicio_beneficio)){$data->data_inicio_beneficio = $request->data_inicio_beneficio;}
        if(isset($request->data_cessacao_beneficio)){$data->data_cessacao_beneficio = $request->data_cessacao_beneficio;}
        if(isset($request->especie_do_beneficio)){$data->especie_do_beneficio = $request->especie_do_beneficio;}
        if(isset($request->especie_do_beneficio_outros)){$data->especie_do_beneficio_outros = $request->especie_do_beneficio_outros;}

        if(isset($request->cid_categoria_id)){$data->cid_categoria_id = $request->cid_categoria_id;}
        if(isset($request->cid_sub_categoria_id)){$data->cid_sub_categoria_id = $request->cid_sub_categoria_id;}

        if(isset($request->motivo)){$data->motivo = $request->motivo;}
        if(isset($request->motivoSelect)){$data->motivoSelect = $request->motivoSelect;}

        if(isset($request->data_proximo_contato_form)){$data->data_proximo_contato_form = $request->data_proximo_contato_form;}
        if(isset($request->data_realizacao_exame)){$data->data_realizacao_exame = $request->data_realizacao_exame;}
        if(isset($request->data_de_contato_form)){$data->data_de_contato_form = $request->data_de_contato_form;}

        if(isset($request->observacao)){$data->observacao = $request->observacao;}
    }
}
