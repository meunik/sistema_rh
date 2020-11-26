<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datas extends Model
{
    protected $table = 'datas';
    protected $fillable = [
        'colegas_id',
        'cod',
        'medico',
        'crm',
        'covid',
        'data_inicial',
        'data_final',
        'retornou',
        'cids_id',
        'motivo',
        'obervacao',
        'created_by',
        'updated_by'
    ];
    
    public function colega()
    {
        return $this->hasOne('App\Models\Colegas', 'id', 'colegas_id');
    }

    public function resultado()
    {
        return $this->hasOne('App\Models\Covid', 'colegas_id', 'colegas_id');
    }
    
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
}
