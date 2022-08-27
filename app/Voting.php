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
        'end_at'
    ];


    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'title'
    //         ]
    //     ];
    // }
}
