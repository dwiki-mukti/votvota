<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\voting;
use App\Kandidat;
use App\Student;


class KandidatController extends Controller
{

	function store(Request $request)
	{
    	$this->validate($request,[
    		'foto'=>'mimes:jpg,jpeg,png'
    	]);

		$voting=voting::all();
		$id_voting=$voting[0]->id;
        $siswa=Student::where('nisn','=',$request->nisn)->get()[0];
		$kandidat= new Kandidat;
		$kandidat->id_kandidat=$siswa->id;
		$kandidat->name=$siswa->nama;
		$kandidat->kelas=$siswa->kelas;
		$kandidat->visi=$request->visi;
		$kandidat->misi=$request->misi;
		$kandidat->id_voting=$id_voting;
    	$request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
    	$kandidat->foto=$request->file('foto')->getClientOriginalName();
    	$kandidat->save();
    	return redirect('/admin');

	}

	function edit($id)
	{
		$kandidat=Kandidat::findOrFail($id);
		return view('kandidat/edit_kandidat',['kandidat'=>$kandidat]);
	}


	function prosesedit(request $request)
	{
		$kandidat=Kandidat::find($request->id);
		$kandidat->visi=$request->visi;
		$kandidat->misi=$request->misi;
        if ($request->hasFile('foto')) {
	    	$this->validate($request,[
	    		'foto'=>'mimes:jpg,jpeg,png'
	    	]);
            $request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
            $kandidat->foto=$request->file('foto')->getClientOriginalName();
        }
    	$kandidat->save();
		return redirect('/admin');
	}


	function delete(Request $request)
	{
		Kandidat::find($request->id)->delete();
		return redirect()->back();
	}

		function search(Request $request)
	{
        $calon=Student::where('nisn','=',$request->id)->get();
                // cek apakah ada nisn tsb
        if (count($calon) == 1 ){
			$kandidat=Kandidat::where('id_kandidat','=',$calon[0]->id)->get();
			if (count($kandidat) == 0) {
            	return $calon[0]->nama;
			}
			return 2;
        }else{
        	return 1;
        }
	}

}
