<?php

namespace Domain\Auth\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Domain\Favorite\Models\Favorite;
use Domain\Order\Models\Order;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'github_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function social(): HasOne {
        return $this->hasOne( SocialAuth::class );
    }

    public function avatar(): Attribute {
        return Attribute::make(
            get: fn() => 'https://ui-avatars.com/api/?background=random&color=fff&name=' . $this->name
        );
    }

    public function orders() {
        return $this->hasMany( Order::class );
    }

    public function favorite(): HasOne {
        return $this->hasOne( Favorite::class );
    }

}
