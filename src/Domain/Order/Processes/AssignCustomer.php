<?php

namespace Domain\Order\Processes;

use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;

class AssignCustomer implements OrderProcessContract {

    // TODO DTO Customer
    public function __construct( protected array $customer ) {
    }


    public function handle( Order $order, $next ) {
        try {
            $order->orderCustomer()->create( $this->customer );

            return $next( $order );
        } catch ( \Throwable $e ) {
            throw new \DomainException( $e->getMessage() );
        }


    }
}
