<?php

namespace App\Http\Controllers\Relatorios;

use App\Models\Datas;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\FiltroService;
use App\Http\Controllers\Controller;

class DiasAfastamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $hospitais = UserService::hospitaisVinculados();
        $query = FiltroService::datasTabelaAfastados($request);

        $resultados = [];

        $resultados['RET'] = $this->retornaramAndAfastaram($query, '=', 'data_final');
        $resultados['AF'] = $this->retornaramAndAfastaram($query, '!=', 'data_inicial');
        $resultados['AF-C'] = $this->continuamAfastados($resultados, $query);

        return view('relatorios.dias-afastamento',compact('hospitais','resultados'));
    }

    public function retornaramAndAfastaram($query, $sinal, $tipoData)
    {
        $resultados['AT'] = 0;
        $resultados['CO-S'] = 0;
        $resultados['CO+'] = 0;

        $retornaram = Datas::whereIn('cod', ['AT','CO'])
        ->whereBetween($tipoData, [$query['inicial'], $query['final']])
        ->where('retornou', $sinal, 1)
        ->select('colegas_id')
        ->groupBy('colegas_id')
        ->get();

        foreach($retornaram as $retornou) {
            $data = Datas::whereIn('cod', ['AT','CO'])
            ->whereBetween($tipoData, [$query['inicial'], $query['final']])
            ->where('retornou', $sinal, 1)
            ->where('colegas_id', $retornou->colegas_id)
            ->first();

            if($data->colega->demissao == null || $data->colega->demissao > $query['final']) {

                if($data->cod == 'AT') {
                    $resultados['AT']++;
                } else if($data->cod == 'CO') {

                    if($data->covid == 'Suspeito') {
                        $resultados['CO-S']++;
                    } else if ($data->covid == 'Confirmado') {
                        $resultados['CO+']++;
                    }

                }

            }
        }

        $resultados['TOTAL'] = $resultados['AT'] + $resultados['CO-S'] + $resultados['CO+'];

        return $resultados;
    }

    public function continuamAfastados($resultados, $query)
    {
        $ress['AT'] = 0;
        $ress['CO-S'] = 0;
        $ress['CO+'] = 0;

        $continuam = Datas::whereIn('cod',['AT','CO'])
        ->where('data_inicial','<',$query['inicial'])
        ->where('retornou', '!=', 1)
        ->select('colegas_id')
        ->groupBy('colegas_id')
        ->get();

        foreach($continuam as $continua) {
            $data = Datas::whereIn('cod', ['AT','CO'])
            ->where('data_inicial', '<', $query['inicial'])
            ->where('retornou', '!=', 1)
            ->where('colegas_id', $continua->colegas_id)
            ->first();

            if($data->colega->demissao == null || $data->colega->demissao > $query['final']) {

                if($data->cod == 'AT') {
                    $ress['AT']++;
                } else if($data->cod == 'CO') {

                    if($data->covid == 'Suspeito') {
                        $ress['CO-S']++;
                    } else if ($data->covid == 'Confirmado') {
                        $ress['CO+']++;
                    }

                }

            }
        }

        $ress['AT'] = ($ress['AT'] - $resultados['RET']['AT']) + $resultados['AF']['AT'];
        $ress['CO-S'] = ($ress['CO-S'] - $resultados['RET']['CO-S']) + $resultados['AF']['CO-S'];
        $ress['CO+'] = ($ress['CO+'] - $resultados['RET']['CO+']) + $resultados['AF']['CO+'];

        $ress['TOTAL'] = $ress['AT'] + $ress['CO-S'] + $ress['CO+'];

        return $ress;
    }
}
