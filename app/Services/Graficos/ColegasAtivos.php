<?php

namespace App\Services\Graficos;

use App\Models\Colegas;

class ColegasAtivos
{
    public static function qtd()
    {
        $colegas = Colegas::join('hospitais', 'colegas.hospitais_id', '=', 'hospitais.id')
        ->select('colegas.id as colega_id', 'hospitais.id as hospital_id')
        ->get();

        $resultados = array();
        $resultados['total'] = 0;
        foreach ($colegas as $dt) {
            if (isset($resultados[$dt->hospital_id])) {
                $resultados[$dt->hospital_id] = $resultados[$dt->hospital_id] + 1;
            } else {
                $resultados[$dt->hospital_id] = 1;
            }
            $resultados['total']++;
        }

		return $resultados;
    }
}
