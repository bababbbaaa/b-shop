<?php

namespace Domain\Order\Enums;

use Domain\Order\Models\Order;
use Domain\Order\States\CancelledOrderState;
use Domain\Order\States\NewOrderState;
use Domain\Order\States\OrderState;
use Domain\Order\States\PaidOrderState;
use Domain\Order\States\PendingOrderState;
use Domain\Order\States\SuccessOrderState;

enum OrderStatuses: string {
    case New = 'new';
    case Pending = 'pending';
    case Paid = 'paid';
    case Canceled = 'cancelled';
    case Success = 'success';

    public function createState( Order $order ): OrderState {
        return match ( $this ) {
            OrderStatuses::New => new NewOrderState( $order ),
            OrderStatuses::Pending => new PendingOrderState( $order ),
            OrderStatuses::Paid => new PaidOrderState( $order ),
            OrderStatuses::Canceled => new CancelledOrderState( $order ),
            OrderStatuses::Success => new SuccessOrderState( $order ),
        };
    }

    public function showState(): OrderState {
        dd( $this );
    }
}
