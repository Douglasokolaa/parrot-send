<?php

namespace Parrot\Sms;

class SmsBalance
{
    public function __construct(private float $balance, private float $currency)
    {
    }

    /**
     * @return float
     */
    public function getCurrency(): float
    {
        return $this->currency;
    }

    /**
     * @param  float  $currency
     */
    public function setCurrency(float $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }
}
