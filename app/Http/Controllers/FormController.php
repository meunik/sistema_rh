<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{DB, Auth};

use TJGazel\Toastr\Facades\Toastr;
use App\Services\DataseColegas;

use App\Models\{Datas, Colegas, Covid, Hospitais};

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $hospital = $request->query('hospital');
        $data = $request->query('data');
        $resultados = DataseColegas::colegasPorHosp($hospital,$data);
        $hospital = Hospitais::where('id',$hospital)->select('nome')->first();

        return view('forms.form', compact('resultados','hospital'));
    }
    public function form2(Request $request)
    {
        $hospital = $request->query('hospital');
        $data = $request->query('data');
        $resultados = DataseColegas::colegasPorHosp($hospital,$data);
        $hospital = Hospitais::where('id',$hospital)->select('nome')->first();

        return view('forms.form2', compact('resultados','hospital'));
    }
    public function getdata($hospital, $data)
    {
        $hospital = $request->query('hospital');
        $data = $request->query('data');
        $resultados = DataseColegas::colegasPorHosp($hospital,$data);
        $hospital = Hospitais::where('id',$hospital)->select('nome')->first();

        $result = [
            'resultados' => $resultados,
            'hospital' => $hospital
        ];

        return response()->json($result);
    }
    public function create(Request $request)
    {
        if(!$request->data_inicial) {
            return response()->json(['error' => 'Data não selecionada!'],404);
        }

        $exists = Datas::where([
            ['colegas_id', '=', $request->id],
            ['data_inicial', '=', $request->data_inicial]
        ])->exists();

        DB::beginTransaction();
        $userId = Auth::id();

        if (!$exists) {
            $data = Datas::create([
                'colegas_id' => $request->id,
                'data_inicial' => $request->data_inicial,
                'cod' => $request->cod,
                'medico' => $request->medico,
                'crm' => $request->crm,
                'created_by' => $userId,
                'updated_by' => $userId
            ]);
        } else {
            $data = Datas::where([
                ['colegas_id', '=', $request->id],
                ['data_inicial', '=', $request->data_inicial]
            ])->first();
            $data->updated_by = $userId;
        }

        $colegas = Colegas::where('id', $request->id)->first();

        if(isset($request->tipo)){$colegas->tipo = $request->tipo;}
        // if(isset($request->grupo_de_risco)){$colegas->grupo_de_risco = $request->grupo_de_risco;}
        // if(isset($request->telefone)){$colegas->telefone = $request->telefone;}
        if($request->cod == 'DE') {
            $colegas->demissao = $request->data_inicial;
        }
        $colegas->save();


        if ($request->cod === 'AT') {
            if(isset($request->data_final)){$data->data_final = $request->data_final;}
            if(isset($request->cids_id)){$data->cids_id = $request->cids_id;}
            if(isset($request->motivo)){$data->motivo = $request->motivo;}
            $data->save();
        }
        else if ($request->cod === 'FE') {
            if(isset($request->data_final)){$data->data_final = $request->data_final;}
            $data->save();
        }
        else if ($request->cod === 'CO') {
            if(isset($request->covid)){$data->covid = $request->covid;}
            if(isset($request->data_final)){$data->data_final = $request->data_final;}
            if(isset($request->observacao)){$data->observacao = $request->observacao;}
            $data->save();

            $covid = Covid::firstOrCreate(['colegas_id' => $request->id]);

            if($covid) {
                if(isset($request->data_dos_sintomas)){$covid->data_dos_sintomas = $request->data_dos_sintomas;}
                if(isset($request->data_do_teste)){$covid->data_do_teste = $request->data_do_teste;}
                if(isset($request->tipo_do_teste)){$covid->tipo_do_teste = $request->tipo_do_teste;}
                if(isset($request->observacao)){$covid->observacao = $request->observacao;}
                $covid->save();
            }
        }
        else if ($request->cod === 'GR') {
            if(isset($request->data_final)){$data->data_final = $request->data_final;}
            if(isset($request->observacao)){$data->observacao = $request->observacao;}
            if(isset($request->grupo_de_risco)){$data->grupo_de_risco = $request->grupo_de_risco;}
            $data->save();
        }

        if($data) {
            DB::commit();
            return response('Registrado com sucesso!');
        } else {
            DB::rollBack();
            return response()->json(['error' => 'Erro Desconhecido!'],404);
        }
    }
    public function update(Request $request)
    {
        $id = $request->id;

        $data = Datas::where('id',$id)->first();
        $userId = Auth::id();

        if($data) {
            if(isset($request->retornou)){$data->retornou = $request->retornou;}
            $data->updated_by = $userId;
            $data->save();

            return response()->json($data);
        } else {
            return response()->json(['error' => 'Erro Desconhecido!'],404);
        }
    }
    public function delete(Request $request)
    {
        $id = $request->id;

        try {
            $data = Datas::where('id',$id)->delete();

            return response()->json($data);
        } catch (\Exception $error) {
            return response()->json(['error' => 'Falha ao deletar!'],404);
        }
    }
    public function editTel(Request $request)
    {
        $colegas = Colegas::find($request->id);
        $colegas->telefone = $request->editTell_input;
        $colegas->save();
    }
}
