<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{

    protected $fillable = [
        'name',
        'description'
    ];

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function sessions()
    {
        return $this->hasMany(AttendanceSession::class);
    }
}
