<?php

namespace Domain\Order\States;

class PendingOrderState extends OrderState {

    protected array $allowedTransitions = [
        CancelledOrderState::class,
        PaidOrderState::class,
        SuccessOrderState::class
    ];

    public function canBeChanged(): bool {
        return true;
    }

    public function value(): string {
        return "pending";
    }

    public function humanValue(): string {
        return "В обработке";
    }
}
