<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MultiImages extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
