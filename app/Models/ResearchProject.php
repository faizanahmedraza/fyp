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
        'research_proposal_id',
        'submission_date',
        'upload_project',
        'type'
    ];

    public function getUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getProposal(){
        return $this->belongsTo(ResearchProposal::class,'research_proposal_id','id');
    }
}
