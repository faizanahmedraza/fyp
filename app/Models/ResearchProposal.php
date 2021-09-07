<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchProposal extends Model
{
    use SoftDeletes;

    protected $table = "research_proposals";

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
        'type'
    ];

    public function getUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
