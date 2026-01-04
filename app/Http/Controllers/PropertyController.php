<?php

namespace App\Http\Controllers;

use App\Models\Shape;
use App\Models\Property;
use App\Models\Coordinate;
use App\Models\MultiImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    

    public function create() {


        return view('admin.property.create');



    }
    
    
    public function createdraw() {


        return view('admin.property.createdraw');



    } 

    public function map() {

        $places  =Property::all();

        return view('admin.property.map',compact('places'));



    } 

    public function show($id)
    {
        $property = Property::with(['shapes.coordinates'])->findOrFail($id);
        $multiImage = MultiImages::where('propery_id', $id)->get();
    
        return view('admin.property.show', compact('property', 'multiImage'));
    }
    
    public function storeDraw(Request $request)
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
            'land_situation' => 'string|nullable',
            'propery_cat' => 'string|nullable',
            'latitude' => 'string|nullable',
            'longitude' => 'string|nullable',
            'drawn_data' => 'string|nullable', // Validate drawn data
        ]);
    
        // Create a new Property instance and store in the database
        $property = new Property([
            'name' => $request->get('name'),
            'number' => $request->get('number'),
            'area' => $request->get('area'),
            'Location' => $request->get('location'),
            'property_type' => $request->get('property_type'),
            'status' => $request->get('status'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'mediator1' => $request->get('mediator1'),
            'land_situation' => $request->get('land_situation'),
            'phone1' => $request->get('phone1'),
            'mediator2' => $request->get('mediator2'),
            'phone2' => $request->get('phone2'),
            'owner' => $request->get('owner'),
            'owner_status' => $request->get('owner_status'),
            'ophone' => $request->get('ophone'),
            'notes' => $request->get('notes'),
            'propery_cat' => $request->get('propery_cat'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
        ]);
    
        $property->save();
    
        // Check if drawn_data is provided and save the shapes
        if ($request->has('drawn_data') && !empty($request->input('drawn_data'))) {
            $shapeData = json_decode($request->input('drawn_data'), true);
    
            if (is_array($shapeData)) {
                foreach ($shapeData as $shape) {
                    $newShape = Shape::create([
                        'type' => $shape['type'],
                        'property_id' => $property->id,
                    ]);
    
                    if (isset($shape['coordinates'])) {
                        foreach ($shape['coordinates'] as $coord) {
                            Coordinate::create([
                                'shape_id' => $newShape->id,
                                'latitude' => $coord['lat'],
                                'longitude' => $coord['lng'],
                            ]);
                        }
                    }
                }
            }
        }
    
        // Handle the image uploads
        if ($property->save()) {
            $files = $request->multi_img;
    
            if (!empty($files)) {
                foreach ($files as $file) {
                    $imgName = date('YmdHi') . $file->getClientOriginalName();
                    $file->move('upload/property/multi_img/', $imgName);
    
                    $subimage = new MultiImages();
                    $subimage->propery_id = $property->id;
                                        $subimage->images = $imgName;
                    $subimage->save();
                }
            }
    
            // Redirect to a specific route or page after successful submission
            return redirect()->route('properties.page');
        }
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
        'land_situation' => 'string|nullable',
        'propery_cat' => 'string|nullable',
        'latitude' => 'string|nullable',
        'longitude' => 'string|nullable',
    ]);



    // Create a new Property instance and store in the database
    $property = new Property([
        'name' => $request->get('name'),
        'number' => $request->get('number'),
        'area' => $request->get('area'),
        'Location' => $request->get('location'),
        'property_type' => $request->get('property_type'),
        'status' => $request->get('status'),
        'description' => $request->get('description'),
        'price' => $request->get('price'),
        
        'mediator1' => $request->get('mediator1'),
        'land_situation' => $request->get('land_situation'),
        'phone1' => $request->get('phone1'),
        'mediator2' => $request->get('mediator2'),
        'phone2' => $request->get('phone2'),
        'owner' => $request->get('owner'),
        'owner_status' => $request->get('owner_status'),
        'ophone' => $request->get('ophone'),
        'notes' => $request->get('notes'),
        'propery_cat' => $request->get('propery_cat'),
        'latitude' => $request->get('latitude'),
        'longitude' => $request->get('longitude'),
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

    // Delete associated images
    $multiImages = MultiImages::where('propery_id', $property->id)->get();
    foreach ($multiImages as $multiImage) {
        $imagePath = public_path('upload/property/multi_img/' . $multiImage->images);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $multiImage->delete();
    }

    // Now delete the property
    $property->delete();

    return redirect()->route('properties.page');
}


    public function edit($id)
    {
        $property = Property::find($id);
        
        $multiImages = MultiImages::where('propery_id',$property->id)->get();

        return view('admin.property.edit', compact('property','multiImages'));
    }


    public function update(Request $request, Property $property)
{
    // Validate the form data
    $request->validate([
        'name' => 'string|nullable',
        'number' => 'string|nullable',
        'area' => 'string|nullable',
        'Location' => 'string|nullable',
        'land_situation' => 'string|nullable',

        'property_type' => 'string|nullable',
        'status' => 'string|nullable',
        'description' => 'string|nullable',
        'price' => 'numeric|nullable',
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


    // Update other property attributes
    $property->name = $request->get('name');
    $property->number = $request->get('number');
    $property->area = $request->get('area');
    $property->location = $request->get('location');
    $property->land_situation = $request->get('land_situation') ?? $property->land_situation ?? '';
    $property->property_type = $request->get('property_type') ?? $property->property_type ?? '';
    $property->status = $request->get('status') ?? 'Available';
    $property->description = $request->get('description');
    $property->price = $request->get('price');
    $property->mediator1 = $request->get('mediator1');
    $property->phone1 = $request->get('phone1');
    $property->mediator2 = $request->get('mediator2');
    $property->phone2 = $request->get('phone2');
    $property->owner = $request->get('owner');
    $property->owner_status = $request->get('owner_status') ?? 'مالك';
    $property->ophone = $request->get('ophone');
    $property->notes = $request->get('notes');
    $property->propery_cat = $request->get('propery_cat') ?? $property->propery_cat ?? '';

    // Update coordinates if provided
    if ($request->has('latitude') && $request->get('latitude')) {
        $property->latitude = $request->get('latitude');
    }
    if ($request->has('longitude') && $request->get('longitude')) {
        $property->longitude = $request->get('longitude');
    }

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

/**
 * Save map drawing
 */
public function saveDrawing(Request $request)
{
    // For now, just return success - you can create a MapDrawing model later
    return response()->json([
        'success' => true,
        'message' => 'تم حفظ الرسم بنجاح',
        'data' => [
            'name' => $request->name,
            'color' => $request->color,
            'notes' => $request->notes,
            'coordinates' => $request->coordinates,
            'type' => $request->type
        ]
    ]);
}

}
