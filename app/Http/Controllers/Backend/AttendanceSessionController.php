<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttendanceSession;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttendanceSessionController extends Controller
{
    public function index()
    {
        $sessions = AttendanceSession::with(['organisation', 'division', 'creator'])
            ->latest()
            ->paginate(10);
            
        return view('backend.pages.attendance.index', compact('sessions'));
    }

    public function create()
    {
        $organisations = Organisation::all();
        $divisions = \App\Models\Division::all();
        return view('backend.pages.attendance.form', compact('organisations', 'divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'division_id' => 'nullable|exists:divisions,id',
            'title' => 'required|string|max:200',
            'session_date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'radius' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['qr_token'] = Str::random(32);
        $data['created_by'] = auth()->id();

        AttendanceSession::create($data);

        return redirect()->route('attendance-sessions.index')->with('success', 'Sesi absensi berhasil dibuat.');
    }

    public function edit(AttendanceSession $attendance_session)
    {
        $organisations = Organisation::all();
        $divisions = \App\Models\Division::all();
        return view('backend.pages.attendance.form', [
            'session' => $attendance_session,
            'organisations' => $organisations,
            'divisions' => $divisions
        ]);
    }

    public function update(Request $request, AttendanceSession $attendance_session)
    {
        $request->validate([
            'organisation_id' => 'required|exists:organisations,id',
            'division_id' => 'nullable|exists:divisions,id',
            'title' => 'required|string|max:200',
            'session_date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'radius' => 'nullable|integer',
        ]);

        $attendance_session->update($request->all());

        return redirect()->route('attendance-sessions.index')->with('success', 'Sesi absensi berhasil diperbarui.');
    }

    public function destroy(AttendanceSession $attendance_session)
    {
        $attendance_session->delete();
        return redirect()->route('attendance-sessions.index')->with('success', 'Sesi absensi berhasil dihapus.');
    }
}
