<?php

namespace Parrot\Sms;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

interface SmsProvider
{
    public function sendMessage(Collection $data): Response;

    public function sendBulkMessage(Collection $data): Response;

    public function getBalance(): SmsBalance;

    public function getSender(): string;

    public function processWebhook(array $data): Collection;
}
