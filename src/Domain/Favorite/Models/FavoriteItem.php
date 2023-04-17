<?php

namespace Domain\Favorite\Models;

use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteItem extends Model {
    use HasFactory;

    protected $fillable = [
        'favorite_id',
        'product_id',
    ];

    public function favorite(): BelongsTo {
        return $this->belongsTo( FavoriteItem::class );
    }

    public function product(): BelongsTo {
        return $this->belongsTo( Product::class );
    }
}
