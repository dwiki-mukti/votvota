<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Student;
use App\Kandidat;
use App\voting;

class frontendController extends Controller
{

	function index()
    {
    $voting=voting::all();
        if ($voting->count()===1 && $voting[0]->status == "berlangsung") {
            if(Session::has('mySession') && Session()->has('votingSession')){
                $siswa=Student::find(Session()->get('mySession'));
                $sessionVoting=voting::find(Session()->get('votingSession'));
                if (isset($siswa) && isset($sessionVoting)) {                    
                    $kandidat=Kandidat::where('id_voting','=',$voting[0]->id)->get();
                    return view('/frontend/voting',['kandidat'=>$kandidat,'siswa'=>$siswa]);
                }
                return view('frontend/validasi');
            }
            return view('frontend/validasi');
        }
    	return view('error');
    }



    function validasi(Request $request)
    {
        $siswa0=Student::where('nisn', '=', $request->nis)->get();
        //cek apakah ada user tsb
        if (count($siswa0) == 0) {
            return redirect('/')->with('gagal','i');
        }
        $siswa=$siswa0[0];
        $voting=voting::all()[0];
        //cek apakah user sudah memilih
        if ($siswa->status == $voting->id) {
            return redirect('/')->with('sudah','i');
        }else{
            Session::put('mySession', $siswa->id);
            Session::put('votingSession', $voting->id);            
            return redirect('/');
        }
    }

    function vote(request $request)
    {
    	$siswa=Student::find($request->siswa);
    	$pilihan=Kandidat::find($request->pilihan);

        $siswa->status=$pilihan->id_voting;
        $siswa->save();

    	$suara=$pilihan->suara+1;
    	$pilihan->suara=$suara;
    	$pilihan->save();

        Session::forget('mySession');
        return redirect('/')->with('Sukses','Terima kasih atas partisipasi anda dalam pemilihan tahun ini');

    }
}
