<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Datas;

class DatasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $id = $request->query('id');

        $datas = Datas::where('colegas_id',$id)->get();

        return view('forms.datas', compact('datas'));
    }
}
