<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AccountRegistrar implements RouteRegistrar {
    public function map( Registrar $registrar ): void {
        Route::controller( AccountController::class )
             ->middleware( [ 'web', 'auth' ] )
             ->prefix( 'account' )
             ->group( function () {
                 Route::get( '/orders', 'orders' )
                      ->name( 'account.orders' );
                 Route::get( '/orders/{order}', 'order' )
                      ->name( 'account.order' );
                 Route::get( '/edit-profile', 'edit' )
                      ->name( 'account.edit' );

             } );
    }
}
