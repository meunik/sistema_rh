<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Covid extends Model
{
    public $timestamps = false;
    protected $table = 'covid';
    protected $fillable = [
        'colegas_id',
        'data_dos_sintomas',
        'data_do_teste',
        'tipo_do_teste',
        'observacao'
    ];
    
    public function colega()
    {
        return $this->hasOne('App\Models\Colegas', 'id', 'colegas_id');
    }
}
