<?php

namespace App\Models;

use App\Models\Shape;
use App\Models\MultiImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $guarded =[];


    public function multiImages()
    {
        return $this->hasMany(MultiImages::class, 'propery_id');
    }
    
    public function shapes()
    {
        return $this->hasMany(Shape::class);
    }
    
}
