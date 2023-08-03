<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransportUsage extends Model
{
    use HasFactory;

    protected $table = 'transport_usages';
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'agree_id',
        'gas',
        'driver',
        'status',
        'is_agree',
        'is_complete',
        'booking_date',
        'need'
    ];

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'agreements', 'transport_usage_id', 'user_id')
        ->withPivot('id', 'is_agree')
        ->withTimestamps();
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo {
        return $this->belongsTo(Vehicle::class);
    }

    public function agree(): BelongsTo {
        return $this->belongsTo(User::class, 'agree_id', 'id');
    }

}
