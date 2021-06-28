<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $table = "gallery";

    protected $fillable = [
        'event_id',
        'image',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];

    public function getEvent()
    {
        return $this->belongsTo(Event::class,'event_id','id');
    }
}
