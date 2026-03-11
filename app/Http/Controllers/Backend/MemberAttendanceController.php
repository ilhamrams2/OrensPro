<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberAttendanceController extends Controller
{
    /**
     * Show the presence marking page for members
     */
    public function index()
    {
        $user = Auth::user();
        
        // Find active sessions for the user's organisation (Ekskul) and division
        $sessions = AttendanceSession::where('organisation_id', $user->organisation_id)
            ->where(function($query) use ($user) {
                $query->whereNull('division_id')
                      ->orWhere('division_id', $user->division_id);
            })
            ->whereDate('session_date', now())
            ->get();

        // Check if user already marked attendance for these sessions
        $attendances = Attendance::where('user_id', $user->id)
            ->whereIn('session_id', $sessions->pluck('id'))
            ->get()
            ->keyBy('session_id');

        // Fetch attendance history
        $history = Attendance::where('user_id', $user->id)
            ->with(['session.organisation'])
            ->latest()
            ->take(10)
            ->get();

        return view('backend.pages.attendance.presence', compact('sessions', 'attendances', 'history'));
    }

    /**
     * Mark self-attendance
     */
    public function store(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:attendance_sessions,id'
        ]);

        $user = Auth::user();
        $session = AttendanceSession::findOrFail($request->session_id);

        // Security check: ensure the session belongs to the user's organisation
        if ($session->organisation_id !== $user->organisation_id) {
            return redirect()->back()->with('error', 'Sesi ini tidak tersedia untuk ekskul Anda.');
        }

        // Prevent double marking
        $exists = Attendance::where('user_id', $user->id)
            ->where('session_id', $session->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'Anda sudah melakukan absensi untuk sesi ini.');
        }

        Attendance::create([
            'user_id' => $user->id,
            'session_id' => $session->id,
            'checkin_time' => now(),
            'status' => 'hadir',
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->back()->with('success', 'Absensi berhasil! Semangat berkegiatan.');
    }
}
