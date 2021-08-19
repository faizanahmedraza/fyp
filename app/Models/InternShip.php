<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternShip extends Model
{
    use SoftDeletes;

    protected $table = "internships";

    protected $fillable = [
        'title',
        'image',
        'slug',
        'description',
        'mode',
        'created_by',
        'updated_by',
    ];
    protected $dates = ['deleted_at'];

    public function getRegisteredInterns()
    {
        return $this->hasMany(RegisterIntern::class,'internship_id','id');
    }
}
