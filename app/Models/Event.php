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
        'mode',
        'schedule',
        'location',
        'is_disabled',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];

    public function getGalleries()
    {
        return $this->hasMany(Gallery::class,'event_id','id');
    }

    public function getRegisteredEvents()
    {
        return $this->hasMany(RegisterEvent::class,'event_id','id');
    }
}
