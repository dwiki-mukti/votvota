<?php

namespace App\Http\Middleware;

use App\Voter;
use App\Voting;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Crypt;

class VoterValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $status)
    {
        try {
            $token = Crypt::decryptString($request->session()->get('token', 'u'));
            $currentVote = Voting::where('end_at', '>', Carbon::now()->timestamp)->latest('id')->first();
            $voter = Voter::where([
                ['token', $token],
                ['voting_id', $currentVote->id],
                ['candidate_id', null]
            ])->first();
        } catch (\Throwable $th) {
            $voter = null;
            $request->session()->forget('token');
        }

        if (($status == 'guest') && $voter && !$voter->voter_id) {
            return redirect()->route('main.show', 'voting');
        } else if (($status == 'guard') && !($voter && !$voter->voter_id)) { // to voting page
            return redirect()->route('main.index');
        }

        return $next($request);
    }
}
