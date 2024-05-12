<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('events.index');
    }

    // Fetch events from the database
    public function fetchEvents()
    {
        $events = Event::all();
        
        return response()->json($events);
    }

    // Store a new event in the database
    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required',
         
        ]);


        $event = new Event();

        $event->title = $request->title;
 
        $event->save();

        return redirect()->back();
    }
}
