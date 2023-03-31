<?php

namespace Domain\Order\States;

class SuccessOrderState extends OrderState {

    protected array $allowedTransitions = [

    ];

    public function canBeChanged(): bool {
        return false;
    }

    public function value(): string {
        return "success";
    }

    public function humanValue(): string {
        return "Завершен";
    }
}
