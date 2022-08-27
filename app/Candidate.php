<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'voting_id',
        'student_id',
        'foto',
        'visi',
        'misi',
        'total_vote'
    ];
}
