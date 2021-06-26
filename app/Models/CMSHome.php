<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMSHome extends Model
{
    use SoftDeletes;

    protected $table = "cms_home";

    protected $fillable = [
        'banner',
        'description',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];
}
