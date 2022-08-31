<?php

namespace App\Jobs;

use App\Candidate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class IncrementVote implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $candidate_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($candidate_id)
    {
        $this->candidate_id = $candidate_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Candidate::find($this->candidate_id)->increment('total_votes');
    }
}
