<?php

namespace App\Http\Controllers;

use App\Voting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentVote = Voting::where('end_at', '>', Carbon::now()->timestamp)
                        ->orWhereNull('end_at')
                        ->latest('id')
                        ->first();
        $votes = Voting::where('end_at', '<', Carbon::now()->timestamp)->get();
        return view('voting.index', compact('currentVote', 'votes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voting.setData');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|string'
        ]);

        Voting::create($request->except('end_at'));
        return redirect()->route('voting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currentVote = Voting::where( fn($q) => (
            $q->where('end_at', '>', Carbon::now()->timestamp)
            ->orWhereNull('end_at')   
        ))
        ->where('id', $id)
        ->firstOrFail();

        return view('voting.setData', compact('currentVote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currentVote = Voting::where( fn($q) => (
            $q->where('end_at', '>', Carbon::now()->timestamp)
            ->orWhereNull('end_at')   
        ))
        ->where('id', $id)
        ->firstOrFail();

        $currentVote->update($request->except('end_at'));
        return redirect()->route('voting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentVote = Voting::findOrFail($id);
        $currentVote->delete();

        return back();
    }


    public function start(Request $request, $id)
    {
        $currentVote = Voting::where( fn($q) => (
            $q->where('end_at', '>', Carbon::now()->timestamp)
            ->orWhereNull('end_at')   
        ))->where('id', $id)
        ->firstOrFail();

        $currentVote->update(['end_at' => Carbon::parse($request->end_at)->timestamp]);
        return back();
    }


    public function end($id)
    {
        $currentVote = Voting::where( fn($q) => (
            $q->where('end_at', '>', Carbon::now()->timestamp)
            ->orWhereNull('end_at')   
        ))->where('id', $id)
        ->firstOrFail();

        $currentVote->update([
            'end_at' => Carbon::now()->timestamp
        ]);

        return back();
    }
}
