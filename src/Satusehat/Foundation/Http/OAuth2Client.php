<?php

namespace Satusehat\Bridging\Foundation\Http;

use Satusehat\Bridging\Foundation\Handler\CurlFactory;

class OAuth2Client
{
    protected $bridge;
    protected $accessToken;

    public function __construct($endpoint, $dataClient)
    {
        $this->bridge = new CurlFactory();
        $response = $this->bridge->request($endpoint, "POST", $dataClient);
        $result = json_decode($response, true);
        $this->accessToken = $result['access_token'];
    }

    public function setToken()
    {
        return $this->accessToken;
    }
}
