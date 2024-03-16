<?php

namespace App\Models;

use App\Models\RequestProperty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $guarded=[];



    public function request()
    {
        return $this->belongsTo(RequestProperty::class, 'request_id');
    
    }



}
