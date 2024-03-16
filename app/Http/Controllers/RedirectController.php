<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    
    public function dashboard() {


        return  view('admin.dashboard.index');
    }


    public function properties() {

        $properties = Property::latest()->paginate(4);


        return  view('admin.property.index',compact('properties'));
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
