<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        $attendance = Attendance::where('user_id', auth()->id())->latest()->first();

        if(!$attendance || $attendance->check_out){
            Attendance::create([
                'user_id' => auth()->id(),
                'check_in' => now(),
                'ip_address_check_in' => $request->input('public_ip')
            ]);

            return redirect()->back()->with('status', 'Check-in registrado exitosamente.');
        }

        return redirect()->back()->with('error', 'No puedes hacer check-in sin haber hecho check-out.');

    }

    public function checkOut(Request $request)
    {
        $attendance = Attendance::where('user_id', auth()->id())->latest()->first();

        if($attendance && !$attendance->check_out) {
            $attendance->update([
                'check_out' => now(),
                'ip_address_check_out' => $request->input('public_ip')
            ]);

            return redirect()->back()->with('status', 'Check-out registrado exitosamente.');
        }

        return redirect()->back()->with('error', 'No puedes hacer check-out sin haber hecho check-in.');
    }

    public function viewAttendance()
    {
        $attendances = Attendance::orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('attendances'));
    }

    public function viewHistoricAttendance()
    {
        $attendances = Attendance::orderBy('created_at', 'desc')->paginate(10);

        return view('attendances.index', compact('attendances'));
    }
}
