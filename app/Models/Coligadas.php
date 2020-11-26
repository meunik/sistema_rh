<?php

namespace App\Models;

use App\Models\Hospitais;
use Illuminate\Database\Eloquent\Model;

class Coligadas extends Model
{
    public $timestamps = false;
    protected $table = 'coligadas';
    protected $fillable = [
        'colig',
        'coligada'
    ];
    
    public function hospital()
    {
        return $this->belongsTo('App\Models\Hospitais', 'coligadas_id', 'id');
    }
}
