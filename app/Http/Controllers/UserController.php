<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\UserUpdateMailable;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // dd($request->validated());
        User::create($request->validated());

        return redirect()->route('users.index')->with('status', 'Usuario registrado exitosamente.');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (auth()->user()->id !== $user->id && !auth()->user()->is_admin) {
            abort(403, 'No autorizado.');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // dd($request->validated());
        // dd($user->email);

        $user->update($request->validated());

        if(auth()->user()->is_admin) {
            Mail::to($user->email)->send(new UserUpdateMailable($user->first_name, $user->last_name));
            return redirect()->route('users.index', compact('user'))->with('status', 'Usuario actualizado exitosamente.');
        }
        else {
            return redirect()->route('dashboard', compact('user'))->with('status', 'Usuario actualizado exitosamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('delete', 'Usuario eliminado correctamente.');
    }
}
