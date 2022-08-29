<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\voting;
use App\Kandidat;
use App\Student;

class OldVotingController extends Controller
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
        return view('voting.index');
    }

    function create()
    {
        return view('voting.create');
    }


    function edit(Request $request)
    {
        $voting = voting::find($request->id);
        $voting->judul = $request->judul;
        $voting->save();
        return redirect()->back();
    }

    function start(request $request)
    {
        $voting = voting::find($request->id);
        $voting->status = 'berlangsung';
        $voting->save();
        return redirect()->back();
    }

    function stop(Request $request)
    {
        $students = Student::where('status', '=', $request->id)->get();
        $total = count(Student::all());
        $golput = $total - count($students);

        $voting = voting::find($request->id);
        $voting->status = 'selesai';
        $voting->golput = $golput;
        $voting->save();
        $voting->delete();
        return redirect()->back();
    }

    function delete(Request $request)
    {
        $voting = voting::find($request->id);
        $voting->status = 'batal';
        $voting->save();
        $voting->delete();
        return redirect()->back();
    }

    function golput($id)
    {
        $siswa = Student::where('status', '!=', $id)->get();
        return view('/home/golput', ['siswa' => $siswa]);
    }
}
