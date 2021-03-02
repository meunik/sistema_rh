<?php

namespace App\Http\Controllers\Relatorios;

use App\Models\Hospitais;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\{Colegas, Vacinas};
use App\Http\Controllers\Controller;

class VacinasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $id = $request->query('id');
        $hospitalId = $request->query('hospital');
        $hospital = Hospitais::where('id',$hospitalId)->select('nome')->first();

        return view('relatorios.vacinas', compact('hospital'));
    }

    /**
     * Cria uma tabela
     */
    public function vacinaTabela(Request $request)
    {
        $id = $request->query('id');
        return view('forms.vacina', compact('id'));
    }

    /**
     * Retorna os dados para "form"
     */
    public function vacinaData(Request $request)
    {
        $id = $request->query('id');
        $resultados = Colegas::where('colegas.id', $id)
        ->leftJoin('hospitais', 'colegas.hospitais_id', '=', 'hospitais.id')
        ->leftJoin('vacinas', 'colegas.id', '=', 'vacinas.colegas_id')
        ->select(
            'colegas.id as colega_id',
            'colegas.nome',
            'colegas.funcao',
            'colegas.secao',
            'hospitais.nome as unidade',
            'hospitais.id as hospitais_id',
            'vacinas.*'
        )
        ->get();
        return $resultados;
    }

    /**
     * Retorna os dados para "relatorio/vacinas"
     */
    public function vacinaDataTable(Request $request)
    {
        $id = $request->query('id');
        $resultados = Colegas::where('hospitais.id', $id)
        ->leftJoin('hospitais', 'colegas.hospitais_id', '=', 'hospitais.id')
        ->leftJoin('vacinas', 'colegas.id', '=', 'vacinas.colegas_id')
        ->select(
            'colegas.id as colega_id',
            'colegas.nome',
            'colegas.funcao',
            'colegas.secao',
            'hospitais.nome as unidade',
            'hospitais.id as hospitais_id',
            'vacinas.*'
        )
        ->get();
		return DataTables::of($resultados)->make(true);
    }

    /**
     * Dados para inserir na tabela
     */
    public function vacinaSave(Request $request)
    {
        $stringId = $request->stringId;
        $value = $request->value;
        $id = $request->id;

        $exists = Vacinas::where('colegas_id', $id)->exists();

        if ($exists != true) {
            $arrCreate = ['colegas_id' => $id];
            for ($i=0; $i < count($stringId); $i++) {
                $arrCreate[$stringId[$i]] = $value[$i];
            }
            $vacina = Vacinas::create($arrCreate);
        } else {
            $vacina = Vacinas::where('colegas_id', $id)->first();
            for ($i=0; $i < count($stringId); $i++) {
                $vacina[$stringId[$i]] = $value[$i];
            }
            $vacina->save();
        }
    }
}
