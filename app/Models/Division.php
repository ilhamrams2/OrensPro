<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    // use HasFactory;

    protected $fillable = [
        'organisation_id',
        'name',
        'description'
    ];

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}