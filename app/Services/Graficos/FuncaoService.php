<?php

namespace App\Services\Graficos;

use App\Models\Datas;
use Illuminate\Support\Carbon;

class FuncaoService
{
    public static function colagasComAtestados($esteMes, $hospitais)
    {
        $data = Datas::where('cod', 'AT')
        ->where('data_inicial', '<=', $esteMes['hoje'])
        ->where('data_inicial', '>=', $esteMes['umMesAtraz'])
        ->join('colegas', 'datas.colegas_id', '=', 'colegas.id')
        ->join('hospitais', 'colegas.hospitais_id', '=', 'hospitais.id')
        ->whereIn('hospitais.id', $hospitais)
        ->select(
            'colegas.nome',
            'colegas.funcao',
            'colegas.hospitais_id as hospital_id',
            'hospitais.nome as hospital_nome',
            'datas.motivoSelect',
            'datas.motivo',
            'datas.data_inicial',
            'datas.dias_atestado',
            'datas.data_final',
            'datas.data_de_contato',
        )
        ->get();

		return $data;
    }

    /**
     *  Dados da coluna "Total de Atestados"
     *  Retorna {"funcao": quantidade,...}
     */
    public static function totalDeAtestados($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if (isset($resultados[$dt->funcao])) {
                $resultados[$dt->funcao] = $resultados[$dt->funcao] + 1;
            } else {
                $resultados[$dt->funcao] = 1;
            }
            $resultados['total']++;
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "Atestado por Acidente Trabalho ou Doença"
     *  Retorna {"funcao": quantidade,...}
     */
    public static function atestadosPorAcidenteOuDoenca($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if ($dt->motivoSelect == 1) {
                $resultados[$dt->funcao] = isset($resultados[$dt->funcao]) ? $resultados[$dt->funcao] + 1 : 1;
                $resultados['total']++;
            } else {
                $resultados[$dt->funcao] = isset($resultados[$dt->funcao]) ? $resultados[$dt->funcao] : 0;
            }
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "Quantidade atestados nao contatados"
     *  Retorna {"funcao": quantidade,...}
     */
    public static function qtdAtestadosNaoCotatados($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if ($dt->data_de_contato == null) {
                $resultados[$dt->funcao] = isset($resultados[$dt->funcao]) ? $resultados[$dt->funcao] + 1 : 1;
                $resultados['total']++;
            } else {
                $resultados[$dt->funcao] = isset($resultados[$dt->funcao]) ? $resultados[$dt->funcao] : 0;
            }
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "Quantidade atestados com contato periodo"
     *  Retorna {"funcao": quantidade,...}
     */
    public static function qtdAtestadosComContatoPeriodo($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if ($dt->data_de_contato != null) {
                $resultados[$dt->funcao] = isset($resultados[$dt->funcao]) ? $resultados[$dt->funcao] + 1 : 1;
                $resultados['total']++;
            } else {
                $resultados[$dt->funcao] = isset($resultados[$dt->funcao]) ? $resultados[$dt->funcao] : 0;
            }
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "Quantidade dias perdidos mês"
     *  Retorna {"funcao": quantidade,...}
     */
    public static function qtdDiasPerdidosMes($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {

            $data_inicial = Carbon::parse($dt->data_inicial);
            $data_final = Carbon::parse($dt->data_final);
            $diffInDays =  $data_inicial->diffInDays($data_final) + 1;

            if (($dt->data_final != null) && ($diffInDays <= 366)) {
                $resultados[$dt->funcao] = isset($resultados[$dt->funcao]) ? $resultados[$dt->funcao] + $diffInDays : $diffInDays;
                $resultados['total']++;
            } else {
                $resultados[$dt->funcao] = isset($resultados[$dt->funcao]) ? $resultados[$dt->funcao] : 0;
            }
        }

		return $resultados;
    }
}
