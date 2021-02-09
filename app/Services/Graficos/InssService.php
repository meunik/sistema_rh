<?php

namespace App\Services\Graficos;

use App\Models\Datas;

class InssService
{
    public static function colagasAfastados($hospitais)
    {
        $data = Datas::whereIn('hospitais.id', $hospitais)
        ->join('colegas', 'datas.colegas_id', '=', 'colegas.id')
        ->join('hospitais', 'colegas.hospitais_id', '=', 'hospitais.id')
        ->select(
            'colegas.nome',
            'colegas.hospitais_id as hospital_id',
            'hospitais.nome as hospital_nome',
            'datas.encaminhado_inss',
            'datas.data_inicial',
            'datas.retornou',
            'datas.cod'
        )
        ->get();

		return $data;
    }

    /**
     *  Dados da coluna "Total Afastados pelo INSS"
     *  Retorna {"hospital_id": quantidade,...}
     */
    public static function totalDeAfastados($data)
    {
        $resultados = array();
        $resultados['total'] = 0;

        foreach ($data as $dt) {

            if (($dt->cod === 'INSS')&&($dt->retornou != 1)) {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] + 1 : 1;
                $resultados['total']++;
            } else {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] : 0;
            }
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "Afastados pelo INSS no período"
     *  Retorna {"hospital_id": quantidade,...}
     */
    public static function totalDeAfastadosPeriodo($data, $esteMes)
    {
        $resultados = array();
        $resultados['total'] = 0;

        foreach ($data as $dt) {
            if (($dt->data_inicial >= $esteMes['inicial'])&&($dt->data_inicial <= $esteMes['final'])) {
                $mes = true;
            } else {
                $mes = false;
            }

            if (($dt->cod === 'INSS')&&($mes === true)) {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] + 1 : 1;
                $resultados['total']++;
            } else {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] : 0;
            }
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "Colegas q retornaram de afastamento do INSS no período"
     *  Retorna {"hospital_id": quantidade,...}
     */
    public static function colegasRetornaramPeriodo($data, $esteMes)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if (($dt->data_inicial >= $esteMes['inicial'])&&($dt->data_inicial <= $esteMes['final'])) {
                $mes = true;
            } else {
                $mes = false;
            }

            if (($dt->cod === 'INSS')&&($dt->retornou === 1)&&($mes === true)) {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] + 1 : 1;
                $resultados['total']++;
            } else {
                $resultados[$dt->hospital_id] = isset($resultados[$dt->hospital_id]) ? $resultados[$dt->hospital_id] : 0;
            }
        }

		return $resultados;
    }
}
