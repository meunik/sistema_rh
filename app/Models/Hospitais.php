<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospitais extends Model
{
    public $timestamps = false;
    protected $table = 'hospitais';
    protected $fillable = [
        'tipo',
        'coligadas_id',
        'cod_filial',
        'filial',
        'local',
        'dt_incio'
    ];

    public function coligada()
    {
        return $this->hasOne('App\Models\Coligadas', 'id', 'coligadas_id');
    }
}
