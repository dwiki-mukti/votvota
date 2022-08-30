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

    public function getDataChartsAttribute()
    {
        $candidates = Candidate::where('voting_id', $this->attributes['id'])->get();
        $return = [];
        foreach ($candidates as $candidate) {
            $return['count_votes'][] = Voter::where([
                ['voting_id', $this->attributes['id']],
                ['candidate_id', $candidate->id]
            ])->count();
            $return['label'][] = $candidate->title;
        }
        $return['count_votes'][] = Voter::where([
            ['voting_id', $this->attributes['id']],
            ['candidate_id', null]
        ])->count();
        $return['label'][] = 'Undefined';

        return $return;
    }


    public function Rcandidate()
    {
        return $this->hasMany(new Candidate, 'voting_id', 'id');
    }

    public function Rvoter()
    {
        return $this->hasMany(new Voter, 'voting_id', 'id');
    }


    /*
    public static function boot()
    {
        parent::boot();
        static::creating(function ($voting) {
        });
    }
    */


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
