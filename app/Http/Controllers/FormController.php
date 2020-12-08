<?php

namespace App\Http\Controllers;

use App\Services\{DataseColegas, FormService};
use App\Models\{Datas, Colegas, Covid, Hospitais};

use Yajra\DataTables\DataTables;
use TJGazel\Toastr\Facades\Toastr;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{DB, Auth};

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
    public function getdata(Request $request)
    {
        $hospital = $request->query('hospital');
        $data = $request->query('data');
        $resultados = DataseColegas::colegasPorHosp($hospital,$data);
        $hospital = Hospitais::where('id',$hospital)->select('nome')->first();

        $result = [
            'resultados' => $resultados,
            'hospital' => $hospital
        ];

		return DataTables::of($resultados)->make(true);
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

        // if(isset($request->tipo)){$colegas->tipo = $request->tipo;}

        if(isset($request->tipo)){$data->tipo = $request->tipo;}
        if(isset($request->medico)){$data->medico = $request->medico;}
        if(isset($request->crm)){$data->crm = $request->crm;}
        if(isset($request->cod)){$data->cod = $request->cod;}

        if ($request->cod === 'AT') FormService::atestado($request, $data);
        if ($request->cod === 'FE') FormService::ferias($request, $data);
        if ($request->cod === 'DE') FormService::ferias($request, $colegas);
        if ($request->cod === 'CO') FormService::covid($request, $data);
        if ($request->cod === 'GR') FormService::grupoDeRisco($request, $data);
        $data->save();

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
