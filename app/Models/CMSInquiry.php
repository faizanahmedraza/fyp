<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMSInquiry extends Model
{
    protected $table = "cms_inquires";

    protected $fillable = [
        'name',
        'email',
        'contact',
        'subject',
        'message'
    ];
}
