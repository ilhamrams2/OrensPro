<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceSession;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Show the marking sheet for a session
     */
    public function showMarkingSheet(AttendanceSession $session)
    {
        // Get all members of the organisation (ekskul) associated with this session
        $members = User::where('organisation_id', $session->organisation_id)
            ->where('role', 'member')
            ->get();

        // Get existing attendance records for this session
        $attendances = Attendance::where('session_id', $session->id)
            ->get()
            ->keyBy('user_id');

        return view('backend.pages.attendance.marking', compact('session', 'members', 'attendances'));
    }

    /**
     * Save/Update attendance status
     */
    public function mark(Request $request, AttendanceSession $session)
    {
        $request->validate([
            'attendances' => 'required|array',
            'attendances.*.user_id' => 'required|exists:users,id',
            'attendances.*.status' => 'required|in:hadir,sakit,izin,alpa',
        ]);

        foreach ($request->attendances as $data) {
            Attendance::updateOrCreate(
                [
                    'session_id' => $session->id,
                    'user_id' => $data['user_id']
                ],
                [
                    'status' => $data['status'],
                    'checkin_time' => $data['status'] === 'hadir' ? now() : null,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data absensi berhasil disimpan.');
    }
}
