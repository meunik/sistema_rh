<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\{Hospitais, UserHospitais, Colegas, Datas, CidCategoria, CidSubcategoria};

class ResultadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if (Auth::user()->is_admin == 'AD') {
            $hospitais = Hospitais::select('id', 'nome')->orderBy('nome')->get();
        } else {
            $hospitais = UserHospitais::leftjoin('hospitais', 'hospitais_id', '=', 'hospitais.id')
                ->where('users_hospitais.users_id', Auth::user()->id)
                ->select('hospitais.id', 'hospitais.nome')
                ->orderBy('hospitais.nome')
                ->get();
        }

        $query['hospitais'] = $request->query('hospitais');
        $query['hospitais'] = explode(',', $query['hospitais']);
        $query['tipo'] = $request->query('tipo');
        $query['cod'] = $request->query('cod');
        $query['inicial'] = $request->query('inicial');
        $query['final'] = $request->query('final');

        if ($query['inicial'] == null) {
            $query['inicial'] = Carbon::today();
        } else {
            $query['inicial'] = Carbon::parse($query['inicial']);
        }

        if ($query['final'] == null) {
            $query['final'] = Carbon::today();
        } else {
            $query['final'] = Carbon::parse($query['final']);
        }

        if ($query['tipo'] != 'TD') {
            $colegas = Colegas::whereIn('hospitais_id', $query['hospitais'])->where('tipo', $query['tipo'])->orderBy('nome')->get();
        } else {
            $colegas = Colegas::whereIn('hospitais_id', $query['hospitais'])->orderBy('nome')->get();
        }

        if ($query['cod'] !== 'TD') {
            $query['cod'] = $array = explode(',', $query['cod']);
        }

        $resultados = [];
        $datas = [];

        if (($query['inicial']->diffInDays($query['final']) + 1) > 31) {
            toastr()->error('O resultado máximo é de 31 dias.');
            return view('resultado.index', compact('hospitais', 'resultados', 'datas'));
        }

        foreach ($colegas as $colega) {
            $resultados[$colega->nome]['tipo_clinica'] = $colega->hospital->tipo;

            $resultados[$colega->nome]['responsavel'] = [];
            $responsaveis = UserHospitais::where('hospitais_id', $colega->hospital->id)->get();
            foreach ($responsaveis as $responsavel) {
                if (isset($responsavel->user)) {
                    if ($responsavel->user->is_admin == 'CL') {
                        array_push($resultados[$colega->nome]['responsavel'], $responsavel->user->name);
                    }
                }
            }

            $resultados[$colega->nome]['coligada'] = $colega->hospital->coligada->nome;
            // $resultados[$colega->nome]['filial_cod'] =  $colega->hospital->cod_filial;
            $resultados[$colega->nome]['filial_nome'] =  $colega->hospital->nome;
            $resultados[$colega->nome]['local'] =  $colega->hospital->local;
            // $resultados[$colega->nome]['inicio_clinica'] =  $colega->hospital->dt_inicio;
            // $resultados[$colega->nome]['chapa'] = $colega->chapa;
            // $resultados[$colega->nome]['data_de_nascimento'] = $colega->data_de_nascimento;

            $resultados[$colega->nome]['idade'] = "";
            if ($colega->data_de_nascimento !== null && $colega->data_de_nascimento !== "") {
                $resultados[$colega->nome]['idade'] = Carbon::parse($colega->data_de_nascimento)->age;
            }

            // $resultados[$colega->nome]['centro_de_custo'] = $colega->centro_de_custo;
            // $resultados[$colega->nome]['situacao'] = 'Ativo';
            $resultados[$colega->nome]['funcao'] = $colega->funcao;
            // $resultados[$colega->nome]['admissao'] = $colega->admissao;
            // $resultados[$colega->nome]['demissao'] = $colega->demissao;
            $resultados[$colega->nome]['secao'] = $colega->secao;
            // $resultados[$colega->nome]['codigo_horario'] = $colega->codigo_horario;
            // $resultados[$colega->nome]['horario'] = $colega->horario;
            // $resultados[$colega->nome]['demissao_cod'] = $colega->demissao_cod;
            // $resultados[$colega->nome]['demissao_tipo'] = $colega->demissao_tipo;
            // $resultados[$colega->nome]['jornada'] = $colega->jornada;
            $resultados[$colega->nome]['data_inicio_afastamento'] = '';
            $resultados[$colega->nome]['data_final_atestado'] = '';
            // $resultados[$colega->nome]['classificacao'] = '';
            $resultados[$colega->nome]['dias_de_atestado'] = 0;
            $resultados[$colega->nome]['data_dos_sintomas'] = '';
            $resultados[$colega->nome]['data_do_teste'] = '';
            $resultados[$colega->nome]['tipo_do_teste'] = '';
            $resultados[$colega->nome]['telefone'] = $colega->telefone;
            $resultados[$colega->nome]['observacao'] = [];
            $resultados[$colega->nome]['assistente_social'] = '';
            $resultados[$colega->nome]['grupo_de_risco'] = 'Não';
            $resultados[$colega->nome]['atualizado_por'] = '';
            $resultados[$colega->nome]['atualizado_em'] = '';
            $resultados[$colega->nome]['retornou'] = "";
            $resultados[$colega->nome]['filtrou'] = false;
            $obs = false;
        }

        for ($query['inicial']; $query['inicial'] <= $query['final']; $query['inicial']->add(1, 'day')) {
            $i = $query['inicial']->isoFormat('DD/MM/YYYY');

            foreach ($colegas as $colega) {
                $data = Datas::where('data_inicial', $query['inicial'])
                    ->whereNotIn('cod', ['DE'])
                    ->where('colegas_id', $colega->id)
                    ->OrWhere('data_inicial', '<', $query['inicial'])
                    ->where('data_final', '>=', $query['inicial'])
                    ->where('colegas_id', $colega->id)
                    ->OrWhere('data_inicial', '<=', $query['inicial'])
                    ->whereNull('data_final')
                    ->whereIn('cod', ['CO', 'GR', 'FE', 'AT','AF','INSS'])
                    ->where('colegas_id', $colega->id)
                    ->orderBy('id', 'DESC')
                    ->first();

                $resultados[$colega->nome]['datas'][$i]['cod'] = 'X';
                $resultados[$colega->nome]['situacao'] = 'Ativo';
                $resultados[$colega->nome]['cid'] = $this->cidResultado($data);
                $resultados[$colega->nome]['colega_id'] = $colega->id;

                $resultados[$colega->nome]['data_inicio_beneficio'] = isset($data->data_inicio_beneficio)?$data->data_inicio_beneficio:null;
                $resultados[$colega->nome]['data_cessacao_beneficio'] = isset($data->data_cessacao_beneficio)?$data->data_cessacao_beneficio:null;
                $resultados[$colega->nome]['especie_do_beneficio'] = isset($data->especie_do_beneficio)?$data->especie_do_beneficio:null;

                $resultados[$colega->nome]['data_proximo_contato_form'] = isset($data->data_proximo_contato_form)?$data->data_proximo_contato_form:null;
                $resultados[$colega->nome]['data_realizacao_exame'] = isset($data->data_realizacao_exame)?$data->data_realizacao_exame:null;
                $resultados[$colega->nome]['data_de_contato_form'] = isset($data->data_de_contato_form)?$data->data_de_contato_form:null;

                $resultados[$colega->nome]['encaminhado_inss'] = isset($data->encaminhado_inss)?$data->encaminhado_inss:'';
                $resultados[$colega->nome]['data_proximo_contato'] = isset($data->data_proximo_contato)?$data->data_proximo_contato:'';
                $resultados[$colega->nome]['data_encerramento_acompanhamento'] = isset($data->data_encerramento_acompanhamento)?$data->data_encerramento_acompanhamento:'';
                $resultados[$colega->nome]['data_de_contato'] = isset($data->data_de_contato)?$data->data_de_contato:'';
                $resultados[$colega->nome]['observacao_inss'] = isset($data->observacao_inss)?$data->observacao_inss:'';

                $resultados[$colega->nome]['cid_categoria_id'] = $this->cidCategoriaId($data);
                $resultados[$colega->nome]['cid_sub_categoria_id'] = $this->cidSubCategoriaId($data);
                $resultados[$colega->nome]['motivo'] = $this->motivo($data);

                $resultados[$colega->nome]['data_id'] = isset($data->id)?$data->id:'-';
                $resultados[$colega->nome]['dias_atestado'] = isset($data->dias_atestado)?$data->dias_atestado:'-';

                if ($colega->demissao != null && $colega->demissao <= $query['inicial']) {
                    $resultados[$colega->nome]['datas'][$i]['cod'] = 'DE';
                    $resultados[$colega->nome]['situacao'] = 'Demitido';
                    $data = Datas::where('cod', 'DE')
                        ->where('colegas_id', $colega->id)
                        ->orderBy('id', 'DESC')
                        ->first();

                    if ($data) {
                        if (isset($data->user)) {
                            $resultados[$colega->nome]['atualizado_por'] = $data->user->name;
                        }
                        $resultados[$colega->nome]['atualizado_em'] = $data->updated_at;
                    }
                } else if ($data) {
                    if (isset($data->user)) {
                        $resultados[$colega->nome]['atualizado_por'] = $data->user->name;
                    }
                    $resultados[$colega->nome]['atualizado_em'] = $data->updated_at;
                    if ($query['cod'] !== 'TD') {
                        if (in_array($data->cod, $query['cod'])) {
                            $resultados[$colega->nome]['filtrou'] = true;
                        }
                    }
                    if ($data->cod == 'FA') {
                        $resultados[$colega->nome]['datas'][$i]['cod'] = 'FA';
                    } else if ($data->cod == 'FO') {
                        $resultados[$colega->nome]['datas'][$i]['cod'] = 'FO';
                    } else if ($data->cod == 'FE' || $data->cod == 'AF' || $data->cod == 'AT' || $data->cod == 'CO' || $data->cod == 'GR') {
                        if ($data->cod == 'AT') {
                            $resultados[$colega->nome]['datas'][$i]['cod'] = 'AT';
                        } else if($data->cod == 'AF') {
                            $resultados[$colega->nome]['datas'][$i]['cod'] = 'AF';
                        } else if ($data->cod == 'GR') {
                            $resultados[$colega->nome]['datas'][$i]['cod'] = 'GR';
                            foreach ($resultados[$colega->nome]['observacao'] as $observacao) {
                                if ($observacao === $data->observacao && $data->observacao !== '') {
                                    $obs = true;
                                }
                            }
                            if ($obs === false) {
                                array_push($resultados[$colega->nome]['observacao'], $data->observacao);
                            } else {
                                $obs = false;
                            }
                            $resultados[$colega->nome]['grupo_de_risco'] = 'Sim';
                        } else if ($data->cod == 'CO') {
                            if ($data->covid == 'Suspeito') {
                                $resultados[$colega->nome]['datas'][$i]['cod'] = 'CO-S';
                            } else if ($data->covid == 'Confirmado') {
                                $resultados[$colega->nome]['datas'][$i]['cod'] = 'CO+';
                            } else {
                                $resultados[$colega->nome]['datas'][$i]['cod'] = 'CO';
                            }

                            if (isset($data->resultado)) {
                                $resultados[$colega->nome]['data_dos_sintomas'] = $data->resultado->data_dos_sintomas;
                                $resultados[$colega->nome]['data_do_teste'] = $data->resultado->data_do_teste;
                                $resultados[$colega->nome]['tipo_do_teste'] = $data->resultado->tipo_do_teste;
                                foreach ($resultados[$colega->nome]['observacao'] as $observacao) {
                                    if ($observacao === $data->resultado->observacao && $data->resultado->observacao !== '') {
                                        $obs = true;
                                    }
                                }
                                if ($obs === false) {
                                    array_push($resultados[$colega->nome]['observacao'], $data->resultado->observacao);
                                } else {
                                    $obs = false;
                                }
                            }
                        }

                        if ($data->cod == 'FE') {
                            $resultados[$colega->nome]['datas'][$i]['cod'] = 'FE';
                            $resultados[$colega->nome]['situacao'] = 'Férias';
                        } else {
                            $resultados[$colega->nome]['data_inicio_afastamento'] = $data->data_inicial;
                            $resultados[$colega->nome]['data_final_atestado'] = $data->data_final;
                        }

                        $inicio = Carbon::parse($data->data_inicial);
                        if ($data->data_final) {
                            $fim = Carbon::parse($data->data_final);
                            if ($data->cod != 'FE' && $data->cod != 'AF') {
                                $resultados[$colega->nome]['dias_de_atestado'] = $inicio->diffInDays($fim) + 1;
                            }

                            if ($fim < Carbon::now()->startOfDay()) {
                                if ($data->retornou == 0) {
                                    $resultados[$colega->nome]['retornou'] = "danger";
                                }
                            } else {
                                $resultados[$colega->nome]['retornou'] = "warning";
                            }
                        } else {
                            if ($data->cod != 'FE' && $data->cod != 'AF') {
                                $resultados[$colega->nome]['dias_de_atestado'] = $inicio->diffInDays($query['final']) + 1;
                            }
                            $resultados[$colega->nome]['retornou'] = "warning";
                        }
                    }

                    if ($data->cod == 'INSS') {
                        $resultados[$colega->nome]['datas'][$i]['cod'] = 'INSS';
                        if (isset($data->observacao)) {
                            array_push($resultados[$colega->nome]['observacao'], $data->observacao);
                        }
                    }
                }
            }

            array_push($datas, $i);
        }

        if ($query['cod'] !== 'TD') {
            foreach ($resultados as $key => $resultado) {
                if ($resultado['filtrou'] == false) {
                    unset($resultados[$key]);
                }
            }
        }

        return view('resultado.index', compact('hospitais', 'resultados', 'datas'));
    }

    public function motivo($data)
    {
        if (isset($data->motivoSelect)) {
            switch ($data->motivoSelect) {
                case 1:
                    return 'Acidente Trabalho ou Doença Ocupacional';
                    break;
                case 2:
                    return 'Licença Maternidade';
                    break;
                case 3:
                    return $data->motivo;
                    break;

                default:
                    return 'Sem Motivo';
                    break;
            }
        } else {
            return 'Sem Motivo';
        }
    }

    public function cidCategoriaId($data)
    {
        if (isset($data->cid_categoria_id)) {
            $cidCategoria = CidCategoria::find($data->cid_categoria_id);
            $string = '('.$cidCategoria->inicio.' - '.$cidCategoria->fim.') '.$cidCategoria->nome;
            return $string;
        } else {
            return 'Sem CID Categoria';
        }
    }

    public function cidSubCategoriaId($data)
    {
        if (isset($data->cid_sub_categoria_id)) {
            $cidSubCategoria = CidSubcategoria::find($data->cid_sub_categoria_id);
            $string = '('.$cidSubCategoria->categoria.') '.$cidSubCategoria->nome;
            return $string;
        } else {
            return 'Sem CID Subcategoria';
        }
    }

    public function cidResultado($data)
    {
        if (isset($data->cids_id)) {
            return $data->cids_id;
        } elseif (isset($data->cid_sub_categoria_id)) {
            $cidSubCategoria = CidSubcategoria::find($data->cid_sub_categoria_id);
            return $cidSubCategoria->categoria;
        } else {
            return '-';
        }
    }
}
