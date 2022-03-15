<?php

namespace Parrot\Sms;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

abstract class AbstractSmsProvider implements SmsProvider
{
    protected function client(): PendingRequest
    {
        return Http::baseUrl($this->getBaseURL());
    }

    abstract protected function getBaseURL();

}
