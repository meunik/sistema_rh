<?php

namespace App\Models;

use App\Models\Hospitais;
use Illuminate\Database\Eloquent\Model;

class Colegas extends Model
{
    public $timestamps = false;
    protected $table = "colegas";
    protected $fillable = [
        'chapa',
        'nome',
        'dt_nascimento',
        'idade',
        'centro_de_custo',
        'situacao',
        'funcao',
        'dt_adm',
        'dt_dem',
        'secao',
        'cod_horario',
        'horario',
        'cod_demissao',
        'tipo_demissao',
        'jornada',
        'data_afastamento',
        'data_inicial_atestado',
        'data_final_atestado',
        'motivo_atestado',
        'classificacao',
        'dias_atestado',
        'teste_data',
        'teste_tipo',
        'telefone',
        'consolidada',
        'assistente_social',
        'grupo_risco',
        'hospitais_id',
        'observacao',
        'cids_id',
        'data_sintomas',
        'data_final_ferias',
        'motivo_afastado',
        'data_inicial_afastado',
        'data_final_afastado',
        'covid',
        'tipo'
    ];

    public function data()
    {
        return $this->belongsTo('App\Models\Datas', 'colegas_id', 'id');
    }
    public function cid()
    {
        return $this->hasOne('App\Models\Cids', 'id', 'cids_id');
    }
    public function hospital()
    {
        return $this->belongsTo('App\Models\Hospitais', 'hospitais_id', 'id');
    }
}
