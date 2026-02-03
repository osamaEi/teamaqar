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
        $files = File::all();
        return view('admin.files.index', compact('files'));
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
            $file = $request->file('file');
            $filePath = $file->store('uploads/files', 'public');
            $fileSize = round($file->getSize() / 1024 / 1024, 2); // Convert to MB

            File::create([
                'path' => $filePath,
                'name' => $file->getClientOriginalName(),
                'size' => $fileSize . ' MB'
            ]);
        }

        return redirect()->back()->with('success', 'تم رفع الملف بنجاح!');
    }

    public function destroy($id)
    {
        $file = File::findOrFail($id);

        // Delete from storage if needed
        if (file_exists(storage_path('app/public/' . $file->path))) {
            unlink(storage_path('app/public/' . $file->path));
        }

        $file->delete();
        return redirect()->back()->with('success', 'تم حذف الملف بنجاح!');
    }
}

