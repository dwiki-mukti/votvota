<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\voting;
use App\Kandidat;
use App\Student;

class VotingController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function index()
    {
    	$voting=voting::all();

        if ($voting->count()===1) {
            $kandidat=Kandidat::where('id_voting','=',$voting[0]->id)->get();
            $students=Student::where('status','=',$voting[0]->id)->get();
            $total=count(Student::all());
            $student=$total-count($students);

            if ($voting[0]->status==='berlangsung') {
                return view('/home/berlangsung',['voting'=>$voting,'kandidat'=>$kandidat,'student'=>$student,'total'=>$total]);
            }else{
                return view('/home/index',['voting'=>$voting,'kandidat'=>$kandidat]);
            }

        }else{
            return view('/home/landing');
        }
    }

        function create(Request $request)
    {
    	$voting=new voting;
    	$voting->judul=$request->judul;
        $peserta=count(Student::all());
        $voting->total_peserta=$peserta;
    	$voting->save();
    	return redirect()->back();
    }


    function edit(Request $request)
    {
        $voting=voting::find($request->id);
        $voting->judul=$request->judul;
        $voting->save();
        return redirect()->back();
    }

    function start(request $request)
    {
        $voting=voting::find($request->id);
        $voting->status='berlangsung';
        $voting->save();
        return redirect()->back();
    }

    function stop(Request $request)
    {
        $students=Student::where('status','=',$request->id)->get();
        $total=count(Student::all());
        $golput=$total-count($students);

        $voting=voting::find($request->id);
        $voting->status='selesai';
        $voting->golput=$golput;
        $voting->save();
        $voting->delete();
        return redirect()->back();
    }

    function delete(Request $request)
    {
        $voting=voting::find($request->id);
        $voting->status='batal';
        $voting->save();
        $voting->delete();
        return redirect()->back();
    }

    function golput($id)
    {
        $siswa=Student::where('status','!=',$id)->get();
        return view('/home/golput',['siswa'=>$siswa]);
    }
}
