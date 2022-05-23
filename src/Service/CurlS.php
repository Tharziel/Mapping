<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurlS
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function curl($city, $postal)
    {
        $response = $this->client->request(
            'GET',
            "https://nominatim.openstreetmap.org/search?city=$city&postalcode=$postal&format=json"
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }
}