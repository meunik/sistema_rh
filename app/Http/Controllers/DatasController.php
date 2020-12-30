<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Datas;

class DatasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $id = $request->query('id');

        $datas = Datas::where('colegas_id',$id)->get();

        return view('forms.datas', compact('datas'));
    }

    public function atestadoHistoricoDatas(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $dataHoje = date('Y-m-d', time());
        $dataRetroativa = date('Y-m-d', strtotime("-60 days"));

        $id = $request->query('id');

        $datas = Datas::where('colegas_id',$id)
        ->where('data_inicial', '<=', $dataHoje)
        ->where('data_inicial', '>=', $dataRetroativa)
        ->leftjoin('cid_subcategoria', 'cid_sub_categoria_id', '=', 'cid_subcategoria.id')
        ->leftjoin('colegas', 'colegas_id', '=', 'colegas.id')
        ->select(
            'datas.*',
            'cid_subcategoria.nome as cid_nome',
            'cid_subcategoria.categoria as cid_categoria',
            'colegas.nome'
        )
        ->get();

        return view('forms.atestadoHistoricoDatas', compact('datas'));
    }
}
