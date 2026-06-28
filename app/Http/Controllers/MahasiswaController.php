<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswas = Mahasiswa::latest()->get();

        return view('mahasiswa.index',[
            'tittle'=> 'Data Mahasiswa',
            'mahasiswas'=>$mahasiswas,
            'editData'=>null,
        ]);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'nama'=>['required','max:100'],
            'nim'=>['required','unique:mahasiswas,nim'],
            'alamat'=>['required'],
            'hp'=>['required','max:20'],
            'ipk'=>['required','numeric','min:0','max:4'],
        ]);
        Mahasiswa::create($validatedData);

        return redirect('/mahasiswa')->with('success', 'Data mahasiswa berhasil diinput');
    }
    public function edit($id)
    {
        $mahasiswas = Mahasiswa::latest()->get();
        $editData = Mahasiswa::findOrFail($id);

        return view('mahasiswa.index', [
            'title' => 'Edit Data Mahasiswa',
            'mahasiswas' => $mahasiswas,
            'editData' => $editData,
        ]);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|max:100',
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'alamat' => 'required',
            'hp' => 'required|max:20',
            'ipk' => 'required|numeric|min:0|max:4',
        ]);

        $mahasiswa->update($validatedData);

        return redirect('/mahasiswa')->with('success', 'Data mahasiswa berhasil diupdate');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect('/mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}
