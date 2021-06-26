<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMSORICMember extends Model
{
    use SoftDeletes;

    protected $table = "cms_home_oric_members";

    protected $fillable = [
        'profile_picture',
        'name',
        'designation',
        'description',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];
}
