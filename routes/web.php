<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

// Ruta Principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Ruta dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware autenticación
Route::middleware('auth')->group(function () {

    // Middleware admin
    Route::middleware([IsAdminMiddleware::class])->group(function () {

        // Rutas usuarios admin sin 'EDIT' y 'UPDATE'
        Route::resource('users', UserController::class)->except(['edit', 'update']);
    });

    // Rutas usuarios no admin solo con 'EDIT' y 'UPDATE'
    Route::resource('users', UserController::class)->only(['edit', 'update']);

    // Rutas registros entrada y salida
    Route::get('/dashboard', [AttendanceController::class, 'viewAttendance'])->name('dashboard');
    Route::get('/attendances', [AttendanceController::class, 'viewHistoricAttendance'])->name('attendance.index');
    Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('check-in');
    Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('check-out');

    // Rutas registro de incidencias
    Route::get('/incidents/create', [IncidentController::class, 'issueCreate'])->name('incidents.issueCreate');
    Route::get('/incidents', [IncidentController::class, 'issueIndex'])->name('incidents.issueIndex');
    Route::post('/incidents', [IncidentController::class, 'issueStore'])->name('incidents.issueStore');

    // Rutas vacaciones
    Route::resource('holidays', HolidayController::class);
    Route::get('/calendar', [HolidayController::class, 'showHolidays'])->name('calendar');
});

require __DIR__.'/auth.php';
