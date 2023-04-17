<?php

namespace Domain\Favorite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Favorite extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function favoriteItems(): HasMany {
        return $this->hasMany( FavoriteItem::class );
    }
}
