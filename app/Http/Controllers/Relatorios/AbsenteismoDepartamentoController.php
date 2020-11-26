<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Services\ChartService;

use App\Models\{Colegas,Datas,Hospitais,UserHospitais};

class AbsenteismoDepartamentoController extends Controller
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

        $departamentos = ['MULTIDISCIPLINAR','APRENDIZ','ENFERMAGEM','SERVIÇOS GERAIS','ADMINISTRATIVO','MANUTENÇAO','ENFERMEIRO','MOTORISTA','MEDICO','ESTAGIARIO'];
        $resultados = [];


        foreach($departamentos as $departamento) {
            $query['inicial'] = $request->query('inicial');

            if($query['inicial'] == null) {
                $query['inicial'] = Carbon::today();
            } else {
                $query['inicial'] = Carbon::parse($query['inicial']);
            }

            if($query['tipo'] == 'TD') {
                $colegas = Colegas::whereNull('demissao')
                ->where('admissao','<=',$query['inicial'])
                ->where('secao',$departamento)
                ->whereIn('hospitais_id',$query['hospitais'])
                ->orWhere('demissao','>',$query['inicial'])
                ->where('admissao','<=',$query['inicial'])
                ->where('secao',$departamento)
                ->whereIn('hospitais_id',$query['hospitais'])
                ->select('id')
                ->get();
            } else {
                $colegas = Colegas::whereNull('demissao')
                ->where('admissao','<=',$query['inicial'])
                ->where('secao',$departamento)
                ->where('tipo',$query['tipo'])
                ->whereIn('hospitais_id',$query['hospitais'])
                ->orWhere('demissao','>',$query['inicial'])
                ->where('admissao','<=',$query['inicial'])
                ->where('secao',$departamento)
                ->where('tipo',$query['tipo'])
                ->whereIn('hospitais_id',$query['hospitais'])
                ->select('id')
                ->get();
            }

            $resultados[$departamento]['total_colegas'] = $colegas->count();
            $resultados[$departamento]['FA'] = 0;
            $resultados[$departamento]['AT'] = 0;
            $resultados[$departamento]['FE'] = 0;
            $resultados[$departamento]['FO'] = 0;
            $resultados[$departamento]['GR'] = 0;
            $resultados[$departamento]['CO-S'] = 0;
            $resultados[$departamento]['CO+'] = 0;
            $resultados[$departamento]['total_ausentes'] = 0;

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
                        $resultados[$departamento]['FA']++;
                        $resultados[$departamento]['total_ausentes']++;
                    } else if($data->cod == 'AT') {
                        $resultados[$departamento]['AT']++;
                        $resultados[$departamento]['total_ausentes']++;
                    } else if($data->cod == 'FE') {
                        $resultados[$departamento]['FE']++;
                        // $resultados[$departamento]['total_ausentes']++;
                    } else if($data->cod == 'FO') {
                        $resultados[$departamento]['FO']++;
                        // $resultados[$departamento]['total_ausentes']++;
                    } else if($data->cod == 'GR') {
                        $resultados[$departamento]['GR']++;
                        $resultados[$departamento]['total_ausentes']++;
                    } else if($data->cod == 'CO') {
                        if($data->covid == 'Suspeito') {
                            $resultados[$departamento]['CO-S']++;
                            $resultados[$departamento]['total_ausentes']++;
                        } else if ($data->covid == 'Confirmado') {
                            $resultados[$departamento]['CO+']++;
                            $resultados[$departamento]['total_ausentes']++;
                        }
                    }
                    }
            }
        }

        $chart = ChartService::porDepartamento($request);

        return view('relatorios.absenteismo-departamento',compact('hospitais','resultados','departamentos','chart'));
    }
}
