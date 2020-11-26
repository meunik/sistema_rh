<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TJGazel\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\{User, Models\Hospitais, Models\UserHospitais, Models\Datas};

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $users = User::where('is_admin', "<>" , 'AD')->orWhereNull('is_admin')->get();
        
        $hospitais = Hospitais::select('id', 'nome', 'local')->get();
        
        $id = $request->query('id');
        $user = null;
        
        if($id && $id != 1) {
            $user = User::where('id',$id)->first();
        }
        
        return view('forms.formUsers', compact('users', 'hospitais', 'user'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        
        if($id) {
            $password = $request->password;
            $password_confirmation = $request->password_confirmation;
            
            if($password && $password_confirmation) {
                if($password !== $password_confirmation) {
                    toastr()->warning('As senhas não conferem!');
                    return back();
                }
            }
            $user = User::where('id', $id)->first();
            
            if($user) {
                if(isset($request->name)){$user->name = $request->name;}
                if(isset($request->email)){$user->email = $request->email;}
                if(isset($request->password)){$user->password = Hash::make($request->password);}
                if(isset($request->is_admin)) {
                    if($request->is_admin === 'NULL') {
                        $user->is_admin = null;
                    } else {
                        $user->is_admin = $request->is_admin;
                    }
                }
              
              $user->save();
               
               if(isset($request->hospitais_id)) {
                    UserHospitais::where('users_id',$id)->delete();
                    $hospitais_ids = $request->hospitais_id;
                    for ($i=0; $i < count($hospitais_ids); $i++) { 
                        UserHospitais::create([
                            'users_id' => $id,
                            'hospitais_id' => $hospitais_ids[$i]
                        ]);
                    }
                }
            }
        }
        
        return back();
    }
    public function remove(Request $request)
    {
        $id = $request->id;
        
        if($id) {
            $user = User::where('id', $id)->first();
            
            if($user) {
                $datas = Datas::where('updated_by',$id)->orWhere('created_by',$id)->first();
                if($datas) {
                    $user->is_enable = 0;
                    $user->save();
                    toastr()->danger('O usuário possui lançamentos no formulário e por isso será desavitado.');
                    return back();
                } else {
                    $user->delete();
                    toastr()->success('Usuário excluido!');
                }
            }
            
        }
        
        return back();
    }
}
