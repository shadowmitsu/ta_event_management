<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventReport;
use App\Models\EventReportFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventReportController extends Controller
{
    public function index()
    {
        $eventReports = EventReport::paginate(10);
        $events = Event::all();
        $users = User::all();
        return view('event_reports.index', compact('eventReports', 'events', 'users'));
    }

    public function list(Request $request)
    {
        $eventReports = EventReport::with(['event', 'files'])
                        ->paginate(10);
        return response()->json($eventReports);
    }

    public function show($id) {
        $eventReport = EventReport::with('mediaFiles')->findOrFail($id);
        
        return response()->json([
            'id' => $eventReport->id,
            'event_id' => $eventReport->event_id,
            'user_id' => $eventReport->user_id,
            'report_content' => $eventReport->report_content,
            'additional_link' => $eventReport->additional_link,
            'media_files' => $eventReport->mediaFiles->map(function($file) {
                return ['file_path' => $file->file_path];
            }),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'report_content' => 'nullable|string',
            'additional_link' => 'nullable|url',
            'files.*' => 'nullable|file|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $eventReport = EventReport::create([
            'event_id' => $request->event_id,
            'user_id' => $request->user_id,
            'report_content' => $request->report_content,
            'additional_link' => $request->additional_link,
        ]);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $filePath = $file->store('event_report_files', 'public');
                EventReportFile::create([
                    'event_report_id' => $eventReport->id,
                    'file_path' => $filePath,
                ]);
            }
        }

        return response()->json(['message' => 'Event report created successfully', 'eventReport' => $eventReport], 201);
    }

    public function edit($id)
    {
        $eventReport = EventReport::findOrFail($id);
        $events = Event::all();
        $users = User::all();

        return response()->json([
            'eventReport' => $eventReport,
            'events' => $events,
            'users' => $users,
        ]);
    }

    public function update(Request $request, $id)
    {
        $eventReport = EventReport::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'report_content' => 'nullable|string',
            'additional_link' => 'nullable|url',
            'files.*' => 'nullable|file|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $eventReport->update([
            'event_id' => $request->event_id,
            'user_id' => $request->user_id,
            'report_content' => $request->report_content,
            'additional_link' => $request->additional_link,
        ]);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $filePath = $file->store('event_report_files', 'public');
                EventReportFile::create([
                    'event_report_id' => $eventReport->id,
                    'file_path' => $filePath,
                ]);
            }
        }

        return response()->json(['message' => 'Event report updated successfully', 'eventReport' => $eventReport], 200);
    }

    public function destroy($id)
    {
        $eventReport = EventReport::findOrFail($id);

        foreach ($eventReport->files as $file) {
            Storage::disk('public')->delete($file->file_path);
            $file->delete();
        }

        $eventReport->delete();

        return response()->json(['message' => 'Event report deleted successfully'], 200);
    }
}
