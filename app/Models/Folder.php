<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get all files in this folder
     */
    public function files()
    {
        return $this->hasMany(File::class)->orderBy('created_at', 'desc');
    }

    /**
     * Boot method to handle folder deletion
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($folder) {
            // Move all files to root (folder_id = null) before deleting folder
            // This prevents accidental data loss
            $folder->files()->update(['folder_id' => null]);
        });
    }
}
