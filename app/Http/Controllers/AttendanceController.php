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

            if($request->input('public_ip') != '79.117.222.102' || $request->input('public_ip') == null)
            {
                redirect()->back()->with('error', 'Hubo un error, inténtelo de nuevo más tarde.');
            }
            else {
                Attendance::create([
                    'user_id' => auth()->id(),
                    'check_in' => now()->addHours(2),
                    'ip_address_check_in' => $request->input('public_ip')
                ]);

                return redirect()->back()->with('status', 'Check-in registrado exitosamente.');
            }

        }

        return redirect()->back()->with('error', 'No puedes hacer check-in sin haber hecho check-out.');

    }

    public function checkOut(Request $request)
    {
        $attendance = Attendance::where('user_id', auth()->id())->latest()->first();

        if($attendance && !$attendance->check_out) {

            if($request->input('public_ip') != '79.117.222.102' || $request->input('public_ip') == null)
            {
                return redirect()->back()->with('error', 'Hubo un error, inténtelo de nuevo más tarde.');
            }

            else {

                $check_in = trim($attendance->check_in);
                $dateParts = explode(' ', $check_in);
                $date = $dateParts[0];

                    if ($date != now()->addHours(2)->toDateString()) {
                    $attendance->update([
                        'check_out' => $date.' 23:59:59',
                        'ip_address_check_out' => $request->input('public_ip')
                    ]);
                }
                else {
                    $attendance->update([
                        'check_out' => now()->addHours(2),
                        'ip_address_check_out' => $request->input('public_ip')
                    ]);
                }

                return redirect()->back()->with('status', 'Check-out registrado exitosamente.');
            }

        }

        return redirect()->back()->with('error', 'No puedes hacer check-out sin haber hecho check-in.');
    }

    public function viewAttendance()
    {
        $attend = Attendance::where('user_id', auth()->id())->latest()->first();
        $flag_checkin = false;
        $flag_checkout = false;

        // Obtener el día de la semana (0 = Domingo, 1 = Lunes, ..., 6 = Sábado)
        $dayOfWeek = now()->addHours(2)->dayOfWeek;

        // Verificar si es viernes o fin de semana
        $isWeekend = ($dayOfWeek == 6 || $dayOfWeek == 0); // Sábado o Domingo
        $isFriday = ($dayOfWeek == 5); // Viernes

        $count_checkin = Attendance::where('user_id', auth()->id())
            ->whereDate('check_in', now()->addHours(2)->toDateString())
            ->count();

        $count_checkout = Attendance::where('user_id', auth()->id())
            ->whereDate('check_out', now()->addHours(2)->toDateString())
            ->count();

        if($attend && !$attend->check_out) {
            $flag_checkout = true;
        }

        if(!$attend || $attend->check_out) {
            $flag_checkin = true;
        }

        if ($count_checkin >= 2) {
            $flag_checkin = false;
        }
        if ($count_checkout >= 2) {
            $flag_checkout = false;
        }

        // Validaciones especiales
        if ($isFriday) {
            // Solo una entrada y una salida
            if ($count_checkin >= 1) {
                $flag_checkin = false;
            }
            if ($count_checkout >= 1) {
                $flag_checkout = false;
            }
        } elseif ($isWeekend) {
            // Deshabilitar ambos botones los fines de semana
            $flag_checkin = false;
            $flag_checkout = false;
        }

        $attendances = Attendance::orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('attendances', 'flag_checkin', 'flag_checkout', 'isWeekend', 'isFriday'));
    }

    public function viewHistoricAttendance()
    {
        $attendances = Attendance::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('attendances.index', compact('attendances'));
    }
}
