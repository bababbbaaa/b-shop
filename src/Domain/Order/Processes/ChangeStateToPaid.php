<?php

namespace Domain\Order\Processes;

use Domain\Order\Models\Order;
use Domain\Order\States\PaidOrderState;

class ChangeStateToPaid {
    public function handle( Order $order, $next ) {
        $order->status->transitionTo( new PaidOrderState( $order ) );

        return $next( $order );
    }
}
