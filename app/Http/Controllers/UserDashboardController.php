<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\MultiImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserDashboardController extends Controller
{
    /**
     * Display user dashboard
     */
    public function index()
    {
        $user = Auth::user();
        $properties = Property::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => Property::where('user_id', $user->id)->count(),
            'available' => Property::where('user_id', $user->id)->where('status', 'Available')->count(),
            'sold' => Property::where('user_id', $user->id)->where('status', 'Sold')->count(),
            'reserved' => Property::where('user_id', $user->id)->where('status', 'Reserved')->count(),
        ];

        return view('user.dashboard.index', compact('properties', 'stats', 'user'));
    }

    /**
     * Show the form for creating a new property
     */
    public function create()
    {
        return view('user.properties.create');
    }

    /**
     * Store a newly created property
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'property_type' => 'nullable|string',
            'location' => 'nullable|string',
            'area' => 'nullable|string',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Available,Sold,Reserved',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $validated['user_id'] = Auth::id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('upload/properties'), $imageName');
            $validated['image'] = 'upload/properties/' . $imageName;
        }

        $property = Property::create($validated);

        // Handle multiple images if provided
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('upload/multi_images'), $imageName);

                MultiImages::create([
                    'propery_id' => $property->id,
                    'image' => 'upload/multi_images/' . $imageName,
                ]);
            }
        }

        return redirect()->route('user.dashboard')
            ->with('success', 'تم إضافة العقار بنجاح');
    }

    /**
     * Show the form for editing the specified property
     */
    public function edit($id)
    {
        $property = Property::where('user_id', Auth::id())->findOrFail($id);
        return view('user.properties.edit', compact('property'));
    }

    /**
     * Update the specified property
     */
    public function update(Request $request, $id)
    {
        $property = Property::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'property_type' => 'nullable|string',
            'location' => 'nullable|string',
            'area' => 'nullable|string',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Available,Sold,Reserved',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($property->image && file_exists(public_path($property->image))) {
                unlink(public_path($property->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('upload/properties'), $imageName);
            $validated['image'] = 'upload/properties/' . $imageName;
        }

        $property->update($validated);

        return redirect()->route('user.dashboard')
            ->with('success', 'تم تحديث العقار بنجاح');
    }

    /**
     * Remove the specified property
     */
    public function destroy($id)
    {
        $property = Property::where('user_id', Auth::id())->findOrFail($id);

        // Delete main image
        if ($property->image && file_exists(public_path($property->image))) {
            unlink(public_path($property->image));
        }

        // Delete multi images
        foreach ($property->multiImages as $multiImage) {
            if ($multiImage->image && file_exists(public_path($multiImage->image))) {
                unlink(public_path($multiImage->image));
            }
            $multiImage->delete();
        }

        $property->delete();

        return redirect()->route('user.dashboard')
            ->with('success', 'تم حذف العقار بنجاح');
    }

    /**
     * Display the specified property
     */
    public function show($id)
    {
        $property = Property::where('user_id', Auth::id())->findOrFail($id);
        $multiImages = MultiImages::where('propery_id', $id)->get();

        return view('user.properties.show', compact('property', 'multiImages'));
    }
}
