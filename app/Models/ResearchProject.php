<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchProject extends Model
{
    use SoftDeletes;

    protected $table = "research_projects";

    protected $fillable = [
        'user_id',
        'title',
        'investigator_details',
        'abstract',
        'agency',
        'amount',
        'submission_date',
        'upload_research',
        'status',
    ];

    public function getUser(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
