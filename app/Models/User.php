<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    function agreements() : HasMany {
        return $this->hasMany(TransportUsage::class, 'agree_id', 'id');
    }

    public function vehicles(): BelongsToMany  {
        return $this->belongsToMany(Vehicle::class, 'transport_usages', 'user_id', 'vehicle_id')
        ->withPivot('id', 'gas', 'status', 'booking_date', 'need')
        ->withTimestamps();;
    }

    public function transport_usages(): BelongsToMany {
        return $this->belongsToMany(TransportUsage::class, 'agreements', 'user_id', 'transport_usage_id')
        ->withPivot('id', 'is_agree')
        ->withTimestamps();
    }
}
