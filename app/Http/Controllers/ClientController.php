<?php

namespace App\Http\Controllers;

use App\Voter;
use App\Voting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentVote = Voting::where('end_at', '>', Carbon::now()->timestamp)
                        ->latest('id')
                        ->first();
        if (!$currentVote) {
            return view('client.unset');
        }
        return view('client.verify', compact('currentVote'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentVote = Voting::where('end_at', '>', Carbon::now()->timestamp)
                        ->latest('id')
                        ->first();
        $token = Voter::where([
            ['voting_id', $currentVote->id],
            ['token', $request->token]
        ])->first();

        if (!$token) {
            return back()->with(['message' => 'Token tidak valid!']);
        }
        if ($token->candidate_id) {
            return back()->with(['message' => 'Token ini sudah digunakan untuk memilih!']);
        }
        
        Session::put('token', Crypt::encryptString($request->token));
        return redirect()->route('main.show', 'voting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id != 'voting') {
            return abort(404);
        }
        $currentVote = Voting::where('end_at', '>', Carbon::now()->timestamp)
                        ->latest('id')
                        ->first();
        return view('client.voting', compact('currentVote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if ($id != 'voting') {
            return abort(404);
        }

        try {
            $token = Crypt::decryptString(Session::get('token'));
            $currentVote = Voting::where('end_at', '>', Carbon::now()->timestamp)->latest('id')->first();
            $voter = Voter::where([
                ['token', $token],
                ['voting_id', $currentVote->id]
            ])->first();
        } catch (\Throwable $th) {
            $voter = '';
        }
        Session::forget('token');

        if (!$voter) {
            return redirect()->route('main.index')->with(['message' => 'Mohon validasi ulang!']);
        }
        $voter->update($request->only(['candidate_id']));

        return redirect()->route('main.index')->with(['success' => 'Terimakasih atas partisipasinya!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($id != 'token') {
            return abort(404);
        }
        $request->session()->forget('token');
        return redirect()->route('main.index');
    }
}
