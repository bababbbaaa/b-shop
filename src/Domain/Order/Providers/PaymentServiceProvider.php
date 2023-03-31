<?php

namespace Domain\Order\Providers;

use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Models\Order;
use Domain\Order\Models\Payment;
use Domain\Order\Payment\Gateways\RoboKassa;
use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider {
    public function register(): void {

    }

    /**
     * @throws PaymentProviderException
     */
    public function boot(): void {

        PaymentSystem::provider( new RoboKassa() );
        PaymentSystem::onCreating( function ( PaymentData $paymentData ) {
            return $paymentData;
        } );
        PaymentSystem::onSuccess( function ( Order $order ) {
            return $order;
        } );
        PaymentSystem::onError( function ( string $message, Payment $payment ) {
            return $message;
        } );
    }
}
