<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\voting;

class StudentController extends Controller
{
    function index()
    {
    	$siswa=Student::all();
    	return view('/siswa/index_siswa',['siswa'=>$siswa]);
    }

    function store(Request $request)
    {
        //agar saat terjadi pemilihan tidak dapat menambah data pesetra
        $voting=voting::all();
        if (count($voting) !== 0) {
            return redirect('/siswa')->with('Gagal','Tidak dapat menambahkan data siswa saat pemilihan sedang berlangsung');
        }
        $this->validate($request, [
            'id' => 'unique:students'
        ]);
    	$siswa=new Student;
    	$siswa->nisn=$request->id;
    	$siswa->nama=$request->nama;
    	$siswa->kelas=$request->kelas;
    	$siswa->save();
    	return redirect('/siswa');
    }

    function delete(request $request)
    {
        //saat terjadi pemilihan tidak dapat menhapus data pesets 
        $voting=voting::all();
        if (count($voting) == 0) {
            Student::find($request->id)->delete();
            return redirect()->back();
        }
        return redirect()->back()->with('Gagal','Tidak dapat menghapus data siswa saat pemilihan sedang berlangsung');
    }

    function edit($id)
    {
    	$siswa=Student::find($id);
    	return view('/siswa/edit_siswa',['siswa'=>$siswa]);
    }

        function prosesedit(Request $request, $id)
    {
    	$siswa=Student::find($id);
    	$siswa->nama=$request->nama;
    	$siswa->kelas=$request->kelas;
    	$siswa->save();
    	return redirect('/siswa');
    }
}
