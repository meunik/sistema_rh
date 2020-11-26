<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\{Colegas,Datas,Hospitais,UserHospitais};

class DiasAfastamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if (Auth::user()->is_admin == 'AD') {
            $hospitais = Hospitais::select('id','nome')->orderBy('nome')->get();
        } else {
            $hospitais = UserHospitais::leftjoin('hospitais', 'hospitais_id', '=', 'hospitais.id')
                ->where('users_hospitais.users_id', Auth::user()->id)
                ->select('hospitais.id','hospitais.nome')
                ->orderBy('hospitais.nome')
                ->get();
        }

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

        $resultados = [];

        $resultados['RET']['AT'] = 0;
        $resultados['RET']['CO-S'] = 0;
        $resultados['RET']['CO+'] = 0;

        $resultados['AF']['AT'] = 0;
        $resultados['AF']['CO-S'] = 0;
        $resultados['AF']['CO+'] = 0;

        $resultados['AF-C']['AT'] = 0;
        $resultados['AF-C']['CO-S'] = 0;
        $resultados['AF-C']['CO+'] = 0;

        $retornaram = Datas::whereIn('cod',['AT','CO'])
        ->whereBetween('data_final',[$query['inicial'],$query['final']])
        ->where('retornou',1)
        ->select('colegas_id')
        ->groupBy('colegas_id')
        ->get();

        foreach($retornaram as $retornou) {
            $data = Datas::whereIn('cod',['AT','CO'])
            ->whereBetween('data_final',[$query['inicial'],$query['final']])
            ->where('retornou',1)
            ->where('colegas_id',$retornou->colegas_id)
            ->first();

            if($data->colega->demissao == null || $data->colega->demissao > $query['final']) {
                if($data->cod == 'AT') {
                    $resultados['RET']['AT']++;
                } else if($data->cod == 'CO') {
                    if($data->covid == 'Suspeito') {
                        $resultados['RET']['CO-S']++;
                    } else if ($data->covid == 'Confirmado') {
                        $resultados['RET']['CO+']++;
                    }
                }
            }
        }

        $resultados['RET']['TOTAL'] = $resultados['RET']['AT'] + $resultados['RET']['CO-S'] + $resultados['RET']['CO+'];
        
        $afastaram = Datas::whereIn('cod',['AT','CO'])
        ->whereBetween('data_inicial',[$query['inicial'],$query['final']])
        ->where('retornou','!=',1)
        ->select('colegas_id')
        ->groupBy('colegas_id')
        ->get();

        foreach($afastaram as $afastou) {
            $data = Datas::whereIn('cod',['AT','CO'])
            ->whereBetween('data_inicial',[$query['inicial'],$query['final']])
            ->where('retornou','!=',1)
            ->where('colegas_id',$afastou->colegas_id)
            ->first();
            
            if($data->colega->demissao == null || $data->colega->demissao > $query['final']) {
                if($data->cod == 'AT') {
                    $resultados['AF']['AT']++;
                } else if($data->cod == 'CO') {
                    if($data->covid == 'Suspeito') {
                        $resultados['AF']['CO-S']++;
                    } else if ($data->covid == 'Confirmado') {
                        $resultados['AF']['CO+']++;
                    }
                }
            }
        }

        $resultados['AF']['TOTAL'] = $resultados['AF']['AT'] + $resultados['AF']['CO-S'] + $resultados['AF']['CO+'];

        $continuam = Datas::whereIn('cod',['AT','CO'])
        ->where('data_inicial','<',$query['inicial'])
        ->where('retornou','!=',1)
        ->select('colegas_id')
        ->groupBy('colegas_id')
        ->get();

        foreach($continuam as $continua) {
            $data = Datas::whereIn('cod',['AT','CO'])
            ->where('data_inicial','<',$query['inicial'])
            ->where('retornou','!=',1)
            ->where('colegas_id',$continua->colegas_id)
            ->first();
            
            if($data->colega->demissao == null || $data->colega->demissao > $query['final']) {
                if($data->cod == 'AT') {
                    $resultados['AF-C']['AT']++;
                } else if($data->cod == 'CO') {
                    if($data->covid == 'Suspeito') {
                        $resultados['AF-C']['CO-S']++;
                    } else if ($data->covid == 'Confirmado') {
                        $resultados['AF-C']['CO+']++;
                    }
                }
            }
        }

        $resultados['AF-C']['TOTAL'] = $resultados['AF-C']['AT'] + $resultados['AF-C']['CO-S'] + $resultados['AF-C']['CO+'];
        
        return view('relatorios.dias-afastamento',compact('hospitais','resultados'));
    }
}
