<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Cviebrock\EloquentSluggable\Sluggable;

class Voting extends Model
{
    use SoftDeletes
    // , Sluggable
    ;


    protected $fillable = [
        'title',
        'slug',
        'description',
        'end_at'
    ];


    public function Rcandidate()
    {
        return $this->hasMany(new Candidate, 'voting_id', 'id');
    }


    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'title'
    //         ]
    //     ];
    // }
}
