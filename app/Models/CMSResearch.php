<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMSResearch extends Model
{
    use SoftDeletes;

    protected $table = "cms_research";

    protected $fillable = [
        'title',
        'banner',
        'description',
        'is_disabled',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];
}
