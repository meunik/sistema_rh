<?php

namespace App\Http\Controllers\Pesquisa;

use App\Models\{Cids, Colegas, UserHospitais, Hospitais};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PesquisaController extends Controller
{
    public function nome(Request $request)
    {
        $input = $request->input('nome');
        $nomes = [];
        if($input != '') {
            $nomes = Colegas::where('nome','like',$input.'%')->get();
        };
        return view('pesquisa.nome', compact('nomes'));
    }
    public function hospital(Request $request)
    {
        $input = $request->input('hospital');
        $hospitais = [];
        if($input != '') {
            if (Auth::user()->is_admin == 'AD') {
                $hospitais = Hospitais::where('nome','like','%'.$input.'%')->orderBy('nome')->get();
            } else {
                $hospitais = UserHospitais::leftjoin('hospitais', 'hospitais_id', '=', 'hospitais.id')
                ->where('users_hospitais.users_id', Auth::user()->id)
                ->where('hospitais.nome','like','%'.$input.'%')
                ->select('users_hospitais.*','hospitais.*')
                ->orderBy('hospitais.nome')
                ->get();
            }
        };
        return view('pesquisa.hospital', compact('hospitais'));
    }
    public function cid(Request $request)
    {
        $input = $request->input('cid');
        $colegas_id = $request->input('colegas_id');
        $nomes = [];
        if($input != '') {
            $nomes = Cids::where('nome','like',$input.'%')->limit(5)->get();
        };
        return view('pesquisa.cid', compact('nomes', 'colegas_id'));
    }
}
