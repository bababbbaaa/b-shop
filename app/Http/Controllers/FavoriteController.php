<?php

namespace App\Http\Controllers;

use Domain\Favorite\Models\FavoriteItem;
use Domain\Product\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller {
    public function add( Product $product ): RedirectResponse {
        favorite()->add( $product );
        flash()->info( 'Товар добавлен в избранное' );

        return redirect()->back();
    }

    public function delete( $id ): RedirectResponse {
        favorite()->delete( $id );
        flash()->info( 'Товар удален из избранного' );

        return redirect()->back();
    }

    public function index() {
        $favoriteItems = favorite()->favoriteItems();

        return view( 'account.favorites', compact( 'favoriteItems' ) );
    }
}
