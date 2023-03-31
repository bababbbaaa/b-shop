<?php

namespace Domain\Order\Exceptions;

use Exception;

class PaymentProviderException extends Exception {
    public static function providerRequired(): self {
        return new self( 'Provider is required' );
    }

    public static function validateFails(): self {
        return new self( 'Что то пошло не так' );
    }

    public static function serviceFails(): self {
        return new self( 'Проблемы у сервиса оплаты' );
    }
}
