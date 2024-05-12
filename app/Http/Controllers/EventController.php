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

                       ->whereDate('end',   '<=', $request->end)

                       ->get(['id', 'title', 'start', 'end']);

  

             return response()->json($data);

        }

  

        return view('admin.calender.index');

    }

 

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function ajax(Request $request)

    {

 

        switch ($request->type) {

           case 'add':
            $start = Carbon::parse($request->start)->format('Y-m-d H:i:s');

            // Parse and format the end datetime
            $end = Carbon::parse($request->end)->format('Y-m-d H:i:s');
            
            // Create the event with the parsed and formatted datetime values
            $event = Event::create([
                'title' => $request->title,
                'start' => $start,
                'end' => $end,
            ]);

 

              return response()->json($event);

             break;

  

           case 'update':

              $event = Event::find($request->id)->update([

                  'title' => $request->title,

                  'start' => $request->start,

                  'end' => $request->end,

              ]);

 

              return response()->json($event);

             break;

  

           case 'delete':

              $event = Event::find($request->id)->delete();

  

              return response()->json($event);

             break;

             

           default:

             # code...

             break;

        }

    }

    public function storeEvent(Request $request) {

        $validatedData = $request->validate([
            'title' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        // Create a new event instance
        $event = new Event;
        $event->title = $validatedData['title'];
        $event->start = $validatedData['start'];
        $event->end = $validatedData['end'];
        $event->save();

        return redirect()->back();
    }
}
