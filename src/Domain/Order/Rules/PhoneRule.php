<?php

namespace Domain\Order\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule {

    public function passes( $attribute, $value ) {

        // TODO Phone Mask Front
        // preg_match_all( "#^\+\d\(\d{3}\)\d{3}-\d{2}-\d{2}$#", $value )

        return true;
    }

    public function message(): string {
        return 'Введите правильный телефон.';
    }
}
