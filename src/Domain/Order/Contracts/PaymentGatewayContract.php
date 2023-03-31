<?php

namespace Domain\Order\Contracts;

use Domain\Order\Payment\PaymentData;
use Illuminate\Http\JsonResponse;

interface PaymentGatewayContract {
    public function paymentId(): string;

    public function configure( array $config ): mixed;

    public function data( PaymentData $data ): self;

    public function request(): mixed;

    public function url(): string;

    public function validate(): mixed;


    public function paid(): bool;

    // public function errorMessage(): string;
}
