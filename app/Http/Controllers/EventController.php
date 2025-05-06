<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAssign;
use App\Models\EventMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('createdBy')->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $users = User::all();
        return view('events.create', compact('users'));
    }

    public function show($a)
    {
        $event = Event::where('id', $a)
            ->first();
        return view('events.detail', compact('event'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id',
            'media.*' => 'nullable|file|mimes:jpg,png,jpeg,pdf|max:2048'
        ]);

        $event = Event::create([
            'title' => $request->title,
            'long_desc' => $request->long_desc,
            'status' => $request->status ?? 'draft',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'created_by' => Auth::id(),
        ]);

        foreach ($request->user_id as $userId) {
            EventAssign::create([
                'event_id' => $event->id,
                'user_id' => $userId
            ]);

            $user = User::where('id', $userId)
                ->first();

            $details = [
                'title' => $request->title,
                'body' => $request->short_desc,
                'full_name' => $user->full_name
            ];
    
            Mail::to($user->email)->send(new SendEmail($details));
        }

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $filePath = $file->store('media', 'public');
                EventMedia::create([
                    'event_id' => $event->id,
                    'media_type' => $file->getClientOriginalExtension(),
                    'file_path' => $filePath
                ]);
            }
        }
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }


    public function edit(Event $event)
    {
        $users = User::all();
        return view('events.edit', compact('event', 'users'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string',
            'long_desc' => 'nullable|string',
            'status' => 'required|in:draft,published,completed',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id',
            'media' => 'nullable|array',
            'media.*' => 'file|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
        ]);

        $event->update([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $event->users()->sync($request->user_id);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $filePath = $file->store('media');
                $event->media()->create(['path' => $filePath]);
            }
        }
        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function calendar()
    {
        return view('events.calendar');
    }


    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
