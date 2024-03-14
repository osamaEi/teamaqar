<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

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

}
