<?php

namespace App\Http\Controllers;

use App\Mail\IncidentCreatedMailable;
use App\Models\Incident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $email = User::where('is_admin', true)->value('email');


        Mail::to($email)->send(new IncidentCreatedMailable());

        return redirect()->route('dashboard')->with('warning', 'Incidencia registrada exitosamente.');
    }

}
