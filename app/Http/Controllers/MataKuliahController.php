<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Dosen;

class MataKuliahController extends Controller
{
    public function index(){
        $mata_kuliah = MataKuliah::join('dosens','dosens.id','id_dosen')->select('*','mata_kuliahs.id as id_mata_kuliah')->where('mata_kuliahs.status','=','Active')->get();
        $dosen = Dosen::where('status','Active')->get();
        return view('mata_kuliah', compact('mata_kuliah','dosen'));
    }

    public function store(Request $request){
        MataKuliah::insert([
            'code'      => $request->code,
            'mata_kuliah'      => $request->mata_kuliah,
            'id_dosen'  => $request->dosen,
            'status'    => 'Active'
        ]);

        return redirect('mata_kuliah');
    }

    public function update($id, Request $request){
        MataKuliah::where('id', $id)->update([
            'code'      => $request->code,
            'mata_kuliah'      => $request->mata_kuliah,
            'id_dosen'  => $request->dosen,
        ]);

        return redirect('mata_kuliah');
    }

    public function destroy($id){
        MataKuliah::where('id', $id)->update([
            'status'    => 'Delete'
        ]);

        return redirect('mata_kuliah');
    }
}
