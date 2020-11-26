<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Services\ChartService;

use App\Models\{Colegas,Datas,Hospitais,UserHospitais};

class AbsenteismoTotalController extends Controller
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

        for($query['inicial'];$query['inicial'] <= $query['final']; $query['inicial']->add(1, 'day')) {
            $i = $query['inicial']->isoFormat('DD/MM/YYYY');

            if($query['tipo'] == 'TD') {
                $colegas = Colegas::whereNull('demissao')
                ->where('admissao','<=',$query['inicial'])
                ->whereIn('hospitais_id',$query['hospitais'])
                ->orWhere('demissao','>',$query['inicial'])
                ->where('admissao','<=',$query['inicial'])
                ->whereIn('hospitais_id',$query['hospitais'])
                ->select('id')
                ->get();

                $resultados[$i]['total'] = $colegas->count();

            } else {
                $colegas = Colegas::whereNull('demissao')
                ->where('admissao','<=',$query['inicial'])
                ->where('tipo',$query['tipo'])
                ->whereIn('hospitais_id',$query['hospitais'])
                ->orWhere('demissao','>',$query['inicial'])
                ->where('admissao','<=',$query['inicial'])
                ->where('tipo',$query['tipo'])
                ->whereIn('hospitais_id',$query['hospitais'])
                ->select('id')
                ->get();

                $resultados[$i]['total'] = $colegas->count();
            }


            $resultados[$i]['FA'] = 0;
            $resultados[$i]['AT'] = 0;
            $resultados[$i]['FE'] = 0;
            $resultados[$i]['FO'] = 0;
            $resultados[$i]['GR'] = 0;
            $resultados[$i]['covid_suspeita'] = 0;
            $resultados[$i]['covid_confirmado'] = 0;
            $resultados[$i]['total_covid'] = 0;
            $resultados[$i]['total_ausentes'] = 0;

            $datas = Datas::where('data_inicial',$query['inicial'])
                ->whereNotIn('cod',['DE','CO','GR'])
                ->whereIn('colegas_id',$colegas)
                ->OrWhere('data_inicial','<',$query['inicial'])
                ->where('data_final','>=', $query['inicial'])
                ->whereIn('colegas_id',$colegas)
                ->OrWhere('data_inicial','<=',$query['inicial'])
                ->whereNull('data_final')
                ->whereIn('cod',['AT','CO','GR'])
                ->whereIn('colegas_id',$colegas)
                ->select('colegas_id')
                ->groupBy('colegas_id')
                ->get();


            foreach($datas as $data) {
                $colega = Datas::where('data_inicial',$query['inicial'])
                ->whereNotIn('cod',['DE','CO','GR'])
                ->where('colegas_id',$data->colegas_id)
                ->OrWhere('data_inicial','<',$query['inicial'])
                ->where('data_final','>=', $query['inicial'])
                ->where('colegas_id',$data->colegas_id)
                ->OrWhere('data_inicial','<=',$query['inicial'])
                ->whereNull('data_final')
                ->whereIn('cod',['AT','CO','GR'])
                ->where('colegas_id',$data->colegas_id)
                ->orderBy('id','DESC')
                ->first();


                if($colega->cod == 'FA') {
                    $resultados[$i]['total_ausentes']++;
                    $resultados[$i]['FA']++;
                } else if($colega->cod == 'AT') {
                    $resultados[$i]['total_ausentes']++;
                    $resultados[$i]['AT']++;
                } else if($colega->cod == 'FE') {
                    // $resultados[$i]['total_ausentes']++;
                    $resultados[$i]['FE']++;
                } else if($colega->cod == 'FO') {
                    // $resultados[$i]['total_ausentes']++;
                    $resultados[$i]['FO']++;
                } else if($colega->cod == 'CO') {
                    if($colega->covid == 'Suspeito') {
                        $resultados[$i]['total_ausentes']++;
                        $resultados[$i]['total_covid']++;
                        $resultados[$i]['covid_suspeita']++;
                    } else if ($colega->covid == 'Confirmado') {
                        $resultados[$i]['total_ausentes']++;
                        $resultados[$i]['total_covid']++;
                        $resultados[$i]['covid_confirmado']++;
                    }
                }else if($colega->cod == 'GR') {
                    $resultados[$i]['total_ausentes']++;
                    $resultados[$i]['GR']++;
                }
            }

        }

        $selecionados = Hospitais::select('id','nome')->whereIn('id',$query['hospitais'])->orderBy('nome')->get();

        return view('relatorios.absenteismo-total',compact('hospitais','resultados','selecionados'));
    }
}
