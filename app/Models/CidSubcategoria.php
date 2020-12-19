<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CidSubcategoria extends Model
{
    public $timestamps = false;
    protected $table = 'cid_subcategoria';
    protected $fillable = [
        'nome',
        'categoria'
    ];
}
