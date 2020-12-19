<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CidCategoria extends Model
{
    public $timestamps = false;
    protected $table = 'cid_categoria';
    protected $fillable = [
        'nome',
        'inicio',
        'fim'
    ];
}
