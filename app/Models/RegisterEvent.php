<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisterEvent extends Model
{
    use SoftDeletes;

    protected $table = "register_events";

    protected $fillable = [
      'user_id',
      'event_id'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getEvent()
    {
        return $this->belongsTo(Event::class,'event_id','id');
    }
}
