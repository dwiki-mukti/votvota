<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voter extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'voting_id',
        'student_id',
        'status'
    ];
}
