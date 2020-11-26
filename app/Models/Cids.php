<?php

namespace App\Models;

use App\Models\Datas;
use Illuminate\Database\Eloquent\Model;

class Cids extends Model
{
    public $timestamps = false;
    protected $table = "cids";
    protected $fillable = ['nome'];
    
    public function colega()
    {
        return $this->belongsTo('App\Models\Colegas', 'cids_id', 'id');
    }
}
