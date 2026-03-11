<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    // use HasFactory;

    protected $fillable = [
        'user_id',
        'qr_token',
        'latitude',
        'longitude',
        'result'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
