<?php

namespace App\Http\Controllers\Graficos;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\Graficos\InssService;
use App\Services\{UserService, FiltroService};

class InssController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('graficos.inss');
    }

    public function returnDataTables(Request $request)
    {
        $esteMes = FiltroService::filtroDatas($request);
        $hospitais = UserService::hospitaisVinculadosOnlyId();
        $data = InssService::colagasAfastados($hospitais);

        $totalDeAfastados = InssService::totalDeAfastados($data);
        $totalDeAfastadosPeriodo = InssService::totalDeAfastadosPeriodo($data, $esteMes);
        $colegasRetornaramPeriodo = InssService::colegasRetornaramPeriodo($data, $esteMes);

        foreach ($data as $dt) {
            $resultados[$dt->hospital_id] = [
                "hospital_nome" => $dt->hospital_nome,
                "totalDeAfastados" => $totalDeAfastados[$dt->hospital_id],
                "totalDeAfastadosPeriodo" => $totalDeAfastadosPeriodo[$dt->hospital_id],
                "colegasRetornaramPeriodo" => $colegasRetornaramPeriodo[$dt->hospital_id],
            ];
        }
        $resultados['total'] = [
            "hospital_nome" => 'TOTAL',
            "totalDeAfastados" => $totalDeAfastados['total'],
            "totalDeAfastadosPeriodo" => $totalDeAfastadosPeriodo['total'],
            "colegasRetornaramPeriodo" => $colegasRetornaramPeriodo['total'],
        ];

		return DataTables::of($resultados)->make(true);
    }
}
