<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadSample extends Model
{
    use SoftDeletes;

    protected $table = "upload_samples";

    protected $fillable = [
        'name',
        'type',
        'is_disabled'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
