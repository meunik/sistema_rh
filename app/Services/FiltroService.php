<?php

namespace App\Services;

use Illuminate\Support\Carbon;

/**
 *  Criado 05/01/2021, por isso poucos lugares ultilizam esse Service
 *  ultilizado {
 *      App\Http\Controllers\Relatorios\DiasAfastamentoController,
 *  }
 */
class FiltroService
{
    /**
     *  Filtra por datas
     */
    public static function datasTabelaAfastados($request)
    {
        $query['hospitais'] = $request->query('hospitais');
        $query['hospitais'] = explode(',', $query['hospitais']);
        $query['tipo'] = $request->query('tipo');
        $query['inicial'] = $request->query('inicial');
        $query['final'] = $request->query('final');

        if($query['inicial'] == null) {
            $query['inicial'] = Carbon::today();
        } else {
            $query['inicial'] = Carbon::parse($query['inicial']);
        }

        if($query['final'] == null) {
            $query['final'] = Carbon::today();
        } else {
            $query['final'] = Carbon::parse($query['final']);
        }

        return $query;
    }
}
