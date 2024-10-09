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

        ]);

        return redirect()->route('dashboard')->with('warning', 'Incidencia registrada exitosamente.');
    }

}
