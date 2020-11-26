<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHospitais extends Model
{
    public $timestamps = false;
    protected $table = 'users_hospitais';
    protected $fillable = [
        'users_id',
        'hospitais_id',
    ];

    public function user()
    {
        return $this->hasOne('App\User','id', 'users_id');
    }
    public function hospital()
    {
        return $this->hasOne('App\Models\Hospitais','id', 'hospitais_id');
    }
    public function colega()
    {
        return $this->belongsTo('App\Models\Colegas', 'hospitais_id', 'id');
    }
}
