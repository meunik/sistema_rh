<?php

namespace App\Http\Controllers;

use App\Models\Datas;
use App\Models\Colegas;

class TesteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        echo 'Pagina para rodar scripts';
        exit;
        // $colegas = Colegas::select('nome', 'hospitais_id')->get();
        // foreach ($colegas as $col) {
        //     $this->funcao($col);
        // }
    }
    public function funcao($col)
    {
        $colegas = Colegas::where([['nome', '=', $col->nome],['hospitais_id', '=', $col->hospitais_id]])->select('id')->get();

        if (isset($colegas[0]) && ($colegas->count() >= 2)) {
            $r = 0;
            foreach ($colegas as $col) {
                $r = $this->funcaoDois($col, $r);
            }
        }
    }
    public function funcaoDois($col, $r)
    {
        $datas = Datas::where('colegas_id', $col->id)->select('id', 'cod')->get();

        if ( (!isset($datas[0])) && ($r === 0) ) {
            $col->delete();
            return 1;
        } else {
            return 0;
        }
    }
}
