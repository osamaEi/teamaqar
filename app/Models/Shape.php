<?php

namespace App\Models;

use App\Models\Property;
use App\Models\Coordinate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shape extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'additional_data', 'property_id'];

    protected $casts = [
        'additional_data' => 'array',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function coordinates()
    {
        return $this->hasMany(Coordinate::class);
    }
}
