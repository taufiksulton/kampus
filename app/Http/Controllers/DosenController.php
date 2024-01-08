<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index(){
        $dosen = Dosen::where('status','=','Active')->get();
        return view('dosen', compact('dosen'));
    }

    public function store(Request $request){
        Dosen::insert([
            'nik'     => $request->nik,
            'name'     => $request->name,
            'gender'     => $request->gender,
            'status'    => 'Active'
        ]);

        return redirect('dosen');
    }

    public function update($id, Request $request){
        Dosen::where('id', $id)->update([
            'nik'    => $request->nik,
            'name'     => $request->name,
            'gender'     => $request->gender,
        ]);

        return redirect('dosen');
    }

    public function destroy($id){
        Dosen::where('id', $id)->update([
            'status'    => 'Delete'
        ]);

        return redirect('dosen');
    }
}
