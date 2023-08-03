<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vehicle extends Model
{
    use HasFactory;

    protected function users()  {
        return $this->belongsToMany(User::class, 'transport_usages', 'vehicle_id', 'user_id')
        ->withPivot('id', 'gas', 'status', 'booking_date', 'need')
        ->withTimestamps();
    }
}
