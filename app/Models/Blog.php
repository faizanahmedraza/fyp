<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $table = "blog";

    protected $appends = [
        'logo'
    ];

    protected $fillable = [
        'author',
        'title',
        'image',
        'slug',
        'description',
        'is_active',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];
}
