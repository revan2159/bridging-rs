<?php

namespace Satusehat\Bridging\Bridge;

use Satusehat\Bridging\Foundation\Http\OAuth2Client;
use Satusehat\Bridging\Foundation\Handler\CurlFactory;
use Satusehat\Bridging\Foundation\Http\ConfigSatusehat;



class BridgeSatusehat extends CurlFactory
{
    protected $auth;
    protected $access_token;
    protected $config;
    protected $endpointAuth = "/accesstoken?grant_type=client_credentials";
    public function __construct()
    {
        $this->config = new ConfigSatusehat;
        $this->auth = new OAuth2Client($this->config->setUrlAuth() . $this->endpointAuth, $this->config->setCredentials());
        $this->access_token = $this->auth->setToken();
    }

    public function getRequest($endpoint)
    {
        $result = $this->request($this->config->setUrlBase() . $endpoint, "GET", "",  $this->access_token);
        return $result;
    }

    public function postRequest($endpoint, $data)
    {
        $result = $this->request($this->config->setUrlBase() . $endpoint, "POST", $data,  $this->access_token);
        return $result;
    }

    public function puttRequest($endpoint, $data)
    {
        $result = $this->request($this->config->setUrlBase() . $endpoint, "PUT", $data,  $this->access_token);
        return $result;
    }
}
