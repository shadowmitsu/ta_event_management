<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventReport;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countEventDraft = Event::where('status', 'draft')
            ->count();
        $countEventPublish = Event::where('status', 'published')
            ->count();
        $countEventCompleted = Event::where('status', 'completed')
            ->count();

        $events = Event::orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $reports = EventReport::with('event', 'user') // Menyertakan relasi ke tabel events dan users
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard.index', compact(
            'countEventDraft', 'countEventPublish', 'countEventCompleted',
            'events', 'reports'
        ));
    }
}
