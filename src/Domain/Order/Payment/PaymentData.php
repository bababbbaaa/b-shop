<?php

namespace Domain\Order\Payment;

use Illuminate\Support\Collection;
use Support\ValueObjects\Price;

class PaymentData {
    public function __construct(
        public string $id,
        public string $email,
        public Price $amount,
        public string $description,
    ) {
    }
}
