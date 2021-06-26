<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMSNews extends Model
{
    use SoftDeletes;

    protected $table = "cms_news";

    protected $fillable = [
        'title',
        'banner',
        'description',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];
}
