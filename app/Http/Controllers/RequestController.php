<?php

namespace App\Http\Controllers;

use session;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\RequestProperty;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = RequestProperty::latest()->paginate(8);
    
        // Retrieve events separately for each request
        $events = [];
        foreach ($requests as $request) {
            $events[$request->id] = Event::where('request_id', $request->id)->get();
        }
    
        // Pass requests and events to the view
        return view('admin.Requests.index', compact('requests', 'events'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $properties = Property::all();

        return view('admin.Requests.create',compact('properties'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           // Validate the form data
    $request->validate([
        'client_phone' => 'string',
        'client_name' => 'string',
        'client_type' => 'string',
        'other_request' => 'string',
        'request_name' => 'string',
        'property_id' => 'integer',
     
    ]);



    // Create a new Property instance and store in the database
    $request_property = new RequestProperty([
        'client_phone' => $request->get('client_phone'),
        'client_name' => $request->get('client_name'),
        'client_type' => $request->get('client_type'),
        'other_request' => $request->get('other_request'),
        'request_name' => $request->get('request_name'),
        'property_id' => $request->get('property_id'),

    ]);

    $request_property->save();

    // Redirect to a specific route or page after successful submission
    return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request= RequestProperty::find($id); 

        return view('admin.Requests.show',compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        // Find the RequestProperty record
        $propertyrequest = RequestProperty::find($id);
    
        // Check if the record exists
        if ($propertyrequest) {
            // Delete the related Event record if it exists
            if ($propertyrequest->event) {
                $propertyrequest->event->delete();
            }
    
            // Delete the RequestProperty record
            $propertyrequest->delete();
        }
    
        // Redirect back
        return redirect()->back();
    }
    



    public function applyAction(Request $request)
    {
        $selectedIds = explode(',', $request->input('selectedIds'));

       
        RequestProperty::whereIn('id', $selectedIds)->update(['traking_client' => $request->input('traking_client')]);

        $notification = array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );

        notify()->success('Welcome to Laravel Notify ⚡️');


        return redirect()->back();
    
    } 

    public function applyTime(Request $request)
{
    // Set the default timezone to Saudi Arabia
    date_default_timezone_set('Asia/Riyadh');

    $selectedIds = explode(',', $request->input('selectedIds'));
    $contactDatetime = $request->input('contact_datetime');

    // Validate input if needed

    foreach ($selectedIds as $requestId) {
        $requestProperty = RequestProperty::find($requestId);

        if ($requestProperty) {
            $clientName = $requestProperty->client_name;

            // Set the start date
            $start = Carbon::parse($contactDatetime);

            // Use updateOrCreate to either update existing event or create new
            Event::updateOrCreate(
                ['request_id' => $requestId], // Search criteria
                [
                    'title' => $clientName,  // Set the event title to the client name
                    'start' => $start,        // Set the start time
                    'end' => $start,          // Set the end time
                ]
            );
        }
    }

    return redirect()->back()->with('success', 'Datetime applied successfully!');
}


    public function reminders()
    {

      $reminders = RequestProperty::where('contact_datetime', '<=', Carbon::now())
      ->get();

    }  

    public function markAsRead(Request $request)
    {
        $notification = RequestProperty::findOrFail($request->id);
        $notification->update(['read' => true]);
    
        return redirect()->back()->with('success', 'Notification marked as read successfully');
    } 


    public function thank_you() {


        return view('admin.Requests.thank_you');
    }
    
}
