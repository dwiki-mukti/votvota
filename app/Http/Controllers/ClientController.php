<?php

namespace App\Http\Controllers;

use App\Jobs\IncrementVote;
use App\User;
use App\Voter;
use App\Voting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        if (!$currentVote) return view('client.unset');
        return view('client.login', compact('currentVote'));
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
        # validate
        $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        # get user
        $user = User::where([
            ['email', $request->email],
            ['role', 'Siswa']
        ])->first();

        #check user
        if (!$user) {
            return back()->withInput()->withErrors(['email' => 'User tidak ditemukan.']);
        }

        # check password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withInput()->withErrors(['password' => 'Password salah!']);
        }

        #add session
        Auth::login($user, $request->remember);

        #return
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
        # get data
        $currentVote = Voting::where('end_at', '>', Carbon::now()->timestamp)->latest('id')->first();
        $voter = Voter::where('student_id', Auth::user()->student->id)->first();

        # route voting
        if ($id == 'voting') {
            # check voter
            if ($voter && ($voter->voting_id >= $currentVote->id)) {
                return redirect()->route('main.show', 'done');
            }

            #return
            return view('client.voting', compact('currentVote'));
        }

        # route done
        if ($id == 'done') {
            # check voter
            if (!($voter && ($voter->voting_id >= $currentVote->id))) {
                return redirect()->route('main.show', 'voting');
            }

            #return
            return view('client.success');
        }

        return abort(404);
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
        # check route
        if ($id != 'voting') return abort(404);

        # check vote aktif
        $currentVote = Voting::where('end_at', '>', Carbon::now()->timestamp)->latest('id')->first();
        if (!$currentVote) {
            Auth::logout();
            return redirect()->route('main.index');
        }

        # check voter
        $voter = Voter::where('student_id', Auth::user()->student->id)->first();
        if (!$voter) {
            $voter = new Voter;
            $voter->student_id = Auth::user()->student->id;
        } elseif ($voter->voting_id >= $currentVote->id) {
            return redirect()->route('main.show', 'done')->with(['error' => 'Akun ini sudah digunakan untuk memilih!']);
        }

        # update status voter
        $voter->voting_id = $currentVote->id;
        $voter->save();

        # todo redis add count vote
        IncrementVote::dispatch($request->candidate_id)->onQueue('increment_vote');

        # return
        return redirect()->route('main.show', 'done')->with(['success' => 'Terimakasih atas partisipasinya!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // 
    }
}
