<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\MultiImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    

    public function create() {


        return view('admin.property.create');



    } 


    public function show($id) {


        $property =Property::find($id);
        $multiImage = MultiImages::where('propery_id',$id)->get();


        return view('admin.property.show',compact('property','multiImage'));
    }


    public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'name' => 'string|nullable',
        'number' => 'string|nullable',
        'area' => 'string|nullable',
        'Location' => 'string|nullable',
        'property_type' => 'string|nullable',
        'status' => 'string|nullable',
        'description' => 'string|nullable',
        'price' => 'numeric|nullable',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'mediator1' => 'string|nullable',
        'phone1' => 'string|nullable',
        'mediator2' => 'string|nullable',
        'phone2' => 'string|nullable',
        'owner' => 'string|nullable',
        'owner_status' => 'string|nullable',
        'ophone' => 'string|nullable',
        'notes' => 'string|nullable',
        'propery_cat' => 'string|nullable',
    ]);

    // Handle file upload
    $img = time().'.'.$request->image->extension();
    $request->image->storeAs('public/img/', $img);

    // Create a new Property instance and store in the database
    $property = new Property([
        'name' => $request->get('name'),
        'number' => $request->get('number'),
        'area' => $request->get('area'),
        'Location' => $request->get('Location'),
        'property_type' => $request->get('property_type'),
        'status' => $request->get('status'),
        'description' => $request->get('description'),
        'price' => $request->get('price'),
        'image' => $img,
        'mediator1' => $request->get('mediator1'),
        'phone1' => $request->get('phone1'),
        'mediator2' => $request->get('mediator2'),
        'phone2' => $request->get('phone2'),
        'owner' => $request->get('owner'),
        'owner_status' => $request->get('owner_status'),
        'ophone' => $request->get('ophone'),
        'notes' => $request->get('notes'),
        'propery_cat' => $request->get('propery_cat'),
    ]);

    $property->save();

    if( $property->save()){
        $files = $request->multi_img;
      
        if(!empty($files)){
            foreach($files as $file){
                $imgName = date('YmdHi').$file->getClientOriginalName();
                $file->move('upload/property/multi_img/',$imgName);
                $subimage['multi_img'] = $imgName;

                $subimage = new MultiImages();
                $subimage->propery_id = $property->id;
                $subimage->images = $imgName;
                $subimage->save();
            }


    // Redirect to a specific route or page after successful submission
    return redirect()->route('properties.page');
}
    }
}


    public function destroy($id) {

        $property = Property::find($id);

        $property->delete();
        

        return redirect()->route('properties.page');
    }

    public function edit($id)
    {
        $property = Property::find($id);
        return view('admin.property.edit', compact('property'));
    }


    public function update(Request $request, Property $property)
{
    // Validate the form data
    $request->validate([
        'name' => 'string|nullable',
        'number' => 'string|nullable',
        'area' => 'string|nullable',
        'Location' => 'string|nullable',
        'property_type' => 'string|nullable',
        'status' => 'string|nullable',
        'description' => 'string|nullable',
        'price' => 'numeric|nullable',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
        'mediator1' => 'string|nullable',
        'phone1' => 'string|nullable',
        'mediator2' => 'string|nullable',
        'phone2' => 'string|nullable',
        'owner' => 'string|nullable',
        'owner_status' => 'string|nullable',
        'ophone' => 'string|nullable',
        'notes' => 'string|nullable',
        'propery_cat' => 'string|nullable',
    ]);

    // Handle file upload if a new image is provided
    if ($request->hasFile('image')) {
        // Delete previous image if exists
        if ($property->image) {
            Storage::delete('public/img/' . $property->image);
        }
        // Upload new image
        $img = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/img/', $img);
        $property->image = $img;
    }

    // Update other property attributes
    $property->name = $request->get('name');
    $property->number = $request->get('number');
    $property->area = $request->get('area');
    $property->Location = $request->get('Location');
    $property->property_type = $request->get('property_type');
    $property->status = $request->get('status');
    $property->description = $request->get('description');
    $property->price = $request->get('price');
    $property->mediator1 = $request->get('mediator1');
    $property->phone1 = $request->get('phone1');
    $property->mediator2 = $request->get('mediator2');
    $property->phone2 = $request->get('phone2');
    $property->owner = $request->get('owner');
    $property->owner_status = $request->get('owner_status');
    $property->ophone = $request->get('ophone');
    $property->notes = $request->get('notes');
    $property->propery_cat = $request->get('propery_cat');

    $property->save();

    $files = $request->multi_img;
    if (!empty($files)) {
        // Delete older multi-images
        MultiImages::where('propery_id', $property->id)->delete();
        // Add new multi-images
        foreach ($files as $file) {
            $imgName = date('YmdHi') . $file->getClientOriginalName();
            $file->move('upload/property/multi_img/', $imgName);

            $subimage = new MultiImages();
            $subimage->propery_id = $property->id;
            $subimage->images = $imgName;
            $subimage->save();
        }
    }


    return redirect()->route('properties.page');
}




}
