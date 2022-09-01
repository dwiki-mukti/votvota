<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Student;
use App\Voting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::whereNull('thn_lulus')->get();
        return view('candidate.setData', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # init
        $candidate = new Candidate();
        $currentVote = Voting::where('end_at', '>', Carbon::now()->timestamp)
                        ->orWhereNull('end_at')
                        ->latest('id')
                        ->firstOrFail(['id']);

        #validate
    	request()->validate($candidate->rules);

        # store data
        $val = $request->except(['voting_id']);
        if ($request->hasFile('leader_image')) {
            $image_name =  date("Ymdhis") . "_leader_image." . $request->file('leader_image')->extension();
            $request->file('leader_image')->storeAs('/images/candidate/leader_image', $image_name, 'public');
            $val["leader_image"] = 'images/candidate/leader_image/' . $image_name;
        }
        if ($request->hasFile('co_leader_image')) {
            $image_name =  date("Ymdhis") . "_co_leader_image." . $request->file('co_leader_image')->extension();
            $request->file('co_leader_image')->storeAs('/images/candidate/co_leader_image', $image_name, 'public');
            $val["co_leader_image"] = 'images/candidate/co_leader_image/' . $image_name;
        }
        $val['voting_id'] = $currentVote->id;
        $candidate->create($val);
                        
        # return
        return redirect()->route('voting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate = Candidate::whereHas('Rvoting', fn($q)=>(
            $q->where('end_at', '>', Carbon::now()->timestamp)
            ->orWhereNull('end_at')
        ))
        ->where('id', $id)
        ->firstOrFail();

        $students = Student::whereNull('thn_lulus')->get();
        return view('candidate.setData', compact('candidate', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        # init
        $currentVote = Voting::where('end_at', '>', Carbon::now()->timestamp)
            ->orWhereNull('end_at')
            ->latest('id')
            ->firstOrFail(['id']);
        $candidate = Candidate::where([
            'id' => $id,
            'voting_id' => $currentVote->id
        ])->firstOrFail();

        #validate
    	request()->validate($candidate->rules);

        # store data
        $val = $request->except(['voting_id']);
        if ($request->hasFile('leader_image')) {
            $image_name =  date("Ymdhis") . "_leader_image." . $request->file('leader_image')->extension();
            $request->file('leader_image')->storeAs('/images/candidate/leader_image', $image_name, 'public');
            $val["leader_image"] = 'images/candidate/leader_image/' . $image_name;
        }
        if ($request->hasFile('co_leader_image')) {
            $image_name =  date("Ymdhis") . "_co_leader_image." . $request->file('co_leader_image')->extension();
            $request->file('co_leader_image')->storeAs('/images/candidate/co_leader_image', $image_name, 'public');
            $val["co_leader_image"] = 'images/candidate/co_leader_image/' . $image_name;
        }

        $candidate->update($val);
                        
        # return
        return redirect()->route('voting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        # init
        $currentVote = Voting::where('end_at', '>', Carbon::now()->timestamp)
            ->orWhereNull('end_at')
            ->latest('id')
            ->firstOrFail(['id']);
        $candidate = Candidate::where([
            'id' => $id,
            'voting_id' => $currentVote->id
        ])->firstOrFail();

        # delete
        $candidate->delete();

        # return
        return back();
    }
}
