<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisterIntern extends Model
{
    use SoftDeletes;

    protected $table = "register_interns";

    protected $fillable = [
        'user_id',
        'internship_id',
        'guest_name',
        'guest_email',
        'status',
        'visitor_ip'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getInternship()
    {
        return $this->belongsTo(InternShip::class, 'internship_id', 'id');
    }
}
