<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMSHomeIntro extends Model
{
    use SoftDeletes;

    protected $table = "cms_home_intro";

    protected $fillable = [
        'vision',
        'mission',
        'values',
        'is_disabled',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];
}
