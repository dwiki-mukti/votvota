<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use SoftDeletes;

    public $rules = [
        'leader_id' => 'required|exists:students,id',
        'leader_image' => 'nullable|mimes:SVG,jpeg,jpg,png,gif',
        'co_leader_id' => 'required|exists:students,id',
        'co_leader_image' => 'nullable|mimes:SVG,jpeg,jpg,png,gif',
        'visi' => 'string|nullable',
        'misi' => 'string|nullable'
    ];

    public function getTitleAttribute()
    {
        return ($this->Rleader->name ?? null) . ' & ' .( $this->Rleader->name ?? null);
    }

    public function Rleader()
    {
        return $this->hasOne(new Student, 'id', 'leader_id');
    }

    public function RcoLeader()
    {
        return $this->hasOne(new Student, 'id', 'co_leader_id');
    }

    public function Rvoting()
    {
        return $this->hasOne(new Voting, 'id', 'voting_id');
    }


    protected $fillable = [
        'voting_id',
        'leader_id',
        'leader_image',
        'co_leader_id',
        'co_leader_image',
        'visi',
        'misi',
        'total_votes'
    ];

}
