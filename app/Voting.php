<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Voting extends Model
{
    use SoftDeletes, Sluggable;


    protected $fillable = [
        'title',
        'slug',
        'description',
        'end_at'
    ];

    public function getGolputAttribute()
    {
        $students = Student::whereNull('thn_lulus')->count();
        $voter = $this->Rcandidate->sum('total_votes');
        return $students - $voter;
    }

    public function Rcandidate()
    {
        return $this->hasMany(new Candidate, 'voting_id', 'id');
    }

    public function Rvoter()
    {
        return $this->hasMany(new Voter, 'voting_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
