<?php

namespace App\Http\Controllers;

use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Models\Order;
use Domain\Order\Payment\PaymentSystem;
use Domain\Order\States\PaidOrderState;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PaymentController extends Controller {

    /**
     * @throws PaymentProviderException
     */
    public function success(): Factory|View|Application {

        $order = Order::query()
                      ->where( 'id', PaymentSystem::validate()->paymentId() )
                      ->firstOrFail();

        $order->status->transitionTo( new PaidOrderState( $order ) );

        return view( 'order.success', compact( 'order' ) );
    }

}
