<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function issueIndex()
    {
        $issues = Incident::paginate(10);

        return view('incidents.index', compact('issues'));
    }

    public function issueCreate()
    {
        return view('incidents.create');
    }

    public function issueStore(Request $request)
    {
        Incident::create([
            'user_id' => auth()->id(),
            'check_in_check_out_issue' => $request->input('check_in_check_out_issue'),
            'description' => $request->input('description'),
            'time' => now()
        ]);

        return redirect()->route('dashboard')->with('warning', 'Incidencia registrada exitosamente.');
    }

}
