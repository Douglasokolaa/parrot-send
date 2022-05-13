<?php

namespace Parrot\Sms;

class SmsBalance
{
    public function __construct(
        private readonly float $balance,
        private float $currency
    ) {}

    public function getCurrency(): float
    {
        return $this->currency;
    }

    public function setCurrency(float $currency): void
    {
        $this->currency = $currency;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}
