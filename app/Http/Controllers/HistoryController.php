<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\voting;
use App\Kandidat;

class HistoryController extends Controller
{
    function index()
    {
    	$voting=voting::onlyTrashed()->orderBy('id','desc')->get();
    	return view('history.index_history', ['voting'=>$voting]);
    }

    function detail($id)
    {
    	$voting=voting::onlyTrashed()->find($id);
        $kandidat=Kandidat::where('id_voting','=',$id)->get();
		return view('history.detail_history', ['voting'=>$voting, 'kandidat'=>$kandidat]);
    }
}
