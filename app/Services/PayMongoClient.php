<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class PayMongoClient
{
    private const BASE_URL = 'https://api.paymongo.com';

    public function __construct(private readonly ?string $secretKey)
    {
    }

    /**
     * Create a Checkout Session and return its decoded `data` object.
     *
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
    public function createCheckoutSession(array $attributes): array
    {
        $response = $this->client()->post('/v2/checkout_sessions', [
            'data' => ['attributes' => $attributes],
        ]);

        if ($response->failed()) {
            throw new RuntimeException('PayMongo checkout session creation failed: '.$response->body());
        }

        return $response->json('data');
    }

    /**
     * Retrieve a Checkout Session by id and return its decoded `data` object.
     *
     * @return array<string, mixed>
     */
    public function getCheckoutSession(string $id): array
    {
        $response = $this->client()->get("/v1/checkout_sessions/{$id}");

        if ($response->failed()) {
            throw new RuntimeException('PayMongo checkout session lookup failed: '.$response->body());
        }

        return $response->json('data');
    }

    private function client()
    {
        if (! $this->secretKey) {
            throw new RuntimeException('PayMongo secret key is not configured (PAYMONGO_SECRET_KEY).');
        }

        return Http::baseUrl(self::BASE_URL)
            ->withBasicAuth($this->secretKey, '')
            ->acceptJson()
            ->asJson();
    }
}
