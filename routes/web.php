<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/', function () {
    return view('auth.login');
})->name('auth.login');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/send-email', [AuthController::class, 'sendEmail']);

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/calendar', [EventController::class, 'calendar'])->name('events.calendar');
    Route::get('events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::get('events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/events/data/list', function (Request $request) {
        $events = Event::select('id', 'title', 'long_desc', 'short_desc','start_date as start', 'end_date as end', 'status')->get();
        return response()->json($events);
    });

    Route::prefix('event-reports')->group(function () {
        Route::get('/', [EventReportController::class, 'index'])->name('event_reports.index');
        Route::get('/list', [EventReportController::class, 'list'])->name('event_reports.list');
        Route::get('create', [EventReportController::class, 'create'])->name('event_reports.create');
        Route::get('{event_report}', [EventReportController::class, 'show'])->name('event_reports.show');
        Route::get('{event_report}/edit', [EventReportController::class, 'edit'])->name('event_reports.edit');
        Route::post('/', [EventReportController::class, 'store'])->name('event_reports.store');
        Route::put('{event_report}', [EventReportController::class, 'update'])->name('event_reports.update');
        Route::delete('{event_report}', [EventReportController::class, 'destroy'])->name('event_reports.destroy');
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

});
