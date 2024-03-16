<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestProperty extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $casts = [
        'contact_datetime' => 'datetime',
    ];


    public function event()
    {
        return $this->hasOne(Event::class);
    }
}
