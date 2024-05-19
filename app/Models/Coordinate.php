<?php

namespace App\Models;

use App\Models\Shape;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coordinate extends Model
{
    use HasFactory;
    protected $fillable = ['shape_id', 'latitude', 'longitude'];

    public function shape()
    {
        return $this->belongsTo(Shape::class);
    }
}
