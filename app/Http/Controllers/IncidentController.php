<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;

class IncidentController extends Controller
{

    public function issueCreate()
    {
        return view('incidents.create');
    }

    public function issueStore(Request $request)
    {
        Incident::create([
            'user_id' => auth()->id(),
            'check_in_issue' => 'Incidencia de entrada',
            'check_out_issue' => null,
            'description' => null,
            'time' => now()
        ]);

        return redirect()->route('dashboard')->with('warning', 'Incidencia registrada exitosamente.');
    }

}
