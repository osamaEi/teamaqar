<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'type',
        'notes',
        'company',
        'address',
    ];

    // Type labels in Arabic
    public static function getTypeLabels()
    {
        return [
            'client' => 'عميل',
            'owner' => 'مالك',
            'broker' => 'وسيط',
            'investor' => 'مستثمر',
        ];
    }

    public function getTypeLabelAttribute()
    {
        return self::getTypeLabels()[$this->type] ?? $this->type;
    }
}
