<?php

namespace Domain\Order\Payment;

use Closure;
use Domain\Order\Contracts\PaymentGatewayContract;
use Domain\Order\Exceptions\PaymentProcessException;
use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Models\Order;
use Domain\Order\Models\Payment;
use Domain\Order\Models\PaymentHistory;
use Domain\Order\States\PaidOrderState;
use Domain\Order\States\Payment\PaidPaymentState;
use Domain\Order\States\PendingOrderState;
use Domain\Order\Traits\PaymentEvents;

class PaymentSystem {
    use PaymentEvents;

    protected static $provider;

    /**
     * @throws PaymentProviderException
     */
    public static function provider( PaymentGatewayContract|Closure $providerOrClosure ): void {

        if ( is_callable( $providerOrClosure ) ) {
            $providerOrClosure = call_user_func( $providerOrClosure );
        }

        if ( ! $providerOrClosure instanceof PaymentGatewayContract ) {
            throw PaymentProviderException::providerRequired();
        }

        self::$provider = $providerOrClosure;
    }

    /**
     * @throws PaymentProviderException
     */
    public static function create( PaymentData $paymentData ): PaymentGatewayContract {

        if ( ! self::$provider instanceof PaymentGatewayContract ) {
            throw PaymentProviderException::providerRequired();
        }

        Payment::query()->create( [
            'payment_gateway' => get_class( self::$provider ),
            'payment_id'      => $paymentData->id,
        ] );

        if ( is_callable( self::$onCreating ) ) {
            call_user_func( self::$onCreating, $paymentData );
        }

        return self::$provider->data( $paymentData );
    }


    /**
     * @throws PaymentProviderException
     */
    public static function validate(): PaymentGatewayContract {

        if ( ! self::$provider instanceof PaymentGatewayContract ) {
            throw PaymentProviderException::providerRequired();
        }

        PaymentHistory::query()->create( [
            'method'          => request()->method(),
            'payment_gateway' => get_class( self::$provider ),
        ] );

        if ( self::$provider->validate() && self::$provider->paid() ) {
            try {

                $order = Order::query()->where( 'id', self::$provider->paymentId() )
                              ->firstOr( function () {
                                  throw PaymentProcessException::paymentNotFound();
                              } );

                if ( is_callable( self::$onSuccess ) ) {
                    call_user_func( self::$onSuccess, $order );
                }

            } catch ( PaymentProcessException $e ) {
                if ( is_callable( self::$onError ) ) {
                    call_user_func(
                        self::$onError,
                        self::$provider->errorMessage() ?? $e->getMessage()
                    );
                }
            }
        }

        return self::$provider;
    }

}
