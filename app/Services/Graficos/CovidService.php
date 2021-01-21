<?php

namespace App\Services\Graficos;

use App\Models\Datas;
use Illuminate\Support\Carbon;

class CovidService
{
    public static function colagasComCovid($esteMes, $hospitais)
    {
        $data = Datas::where('cod', 'CO')
        ->where('data_inicial', '<=', $esteMes['hoje'])
        ->where('data_inicial', '>=', $esteMes['umMesAtraz'])
        ->join('colegas', 'datas.colegas_id', '=', 'colegas.id')
        ->join('hospitais', 'colegas.hospitais_id', '=', 'hospitais.id')
        ->whereIn('hospitais.id', $hospitais)
        ->select(
            'colegas.nome',
            'colegas.hospitais_id as hospital_id',
            'hospitais.nome as hospital_nome',
            'datas.covid',
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
     *  Retorna {"hospital_id": quantidade,...}
     */
    public static function totalDeCovid($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if (isset($resultados[$dt->hospital_id])) {
                $resultados[$dt->hospital_id] = $resultados[$dt->hospital_id] + 1;
            } else {
                $resultados[$dt->hospital_id] = 1;
            }
            $resultados['total']++;
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "Indefinidos"
     *  Retorna {"hospital_id": quantidade,...}
     */
    public static function co_Null($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if ($dt->covid === null) {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] + 1 : 1;
                $resultados['total']++;
            } else {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] : 0;
            }
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "CO-S"
     *  Retorna {"hospital_id": quantidade,...}
     */
    public static function co_s($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if ($dt->covid === "Suspeito") {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] + 1 : 1;
                $resultados['total']++;
            } else {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] : 0;
            }
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "CO+"
     *  Retorna {"hospital_id": quantidade,...}
     */
    public static function coMais($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if ($dt->covid === "Confirmado") {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] + 1 : 1;
                $resultados['total']++;
            } else {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] : 0;
            }
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "CO"
     *  Retorna {"hospital_id": quantidade,...}
     */
    public static function co($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if ($dt->covid === "Descartado") {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] + 1 : 1;
                $resultados['total']++;
            } else {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] : 0;
            }
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "Quantidade atestados nao contatados"
     *  Retorna {"hospital_id": quantidade,...}
     */
    public static function qtdAtestadosNaoCotatados($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if ($dt->data_de_contato == null) {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] + 1 : 1;
                $resultados['total']++;
            } else {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] : 0;
            }
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "Quantidade dias perdidos mês"
     *  Retorna {"hospital_id": quantidade,...}
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
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] + $diffInDays : $diffInDays;
                $resultados['total']++;
            } else {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] : 0;
            }
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "% de atestados por Colegas"
     *  Retorna {"hospital_id": quantidade,...}
     */
    public static function porcentagemDeAtestadosPorColegas($data, $colegasAtivos, $totalDeCovid)
    {
        $resultados = array();
        foreach ($data as $dt) {
            $porcentagem = ($totalDeCovid[$dt->hospital_id]/$colegasAtivos[$dt->hospital_id])*100;
            $resultados[$dt->hospital_id] = number_format($porcentagem, 2, ',', '').'%';
        }
        $porcentagem = ($totalDeCovid['total']/$colegasAtivos['total'])*100;
        $resultados['total'] = number_format($porcentagem, 2, ',', '').'%';

		return $resultados;
    }
}
