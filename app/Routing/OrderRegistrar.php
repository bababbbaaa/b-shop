<?php

declare( strict_types=1 );

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class OrderRegistrar implements RouteRegistrar {
    public function map( Registrar $registrar ): void {
        Route::middleware( 'web' )->group( function () {
            Route::get( '/order', [ OrderController::class, 'index' ] )
                 ->name( 'order' );
            Route::post( '/order', [ OrderController::class, 'handle' ] )
                 ->name( 'order.handle' );
            Route::post( '/payment/success', [ PaymentController::class, 'success' ] )
                 ->name( 'payment.success' );
            Route::get( '/order/success', [ OrderController::class, 'success' ] )
                 ->name( 'order.success' );
        } );
    }
}
