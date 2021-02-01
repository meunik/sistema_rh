<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacinas extends Model
{
    protected $table = 'vacinas';
    protected $fillable = [
        'datas_id',
        'colegas_id',
        'covid_laboratorio',
        'covid_primeira_dose',
        'covid_segunda_dose',
        'da_primeira_dose',
        'da_segunda_dose',
        'da_terceira_dose',
        'scr',
        'hepatite_b_primeira_dise',
        'hepatite_b_segunda_dose',
        'hepatite_b_terceira_dose',
        'scr_reforco',
        'dt_reforco',
        'h1n1',
        'antihbs_data',
        'antihbs_valor',
        'igg_data',
        'igg_valor',
        'obervacao',
        'created_by',
        'updated_by'
    ];

    public function data()
    {
        return $this->hasOne('App\Models\Datas', 'id', 'datas_id');
    }

    public function colega()
    {
        return $this->hasOne('App\Models\Colegas', 'id', 'colegas_id');
    }
}
