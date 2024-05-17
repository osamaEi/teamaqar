<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Image;
use App\Models\File;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        $images = Image::all();
        $files = File::all();
        return view('admin.files.index', compact('videos', 'images', 'files'));
    }
    public function image()
    {
        $images = Image::all();
        return view('admin.files.images', compact('images'));
    }
    public function video()
    {
        $videos = Video::all();
        return view('admin.files.video', compact('videos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:20480', // Adjust maximum file size as needed
            'file' => 'nullable|max:20480', // Adjust maximum file size as needed
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/images', 'public');
            Image::create(['path' => $imagePath]);
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('uploads/videos', 'public');
            Video::create(['path' => $videoPath, 'mime_type' => $request->file('video')->getMimeType()]);
        }

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads/files', 'public');
            File::create(['path' => $filePath, 'name' => $request->file('file')->getClientOriginalName()]);
        }

        return redirect()->back()->with('success', 'Files uploaded successfully!');
    }
}

