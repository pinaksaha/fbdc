<?php

namespace App\Gateway;

use GuzzleHttp\Client;

class RandomUserGateway
{
    /**
     * @var string
     */
    private $endpoint = "https://randomuser.me/api/";

    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $number
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRandomUser($number = 1)
    {
        return $this->client->get($this->endpoint,[
            'query' => [
                'results' => $number
            ]
        ])->getBody()->getContents();
    }
}
