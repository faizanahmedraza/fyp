<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = "event";

    protected $fillable = [
        'title',
        'image',
        'slug',
        'description',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];

    public function getGalleries()
    {
        return $this->hasMany(Gallery::class,'event_id','id');
    }
}
