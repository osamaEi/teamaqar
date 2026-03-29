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
        $now   = \Carbon\Carbon::now();
        $today = $now->copy()->startOfDay();

        // ── Stats ──────────────────────────────────────────────
        $propertyCount   = Property::count();
        $availableCount  = Property::where('status', 'Available')->count();
        $soldCount       = Property::where('status', 'Sold')->count();
        $reservedCount   = Property::where('status', 'Reserved')->count();
        $requestCount     = RequestProperty::count();
        $newRequestsToday = RequestProperty::whereDate('created_at', $today)->count();

        $todayEvents    = Event::whereDate('start', $today)->count();
        $unreadEvents   = Event::where('read', false)->count();

        // ── Recent data ────────────────────────────────────────
        $recentProperties = Property::with('multiImages')->latest()->take(6)->get();
        $recentRequests   = RequestProperty::latest()->take(6)->get();
        $todayTasks       = Event::whereDate('start', $today)->latest()->take(5)->get();

        // ── Map properties ─────────────────────────────────────
        $mapProperties = Property::whereNotNull('latitude')->whereNotNull('longitude')->take(30)->get();

        return view('admin.dashboard.index', compact(
            'propertyCount', 'availableCount', 'soldCount', 'reservedCount',
            'requestCount', 'newRequestsToday',
            'todayEvents', 'unreadEvents',
            'recentProperties', 'recentRequests', 'todayTasks',
            'mapProperties'
        ));
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
