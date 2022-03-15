<?php

namespace Parrot\Sms;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

class Termii extends AbstractSmsProvider
{
    private PendingRequest $client;

    public function __construct()
    {
        $key = config("services.termii.api-key");
        $this->client = $this->client()->asJson()->beforeSending(fn(Request $request) => $request->withData([
            ...$request->data(), 'api-key' => $key
        ]));
    }

    public function sendMessage(Collection $data): Response
    {
        return $this->client->post('sms/send', $data->toArray());
    }

    public function sendBulkMessage(Collection $data): Response
    {
        return $this->client->post('sms/send/bulk', $data->toArray());
    }

    /**
     * @throws RequestException
     */
    public function getBalance(): SmsBalance
    {
        $data = $this->client->get('get-balance')->throw()->object();
        return new SmsBalance($data->balance, $data->currency);
    }

    /**
     * @throws RequestException
     */
    public function getSender(): string
    {
        $data = $this->client->get('get-balance')->throw()->collect('data');
        return $data->first()['sender_id'];
    }

    public function processWebhook(array $data): Collection
    {
        // TODO: Implement processWebhook() method.
    }

    protected function getBaseURL(): string
    {
        return config('services.termii.base-url');
    }
}
