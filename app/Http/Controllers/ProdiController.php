<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;

class ProdiController extends Controller
{
    public function index(){
        $prodi = Prodi::where('status','=','Active')->get();
        return view('prodi', compact('prodi'));
    }

    public function store(Request $request){
        Prodi::insert([
            'prodi'     => $request->prodi,
            'status'    => 'Active'
        ]);

        return redirect('prodi');
    }

    public function update($id, Request $request){
        Prodi::where('id', $id)->update([
            'prodi'    => $request->prodi,
        ]);

        return redirect('prodi');
    }

    public function destroy($id){
        Prodi::where('id', $id)->update([
            'status'    => 'Delete'
        ]);

        return redirect('prodi');
    }
}
