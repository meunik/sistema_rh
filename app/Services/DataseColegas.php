<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Hospitais;
use App\Models\UserHospitais;
use App\Models\Colegas;
use App\Models\Datas;

class DataseColegas
{
    public static function colegasComDatas($request)
    {
        $query['hospitais'] = $request->query('hospitais');
        if($query['hospitais'] != "TD") {
            $query['hospitais'] = explode(',', $query['hospitais']);
        }

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

        if($query['tipo'] != 'TD') {
            if($query['hospitais'] != "TD") {
                $colegas = Colegas::whereIn('hospitais_id',$query['hospitais'])->where('tipo',$query['tipo'])->get();
            } else {
                $colegas = Colegas::
            where('tipo',$query['tipo'])
            ->get();
            }

        } else {
            if($query['hospitais'] != "TD") {
                $colegas = Colegas::whereIn('hospitais_id',$query['hospitais'])
            ->get();
            } else {
                $colegas = Colegas::all();
            }

        }

        $resultados = [];
        $datas = [];

        foreach($colegas as $colega) {
            $resultados[$colega->nome]['tipo_clinica'] = $colega->hospital->tipo;
            $resultados[$colega->nome]['responsavel'] = [];
            $responsaveis = UserHospitais::where('hospitais_id',$colega->hospital->id)->get();
            foreach($responsaveis as $responsavel) {
                if($responsavel->user->is_admin == 'CL') {
                    array_push($resultados[$colega->nome]['responsavel'],$responsavel->user->name);
                }
            }
            $resultados[$colega->nome]['coligada'] = $colega->hospital->coligada->nome;
            $resultados[$colega->nome]['filial_cod'] =  $colega->hospital->cod_filial;
            $resultados[$colega->nome]['filial_nome'] =  $colega->hospital->nome;
            $resultados[$colega->nome]['local'] =  $colega->hospital->local;
            $resultados[$colega->nome]['inicio_clinica'] =  $colega->hospital->dt_inicio;
            $resultados[$colega->nome]['chapa'] = $colega->chapa;
            $resultados[$colega->nome]['data_de_nascimento'] = $colega->data_de_nascimento;
            $resultados[$colega->nome]['idade'] = $colega->idade;
            $resultados[$colega->nome]['centro_de_custo'] = $colega->centro_de_custo;
            $resultados[$colega->nome]['situacao'] = $colega->situacao;
            $resultados[$colega->nome]['funcao'] = $colega->funcao;
            $resultados[$colega->nome]['admissao'] = $colega->admissao;
            $resultados[$colega->nome]['demissao'] = $colega->demissao;
            $resultados[$colega->nome]['secao'] = $colega->secao;
            $resultados[$colega->nome]['codigo_horario'] = $colega->codigo_horario;
            $resultados[$colega->nome]['horario'] = $colega->horario;
            $resultados[$colega->nome]['demissao_cod'] = $colega->demissao_cod;
            $resultados[$colega->nome]['demissao_tipo'] = $colega->demissao_tipo;
            $resultados[$colega->nome]['jornada'] = $colega->jornada;
            $resultados[$colega->nome]['data_inicio_afastamento'] = '';
            $resultados[$colega->nome]['data_final_atestado'] = '';
            $resultados[$colega->nome]['classificacao'] = $colega->classificacao;
            $resultados[$colega->nome]['dias_de_atestado'] = 0;
            $resultados[$colega->nome]['data_dos_sintomas'] = '';
            $resultados[$colega->nome]['data_do_teste'] = '';
            $resultados[$colega->nome]['tipo_do_teste'] = '';
            $resultados[$colega->nome]['telefone'] = $colega->telefone;
            $resultados[$colega->nome]['observacao'] = '';
            $resultados[$colega->nome]['assistente_social'] = '';
            $resultados[$colega->nome]['grupo_de_risco'] = $colega->grupo_de_risco;
            $resultados[$colega->nome]['retornou'] = "";
        }

        for($query['inicial'];$query['inicial'] <= $query['final'];$query['inicial']->add(1, 'day')) {
            $i = $query['inicial']->isoFormat('DD/MM/YYYY');

            foreach($colegas as $colega) {
                $data = Datas::where('data_inicial',$query['inicial'])
                ->whereNotIn('cod',['DE','CO'])
                ->where('colegas_id',$colega->id)
                ->OrWhere('data_inicial','<',$query['inicial'])
                ->where('data_final','>=', $query['inicial'])
                ->whereNotIn('cod',['DE','CO'])
                ->where('colegas_id',$colega->id)
                ->OrWhere('data_inicial','<=',$query['inicial'])
                ->where('cod','CO')
                ->where('colegas_id',$colega->id)
                ->OrWhere('data_inicial','<=',$query['inicial'])
                ->whereNull('data_final')
                ->whereIn('cod',['AT','CO'])
                ->where('colegas_id',$colega->id)
                ->orderBy('id','DESC')
                ->first();

                $resultados[$colega->nome]['datas'][$i]['cod'] = 'X';

                if($colega->demissao != null && $colega->demissao <= $query['inicial']) {
                    $resultados[$colega->nome]['datas'][$i]['cod'] = 'DE';
                } else if($data) {
                    if($data->cod == 'FA') {
                        $resultados[$colega->nome]['datas'][$i]['cod'] = 'FA';
                    } else if($data->cod == 'AT') {
                        $resultados[$colega->nome]['datas'][$i]['cod'] = 'AT';
                        $resultados[$colega->nome]['data_inicio_afastamento'] = $data->data_inicial;
                        $resultados[$colega->nome]['data_final_atestado'] = $data->data_final;
                        $inicio = Carbon::parse($data->data_inicial);
                        if($data->data_final) {
                            $fim = Carbon::parse($data->data_final);
                            $resultados[$colega->nome]['dias_de_atestado'] = $inicio->diffInDays($fim)+1;
                            if($data->retornou != 0 && $data->data_final < Carbon::now()) {
                                $resultados[$colega->nome]['retornou'] = "warning";
                            } else {
                                $resultados[$colega->nome]['retornou'] = "danger";
                            }
                        } else {
                            $resultados[$colega->nome]['dias_de_atestado'] = $inicio->diffInDays($query['final'])+1;
                            $resultados[$colega->nome]['retornou'] = "warning";
                        }
                    } else if($data->cod == 'FE') {
                        $resultados[$colega->nome]['datas'][$i]['cod'] = 'FE';
                    } else if($data->cod == 'FO') {
                        $resultados[$colega->nome]['datas'][$i]['cod'] = 'FO';
                    } else if($data->cod == 'CO') {
                        if(!$data->retornou) {
                            if($data->covid == 'Suspeito') {
                                $resultados[$colega->nome]['datas'][$i]['cod'] = 'CO-S';
                            } else if ($data->covid == 'Confirmado') {
                                $resultados[$colega->nome]['datas'][$i]['cod'] = 'CO+';
                            }
                            $inicio = Carbon::parse($data->data_inicial);
                            if($data->data_final) {
                                $fim = Carbon::parse($data->data_final);
                                $resultados[$colega->nome]['dias_de_atestado'] = $inicio->diffInDays($fim)+1;
                                if($data->retornou != 0 && $data->data_final < Carbon::now()) {
                                    $resultados[$colega->nome]['retornou'] = "warning";
                                } else {
                                    $resultados[$colega->nome]['retornou'] = "danger";
                                }
                            } else {
                                $resultados[$colega->nome]['dias_de_atestado'] = $inicio->diffInDays($query['final'])+1;
                                $resultados[$colega->nome]['retornou'] = "warning";
                            }
                            $resultados[$colega->nome]['data_inicio_afastamento'] = $data->data_inicial;
                            $resultados[$colega->nome]['data_final_atestado'] = $data->data_final;
                            $resultados[$colega->nome]['data_dos_sintomas'] = $data->resultado->data_dos_sintomas;
                            $resultados[$colega->nome]['data_do_teste'] = $data->resultado->data_do_teste;
                            $resultados[$colega->nome]['tipo_do_teste'] = $data->resultado->tipo_do_teste;
                            $resultados[$colega->nome]['observacao'] =  $data->resultado->observacao;
                        } else {
                            $resultados[$colega->nome]['datas'][$i]['cod'] = 'X';
                        }
                    } else {
                        $resultados[$colega->nome]['datas'][$i]['cod'] = 'X';
                    }
                } else {
                    $resultados[$colega->nome]['datas'][$i]['cod'] = 'X';
                }
            }

            array_push($datas,$i);
        }

        $return['resultados'] = $resultados;
        $return['datas'] = $datas;

        return $return;
    }
    public static function colegas()
    {
        if (Auth::user()->id === 1) {
            $hospitais = Hospitais::select('id')->get();
        } else {
            $hospitais = Hospitais::select('id')->where('users_id', Auth::user()->id)->get();
        }

        echo $hospitais;
        exit;
        foreach ($hospitais as $hosp) {
            $hospIds[] = $hosp->id;
        }

        $datas = Datas::leftjoin('colegas', 'colegas_id', '=', 'colegas.id')
        ->whereIn('colegas.hospitais_id',$hospIds)
        ->select('datas.id','datas.colegas_id','colegas.nome')
        ->get();

        foreach ($datas as $data) {
            $resultados[$data->nome]['nome'] = $data->nome;
        }

        return $resultados;
    }
    public static function colegasPorHosp($hospital,$data)
    {
        $resultados = Colegas::where('hospitais_id',$hospital)
        ->where('hospitais_id','!=','')
        ->leftJoin('covid', 'colegas.id', '=', 'covid.colegas_id')
        ->leftJoin('datas', function($join) use ($data) {
            $join->on('colegas.id', '=', 'datas.colegas_id')
            ->where("datas.data_inicial","=",$data)
            ->leftJoin('cids', 'datas.cids_id', '=', 'cids.id');
        })
        ->select('colegas.*',
        'covid.data_dos_sintomas',
        'covid.data_do_teste',
        'covid.tipo_do_teste',
        'covid.observacao',
        'cids.nome as cid',
        'datas.id as data_id',
        'datas.cod',
        'datas.medico',
        'datas.crm',
        'datas.cids_id',
        'datas.cid_categoria_id',
        'datas.cid_sub_categoria_id',
        'datas.data_inicial',
        'datas.dias_atestado',
        'datas.data_final',
        'datas.motivo',
        'datas.motivoSelect',
        'datas.covid')
        ->orderBy('colegas.nome')
        ->get();

        return $resultados;
    }
}
