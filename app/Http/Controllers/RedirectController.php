<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Property;
use App\Models\MultiImages;
use Illuminate\Http\Request;
use App\Models\RequestProperty;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    
    public function dashboard() {
        $requests = RequestProperty::latest()->paginate(4);
    
        // Retrieve events separately for each request
        $events = [];
        foreach ($requests as $request) {
            $events[$request->id] = Event::where('request_id', $request->id)->get();
        }

        return  view('admin.dashboard.index',compact('requests','events'));
    }


   public function properties() {
    
    $properties = Property::latest()->paginate(4);
    
    // Retrieve multi-images separately for each property
    $multiImages = [];
    foreach ($properties as $property) {
        $multiImages[$property->id] = MultiImages::where('propery_id', $property->id)->get();
    }

    // Pass properties and multi-images to the view
    return view('admin.property.index', compact('properties', 'multiImages'));
}



    public function notification() {


        return view ('admin.notifications.index');
    } 

    public function Logout(Request $request) {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

        

    } 

}
