<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::join('prodis','prodis.id','id_prodi')->select('*','mahasiswas.id as id_mahasiswa')->where('mahasiswas.status','=','Active')->get();
        $prodi = Prodi::where('status','Active')->get();
        return view('mahasiswa', compact('mahasiswa','prodi'));
    }

    public function store(Request $request){
        Mahasiswa::insert([
            'nim'      => $request->nim,
            'name'      => $request->name,
            'gender'    => $request->gender,
            'id_prodi'  => $request->prodi,
            'status'    => 'Active'
        ]);

        return redirect('mahasiswa');
    }

    public function update($id, Request $request){
        Mahasiswa::where('id', $id)->update([
            'nim'      => $request->nim,
            'name'      => $request->name,
            'gender'    => $request->gender,
            'id_prodi'  => $request->prodi,
        ]);

        return redirect('mahasiswa');
    }

    public function destroy($id){
        Mahasiswa::where('id', $id)->update([
            'status'    => 'Delete'
        ]);

        return redirect('mahasiswa');
    }
}
