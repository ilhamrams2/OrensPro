<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    // use HasFactory;

    protected $fillable = [
        'organisation_id',
        'title',
        'qr_token',
        'session_date',
        'start_time',
        'end_time',
        'latitude',
        'longitude',
        'radius',
        'created_by'
    ];

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class,'session_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
