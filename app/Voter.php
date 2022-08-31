<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    protected $fillable = [
        'voting_id',
        'student_id',
    ];
}
