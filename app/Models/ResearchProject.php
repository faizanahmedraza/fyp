<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProject extends Model
{
    use HasFactory;

    protected $table = "research_projects";

    protected $fillable = [
        'title',
        'principal_detail',
        'abstract',
        'agency_for_project',
        'account_requested',
        'date_of_submission',
        'research_document'
    ];
}
