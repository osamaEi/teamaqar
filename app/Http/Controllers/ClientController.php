<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\MultiImages;
use Illuminate\Http\Request;
use App\Models\RequestProperty;

class ClientController extends Controller
{
    public function index() {
    
        $properties = Property::latest()->paginate(4);
        
        // Retrieve multi-images separately for each property
        $multiImages = [];
        foreach ($properties as $property) {
            $multiImages[$property->id] = MultiImages::where('propery_id', $property->id)->get();
        }
    
        // Pass properties and multi-images to the view
        return view('admin.clients.index', compact('properties', 'multiImages'));
    } 


    public function show($id) {


        $property =Property::find($id);
        $multiImage = MultiImages::where('propery_id',$id)->get();


        return view('admin.clients.show',compact('property','multiImage'));
    } 



    public function create()
    {

        $properties = Property::all();

        return view('admin.clients.request',compact('properties'));

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
        'request_name' => 'string',
        'property_id' => 'integer',
     
    ]);



    // Create a new Property instance and store in the database
    $request_property = new RequestProperty([
        'client_phone' => $request->get('client_phone'),
        'client_name' => $request->get('client_name'),
        'client_type' => $request->get('client_type'),
        'request_name' => $request->get('request_name'),
        'property_id' => $request->get('property_id'),

    ]);

    $request_property->save();

    // Redirect to a specific route or page after successful submission
    return redirect()->route('clients.thank_you');
    } 


    public function thank_you() {


        return view('admin.clients.thank_you');
    }
}
