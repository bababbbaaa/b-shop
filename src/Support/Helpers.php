<?php


use Domain\Cart\CartManager;
use Domain\Catalog\Filters\FilterManager;
use Domain\Catalog\Models\Category;
use Domain\Catalog\Sorters\Sorter;
use Domain\Favorite\FavoriteManager;
use Support\Flash\Flash;

if ( ! function_exists( '__money' ) ) {
    function __money( string $money, int $countDecimal = 2, string $symbol = '₽' ): string {
        return number_format( $money, $countDecimal, '.', ' ' ) . ' ' . $symbol;
    }
}

if ( ! function_exists( 'cart' ) ) {
    function cart(): CartManager {
        return app( CartManager::class );
    }
}
if ( ! function_exists( 'favorite' ) ) {
    function favorite(): FavoriteManager {
        return app( FavoriteManager::class );
    }
}

if ( ! function_exists( 'flash' ) ) {
    function flash(): Flash {
        return app( Flash::class );
    }
}

if ( ! function_exists( 'filters' ) ) {
    function filters() {
        return app( FilterManager::class )->items();
    }
}
if ( ! function_exists( 'sorter' ) ) {
    function sorter() {
        return app( Sorter::class );
    }
}

if ( ! function_exists( 'is_catalog_view' ) ) {
    function is_catalog_view( string $type, string $default = 'grid' ) {
        return session( 'view', $default ) === $type;
    }
}

if ( ! function_exists( 'filter_url' ) ) {
    function filter_url( ?Category $category, array $params = [] ): string {
        return route( 'catalog', [
            ...request()->only( [ 'filters', 'sort' ] ),
            ...$params,
            'category' => $category
        ] );
    }
}

if ( ! function_exists( '__cacheForget' ) ) {
    function __cacheForget( $key, $slug = null ): void {
        if ( ! is_null( $slug ) ) {
            cache()->forget( $key . '_' . $slug );
        }
        cache()->forget( $key . '.home' );
        cache()->forget( $key );
    }
}
