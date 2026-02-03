<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // Security: Explicit fillable instead of guarded to prevent mass assignment vulnerabilities
    protected $fillable = ['path', 'name', 'size', 'folder_id', 'property_id', 'description'];

    /**
     * Get the folder that owns the file
     */
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    /**
     * Get the property that owns the file
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Scope to filter files by folder
     */
    public function scopeInFolder($query, $folderId)
    {
        if ($folderId === null || $folderId === 'root') {
            return $query->whereNull('folder_id');
        }
        return $query->where('folder_id', $folderId);
    }
}
