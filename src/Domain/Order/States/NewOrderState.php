<?php

namespace Domain\Order\States;

class NewOrderState extends OrderState {

    protected array $allowedTransitions = [
        PendingOrderState::class,
        CancelledOrderState::class,
        PaidOrderState::class,
        SuccessOrderState::class
    ];

    public function canBeChanged(): bool {
        return true;
    }

    public function value(): string {
        return "new";
    }

    public function humanValue(): string {
        return "Новый заказ";
    }
}
