<?php

namespace App\Services\Graficos;

use App\Models\Datas;
use Illuminate\Support\Carbon;

class CidService
{
    public static function colagasComAtestados($esteMes, $hospitais)
    {
        $data = Datas::where('cod', 'AT')
        ->where('data_inicial', '<=', $esteMes['final'])
        ->where('data_inicial', '>=', $esteMes['inicial'])
        ->join('colegas', 'datas.colegas_id', '=', 'colegas.id')
        ->join('hospitais', 'colegas.hospitais_id', '=', 'hospitais.id')
        ->join('cid_categoria', 'datas.cid_categoria_id', '=', 'cid_categoria.id')
        ->whereIn('hospitais.id', $hospitais)
        ->select(
            'colegas.nome',
            'colegas.hospitais_id as hospital_id',
            'hospitais.nome as hospital_nome',
            'cid_categoria.id as cid_id',
            'cid_categoria.nome as cid_nome',
            'cid_categoria.inicio as cid_categoria_inicio',
            'cid_categoria.fim as cid_categoria_fim',
            'datas.cids_id as cid_antigo',
            'datas.data_inicial',
            'datas.dias_atestado',
            'datas.data_final',
            'datas.data_de_contato'
        )
        ->get();

		return $data;
    }

    /**
     *  Dados da coluna "Quantidade atestados"
     *  Retorna {"cid_id": quantidade,...}
     */
    public static function totalDeAtestados($data)
    {
        $resultados = array();
        $resultados['total'] = 0;
        foreach ($data as $dt) {
            if (isset($resultados[$dt->cid_id])) {
                $resultados[$dt->cid_id] = $resultados[$dt->cid_id] + 1;
            } else {
                $resultados[$dt->cid_id] = 1;
            }
            $resultados['total']++;
        }

		return $resultados;
    }

    /**
     *  Dados da coluna "Quantidade dias perdidos mês"
     *  Retorna {"cid_id": quantidade,...}
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
                $resultados[$dt->cid_id] = isset($resultados[$dt->cid_id]) ? $resultados[$dt->cid_id] + $diffInDays : $diffInDays;
                $resultados['total']++;
            } else {
                $resultados[$dt->cid_id] = isset($resultados[$dt->cid_id]) ? $resultados[$dt->cid_id] : 0;
            }
        }

		return $resultados;
    }
}
