<?php


namespace Sashapekh\VfApi;


use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException as GuzzleMainException;

class CurlSenderService
{
    private $mainDomain;
    private $uri;
    private $headers;
    private $jsonData;

    public function __construct(string $uri = null, array $headers = null, array $jsonData = null)
    {
        $this->mainDomain = config('vf-service-variables.mainDomain');
        $this->uri = $uri;
        $this->headers = $headers;
        $this->jsonData = $jsonData;
    }

    public function sendPostCurl()
    {
        try {
            return (new GuzzleClient())->post(
                $this->mainDomain . $this->uri,
                [
                    'headers' => $this->headers,
                    'json' => $this->jsonData
                ]
            );
        } catch (GuzzleMainException $guzzleException) {
            return null;
        }
    }
}
