<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $holidays = Holiday::latest()->paginate(10) ;

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
        Holiday::create([
            'user_id' => auth()->id(),
            'beginning' => $request->input('beginning'),
            'finished' => $request->input('finished'),
            'status' => 'en espera',
        ]);

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
}
