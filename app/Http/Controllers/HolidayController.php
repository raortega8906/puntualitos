<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHolidayRequest;
use App\Http\Requests\UpdateAdminHolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;
use App\Mail\HolidayCreatedMailable;
use App\Mail\HolidayStatusMailable;
use App\Models\Holiday;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $holidays = Holiday::where('user_id', auth()->user()->id)->latest()->paginate(10) ;

        return view('holidays.index', compact('holidays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('holidays.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHolidayRequest $request)
    {
        $beginning = Carbon::parse($request->input('beginning'));
        $finished = Carbon::parse($request->input('finished'));

        $cant_holiday = 0;

        // Itera sobre el rango de fechas desde el comienzo hasta el final (Chat GPT)
        for ($date = $beginning; $date->lte($finished); $date->addDay()) {
            if (!$date->isWeekend()) {
                $cant_holiday++;
            }
        }

        $holiday_used = auth()->user()->holidays - $cant_holiday;

        if($holiday_used < $cant_holiday) {
            return redirect()->route('holidays.index')->with('delete', 'No es posible realizar la petición de vacaciones.');
        }

        auth()->user()->update([
            'holidays' => $holiday_used
        ]);

        Holiday::create([
            'user_id' => auth()->id(),
            'beginning' => $request->input('beginning'),
            'finished' => $request->input('finished'),
            'status' => 'en espera',
        ]);

        $email = User::where('is_admin', true)->value('email');

        Mail::to($email)->send(new HolidayCreatedMailable);

        return redirect()->route('holidays.index')->with('status', 'Las vacaciones fueron solicitadas satisfactoriamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Holiday $holiday)
    {
        // A la espera de saber si se utiliza.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Holiday $holiday)
    {
        return view('holidays.edit', compact('holiday'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHolidayRequest $request, Holiday $holiday)
    {
        $holiday->update($request->validated());

        return redirect()->route('holidays.index')->with('status', 'Las vacaciones fueron actualizadas satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return redirect()->route('holidays.index', compact('holiday'))->with('delete', 'Las vacaciones fue eliminada satisfactoriamente');;
    }

    public function showHolidays()
    {
        // Obtén solo las vacaciones del usuario autenticado
        $holidays = Holiday::where('user_id', auth()->user()->id)->get();

        // Devuelve la vista con la variable 'holidays'
        return view('calendar', compact('holidays'));
    }

    // Admin: Vacaciones
    public function indexAdminHolidays()
    {
        if(!auth()->user()->is_admin) {
            abort(403, 'No autorizado.');
        }
        $holidays = Holiday::paginate(10);

        return view('admin.holidays.index', compact('holidays'));
    }

    public function editAdminHolidays(Holiday $holiday)
    {
        if(!auth()->user()->is_admin) {
            abort(403, 'No autorizado.');
        }

        return view('admin.holidays.edit', compact('holiday'));
    }

    public function updateAdminHolidays(UpdateAdminHolidayRequest $request, Holiday $holiday)
    {
        if(!auth()->user()->is_admin) {
            abort(403, 'No autorizado.');
        }

        $holiday->update($request->validated());

        $status = $request->input('status');
        $email = $holiday->user->email;

        Mail::to($email)->send(new HolidayStatusMailable($status));

        return redirect()->route('admin.holidays.index')->with('status', 'El estado de las vacaciones fue actualizado exitosamente.');
    }
}
