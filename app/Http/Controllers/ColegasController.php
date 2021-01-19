<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use TJGazel\Toastr\Facades\Toastr;
use App\Services\ColegasService;

use App\Models\{Colegas,Hospitais,UserHospitais};

class ColegasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $id = $request->query('id');

        $colega = Colegas::find($id);

        $colegas = Colegas::all();

        if (Auth::user()->is_admin == 'AD') {
            $hospitais = Hospitais::select('id','nome','local')->get();
        } else {
            $hospitais = UserHospitais::leftjoin('hospitais', 'hospitais_id', '=', 'hospitais.id')
            ->where('users_hospitais.users_id', Auth::user()->id)
            ->select('hospitais.id','hospitais.nome','hospitais.local')
            ->get();
        }

        return view('colegas.form',compact('colega','colegas','hospitais'));
    }
    public function form(Request $request)
    {
        $id = $request->id;

        if($id) {
            ColegasService::update($request);
        } else {
            ColegasService::create($request);
        }

        return back();
    }
    public function import(Request $request)
    {
        return view('colegas.import');
    }
    public function sendFile(Request $request) {
        if ($request->hasFile('fileUpload') && $request->file('fileUpload')->isValid()){

            $file = fopen($request->fileUpload, "r");

            $count = 0;
            $teste = 0;

            while(!feof($file)) {
                $split = explode(';', fgets($file), 12);

                if($split[0] != "Nome do Colega") {

                    if(isset($split[11])) {

                        $colega = Colegas::where('nome',$split[0])->first();

                        if($colega) {
                            toastr()->warning("O colega " . $colega->nome . " não foi importado pois já existe um colega com esse nome cadastrado!");
                            $teste++;
                        } else {
                            $hospital = Hospitais::where('nome',$split[1])->select('id')->first();

                            if($hospital) {
                                $split[2] = str_replace('/', '-',$split[2]);
                                $split[7] = str_replace('/', '-',$split[7]);

                                $colega = new Colegas;

                                $colega->nome = $split[0];
                                $colega->hospitais_id = $hospital->id;
                                $colega->data_de_nascimento = Carbon::parse($split[2])->format('Y-m-d');
                                $colega->chapa =  $split[3];
                                $colega->centro_de_custo = $split[4];
                                $colega->funcao =  $split[5];
                                $colega->secao =  $split[6];
                                $colega->admissao =  Carbon::parse($split[7])->format('Y-m-d');
                                $colega->codigo_horario = $split[8];
                                $colega->horario =  $split[9];
                                $colega->jornada =  $split[10];
                                $colega->telefone =  $split[11];

                                $colega->save();
                                $count++;
                            } else {
                                toastr()->warning("O colega " . $split[0] . " não foi importado pois o hospital". $split[1] ." não foi encontrado!");
                            }

                        }

                    }
                }
            }
        }

        if($count > 0) {
            toastr()->success('Importado com sucesso!');
        }

        // if($teste > 0) {
        //     toastr()->warning($teste);
        // }


        return back();
    }
}
