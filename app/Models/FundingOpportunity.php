<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundingOpportunity extends Model
{
    use SoftDeletes;

    protected $table = "funding_opportunities";

    protected $fillable = [
        'title',
        'principle_investigator',
        'funding_agency',
        'department',
        'amount',
        'is_disabled',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];
}
