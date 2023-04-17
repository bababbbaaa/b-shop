<?php

namespace Domain\Favorite;

use Domain\Favorite\Models\Favorite;
use Domain\Favorite\Models\FavoriteItem;
use Domain\Product\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FavoriteManager {
    public function add( Product $product ): void {
        $favorite = Favorite::query()->updateOrCreate( [
            'user_id' => auth()->id(),
        ] );
        $favorite->favoriteItems()->updateOrCreate( [
            'product_id' => $product->id,
        ] );

        cache()->forget( $this->cacheKey() );
    }

    public function check( $product_id ): bool {
        $favoriteItems = $this->items()->where( 'product_id', $product_id );

        return ! ! count( $favoriteItems );
    }

    public function count() {
        return $this->items()->count();
    }

    public function cacheKey(): string {
        return 'cart_' . auth()->id();
    }

    public function items() {
        $favoriteItems = cache()->rememberForever( $this->cacheKey(), function () {
            return auth()->user()->favorite->favoriteItems;
        } );

        return $favoriteItems;
    }

    public function favoriteItems() {
        $favoriteItems = auth()->user()->favorite->favoriteItems()->with( 'product' )->get();

        return $favoriteItems;
    }

    public function delete( $productId ): void {
        auth()->user()->favorite->favoriteItems()->where( 'product_id', $productId )->delete();
        cache()->forget( $this->cacheKey() );
    }
}
