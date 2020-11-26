<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Services\ChartService;

use App\Models\{Colegas,Datas,Hospitais,UserHospitais};

class AbsenteismoUnidadeController extends Controller
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
        $query['final'] = $request->query('final');

        if($query['final'] == null) {
            $query['final'] = Carbon::today();
        } else {
            $query['final'] = Carbon::parse($query['final']);
        }

        $unidades = Hospitais::whereIn('id',$query['hospitais'])->select('id','nome')->get();
        $resultados = [];
        
        foreach($unidades as $unidade) {
            $query['inicial'] = $request->query('inicial');

            if($query['inicial'] == null) {
                $query['inicial'] = Carbon::today();
            } else {
                $query['inicial'] = Carbon::parse($query['inicial']);
            }

            if($query['tipo'] == 'TD') {
                $colegas = Colegas::whereNull('demissao')
                ->where('admissao','<=',$query['inicial'])
                ->where('hospitais_id',$unidade->id)
                ->orWhere('demissao','>',$query['inicial'])
                ->where('admissao','<=',$query['inicial'])
                ->where('hospitais_id',$unidade->id)
                ->select('id')
                ->get();
            } else {
                $colegas = Colegas::whereNull('demissao')
                ->where('admissao','<=',$query['inicial'])
                ->where('tipo',$query['tipo'])
                ->where('hospitais_id',$unidade->id)
                ->orWhere('demissao','>',$query['inicial'])
                ->where('admissao','<=',$query['inicial'])
                ->where('tipo',$query['tipo'])
                ->where('hospitais_id',$unidade->id)
                ->select('id')
                ->get();
            }

            $resultados[$unidade->nome]['total_colegas'] = $colegas->count();
            $resultados[$unidade->nome]['FA'] = 0;
            $resultados[$unidade->nome]['AT'] = 0;
            $resultados[$unidade->nome]['FE'] = 0;
            $resultados[$unidade->nome]['FO'] = 0;
            $resultados[$unidade->nome]['CO-S'] = 0;
            $resultados[$unidade->nome]['CO+'] = 0;
            $resultados[$unidade->nome]['GR'] = 0;
            $resultados[$unidade->nome]['total_ausentes'] = 0;
            
            foreach($colegas as $colega) {
                $data = Datas::whereBetween('data_inicial', [$query['inicial'], $query['final']])
                ->whereNotIn('cod',['DE','AT','CO','GR'])
                ->where('colegas_id',$colega->id)
                ->OrWhere('data_inicial','<=',$query['final'])
                ->where('data_final','>=', $query['inicial'])
                ->whereIn('cod',['AT','CO','GR'])
                ->where('colegas_id',$colega->id)
                ->OrWhere('data_inicial','<=',$query['final'])
                ->whereNull('data_final')
                ->whereIn('cod',['AT','CO','GR'])
                ->where('colegas_id',$colega->id)
                ->orderBy('id','DESC')
                ->first();

                if($data) {
                    if($data->cod == 'FA') {
                        $resultados[$unidade->nome]['FA']++;
                        $resultados[$unidade->nome]['total_ausentes']++;
                    } else if($data->cod == 'AT') {
                        $resultados[$unidade->nome]['AT']++;
                        $resultados[$unidade->nome]['total_ausentes']++;
                    } else if($data->cod == 'FE') {
                        $resultados[$unidade->nome]['FE']++;
                        // $resultados[$unidade->nome]['total_ausentes']++;
                    } else if($data->cod == 'FO') {
                        $resultados[$unidade->nome]['FO']++;
                        // $resultados[$unidade->nome]['total_ausentes']++;
                    } else if($data->cod == 'GR') {
                        $resultados[$unidade->nome]['GR']++;
                        $resultados[$unidade->nome]['total_ausentes']++;
                    } else if($data->cod == 'CO') {
                        if($data->covid == 'Suspeito') {
                            $resultados[$unidade->nome]['CO-S']++;
                            $resultados[$unidade->nome]['total_ausentes']++;
                        } else if ($data->covid == 'Confirmado') {
                            $resultados[$unidade->nome]['CO+']++;
                            $resultados[$unidade->nome]['total_ausentes']++;
                        }
                    }
                }
            }
        }
        
        $chart = ChartService::porUnidade($request);

        return view('relatorios.absenteismo-unidade',compact('hospitais','resultados','unidades','chart'));
    }
}
