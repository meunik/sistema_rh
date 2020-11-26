<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use TJGazel\Toastr\Facades\Toastr;

class UpdatePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        return view('password');
    }
    public function update(Request $request)
    {
        if($request->password == $request->password_confirm) {
            $request->user()->fill([
                'password' => Hash::make($request->password)
            ])->save();
            Toastr::success('Senha alterada!');
        } else {
            return response()->json(['errors' => [ 'error' => 'As duas senhas devem ser iguais!']],404);
        }
    }
}