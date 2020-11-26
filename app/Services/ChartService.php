<?php

namespace App\Services;

use Illuminate\Support\Carbon;

use App\Models\{Colegas,Datas,Hospitais};

class ChartService
{
    public static function porDepartamento($request)
    {
        $query['hospitais'] = $request->query('hospitais');
        $query['hospitais'] = explode(',', $query['hospitais']);
        $query['tipo'] = $request->query('tipo');
        $query['final'] = $request->query('final');

        $query['inicial'] = $request->query('inicial');

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

        $departamentos = ['MULTIDISCIPLINAR','APRENDIZ','ENFERMAGEM','SERVIÇOS GERAIS','ADMINISTRATIVO','MANUTENÇAO','ENFERMEIRO','MOTORISTA','MEDICO','ESTAGIARIO'];
        $chart = [];

        for($query['inicial'];$query['inicial'] <= $query['final']; $query['inicial']->add(1, 'day')) {
            $i = $query['inicial']->isoFormat('DD/MM/YYYY');

            foreach($departamentos as $departamento) {

                $chart[$i][$departamento] = 0;

                $colegas = Colegas::whereNull('demissao')
                ->where('admissao','<=',$query['inicial'])
                ->where('secao',$departamento)
                ->where(function($where) use ($query)
                {
                    if ($query['tipo'] != 'TD') {
                        $where->where('tipo',$query['tipo']);
                    }
                })
                ->whereIn('hospitais_id',$query['hospitais'])
                ->orWhere('demissao','>',$query['inicial'])
                ->where('admissao','<=',$query['inicial'])
                ->where('secao',$departamento)
                ->where(function($where) use ($query)
                {
                    if ($query['tipo'] != 'TD') {
                        $where->where('tipo',$query['tipo']);
                    }
                })
                ->whereIn('hospitais_id',$query['hospitais'])
                ->select('id')
                ->get();

                foreach($colegas as $colega) {
                    $data = Datas::where('data_inicial',$query['inicial'])
                    ->whereNotIn('cod',['DE','AT','CO','GR'])
                    ->where('colegas_id',$colega->id)
                    ->OrWhere('data_inicial','<=',$query['inicial'])
                    ->where('data_final','>=', $query['inicial'])
                    ->whereIn('cod',['AT','CO','GR'])
                    ->where('colegas_id',$colega->id)
                    ->OrWhere('data_inicial','<=',$query['inicial'])
                    ->whereNull('data_final')
                    ->whereIn('cod',['AT','CO','GR'])
                    ->where('colegas_id',$colega->id)
                    ->orderBy('id','DESC')
                    ->first();

                    if($data) {
                        $chart[$i][$departamento]++;
                    }
                }
                    
                if($colegas->count() > 0) {
                    $chart[$i][$departamento]= ($chart[$i][$departamento] / $colegas->count())*100;
                }
            }
        }
    
        return $chart;
    }
    public static function porUnidade($request)
    {
        $query['hospitais'] = $request->query('hospitais');
        $query['hospitais'] = explode(',', $query['hospitais']);
        $query['tipo'] = $request->query('tipo');
        $query['final'] = $request->query('final');

        $query['inicial'] = $request->query('inicial');

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

        $unidades = Hospitais::whereIn('id',$query['hospitais'])->select('id','nome')->get();
        $chart = [];

        for($query['inicial'];$query['inicial'] <= $query['final']; $query['inicial']->add(1, 'day')) {
            $i = $query['inicial']->isoFormat('DD/MM/YYYY');

            foreach($unidades as $unidade) {

                $chart[$i][$unidade->nome] = 0;

                $colegas = Colegas::whereNull('demissao')
                ->where('admissao','<=',$query['inicial'])
                ->where('hospitais_id',$unidade->id)
                ->where(function($where) use ($query)
                {
                    if ($query['tipo'] != 'TD') {
                        $where->where('tipo',$query['tipo']);
                    }
                })
                ->whereIn('hospitais_id',$query['hospitais'])
                ->orWhere('demissao','>',$query['inicial'])
                ->where('admissao','<=',$query['inicial'])
                ->where('hospitais_id',$unidade->id)
                ->where(function($where) use ($query)
                {
                    if ($query['tipo'] != 'TD') {
                        $where->where('tipo',$query['tipo']);
                    }
                })
                ->whereIn('hospitais_id',$query['hospitais'])
                ->select('id')
                ->get();

                foreach($colegas as $colega) {
                    $data = Datas::where('data_inicial',$query['inicial'])
                    ->whereNotIn('cod',['DE','AT','CO','GR'])
                    ->where('colegas_id',$colega->id)
                    ->OrWhere('data_inicial','<=',$query['inicial'])
                    ->where('data_final','>=', $query['inicial'])
                    ->whereIn('cod',['AT','CO','GR'])
                    ->where('colegas_id',$colega->id)
                    ->OrWhere('data_inicial','<=',$query['inicial'])
                    ->whereNull('data_final')
                    ->whereIn('cod',['AT','CO','GR'])
                    ->where('colegas_id',$colega->id)
                    ->orderBy('id','DESC')
                    ->first();

                    if($data) {
                        $chart[$i][$unidade->nome]++;
                    }
                }
                    
                if($colegas->count() > 0) {
                    $chart[$i][$unidade->nome]= ($chart[$i][$unidade->nome] / $colegas->count())*100;
                }
            }
        }
        
        return $chart;
    }
}
