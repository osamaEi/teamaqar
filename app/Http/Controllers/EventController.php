<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                      ->whereDate('end', '<=', $request->end)
                      ->get(['id', 'title', 'start', 'end', 'backgroundColor', 'borderColor', 'textColor']);

            return response()->json($data);
        }

        return view('admin.calender.index');
    }

    /**
     * Handle AJAX requests for calendar events
     */
    public function ajax(Request $request)
    {
        switch ($request->type) {
            case 'add':
                $start = Carbon::parse($request->start)->format('Y-m-d H:i:s');
                $end = $request->end ? Carbon::parse($request->end)->format('Y-m-d H:i:s') : $start;
                $color = $request->color ?? '#11760E';

                $event = Event::create([
                    'title' => $request->title,
                    'start' => $start,
                    'end' => $end,
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'textColor' => '#ffffff',
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = Event::find($request->id);
                if ($event) {
                    $event->update([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end' => $request->end,
                    ]);
                }
                return response()->json($event);
                break;

            case 'delete':
                $event = Event::find($request->id);
                if ($event) {
                    $event->delete();
                }
                return response()->json(['success' => true]);
                break;

            default:
                return response()->json(['error' => 'Invalid type'], 400);
                break;
        }
    }

    /**
     * Store event from form
     */
    public function storeEvent(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'start' => 'required|date',
            'end' => 'nullable|date',
        ]);

        $event = new Event;
        $event->title = $validatedData['title'];
        $event->start = $validatedData['start'];
        $event->end = $validatedData['end'] ?? $validatedData['start'];
        $event->backgroundColor = '#11760E';
        $event->borderColor = '#11760E';
        $event->textColor = '#ffffff';
        $event->save();

        return redirect()->back()->with('success', 'تم إضافة الموعد بنجاح');
    }

    /**
     * Mark event as read
     */
    public function markAsRead($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->read = !$event->read;
            $event->save();
            return response()->json(['success' => true, 'read' => $event->read]);
        }
        return response()->json(['error' => 'Event not found'], 404);
    }
}
