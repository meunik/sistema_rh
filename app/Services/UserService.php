<?php

namespace App\Services;

use App\Models\Hospitais;
use App\Models\UserHospitais;
use Illuminate\Support\Facades\Auth;

/**
 *  Criado 05/01/2021, por isso poucos lugares ultilizam esse Service
 */
class UserService
{
    /**
     *  Filtra os hospitais de a cordo com o nivel de permiss���o do user
     *  Retorna id e nome
     */
    public static function hospitaisVinculados()
    {
        if (Auth::user()->is_admin == 'AD') {
            return Hospitais::select('id','nome')->orderBy('nome')->get();
        } else {
            return UserHospitais::leftjoin('hospitais', 'hospitais_id', '=', 'hospitais.id')
                ->where('users_hospitais.users_id', Auth::user()->id)
                ->select('hospitais.id','hospitais.nome')
                ->orderBy('hospitais.nome')
                ->get();
        }
    }
    /**
     *  Filtra os hospitais de a cordo com o nivel de permiss���o do user
     *  Retorna id
     */
    public static function hospitaisVinculadosOnlyId()
    {
        if (Auth::user()->is_admin == 'AD') {
            $hospitais = Hospitais::select('id')->get();
        } else {
            $hospitais = UserHospitais::leftjoin('hospitais', 'hospitais_id', '=', 'hospitais.id')
                ->where('users_hospitais.users_id', Auth::user()->id)
                ->select('hospitais.id')
                ->get();
        }
        foreach ($hospitais as $hosp) {
            $ids[] = $hosp->id;
        }
        return $ids;
    }
}
