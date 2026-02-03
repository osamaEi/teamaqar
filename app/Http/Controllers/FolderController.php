<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Store a newly created folder
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:folders,name',
        ], [
            'name.required' => 'اسم المجلد مطلوب',
            'name.unique' => 'هذا الاسم موجود بالفعل',
            'name.max' => 'اسم المجلد طويل جداً',
        ]);

        Folder::create([
            'name' => $request->name,
        ]);

        return redirect()->route('files.index')->with('success', 'تم إنشاء المجلد بنجاح');
    }

    /**
     * Update the specified folder (rename)
     */
    public function update(Request $request, $id)
    {
        $folder = Folder::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:folders,name,' . $id,
        ], [
            'name.required' => 'اسم المجلد مطلوب',
            'name.unique' => 'هذا الاسم موجود بالفعل',
            'name.max' => 'اسم المجلد طويل جداً',
        ]);

        $folder->update([
            'name' => $request->name,
        ]);

        return redirect()->route('files.index')->with('success', 'تم تحديث المجلد بنجاح');
    }

    /**
     * Remove the specified folder
     */
    public function destroy($id)
    {
        $folder = Folder::findOrFail($id);

        // The boot method in Folder model will automatically move files to root
        $folder->delete();

        return redirect()->route('files.index')->with('success', 'تم حذف المجلد بنجاح');
    }
}
