<?php

declare( strict_types=1 );

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\FavoriteController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class FavoriteRegistrar implements RouteRegistrar {
    public function map( Registrar $registrar ): void {
        Route::middleware( [ 'web', 'auth' ] )->group( function () {

        } );
        Route::controller( FavoriteController::class )
             ->middleware( [ 'web', 'auth' ] )
             ->prefix( 'favorite' )
             ->group( function () {
                 Route::get( '/', 'index' )->name( 'favorite.index' );
                 Route::post( '/{product}/add', 'add' )->name( 'favorite.add' );
                 Route::delete( '/{product}/delete', 'delete' )->name( 'favorite.delete' );
             } );
    }
}
