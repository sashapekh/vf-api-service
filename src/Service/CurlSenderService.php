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

    /**
     * CurlSenderService constructor.
     * @param string|null $uri
     * @param array|null $headers
     * @param array|null $jsonData
     */
    public function __construct(string $uri = null, array $headers = null, array $jsonData = null)
    {
        $this->mainDomain = config('vf-service-variables.mainDomain');
        $this->uri = $uri;
        $this->headers = $headers;
        $this->jsonData = $jsonData;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface|null
     */
    public function sendPostCurl(): ?\Psr\Http\Message\ResponseInterface
    {
        try {
            return (new GuzzleClient())->post(
                $this->mainDomain . $this->uri,
                [
                    'headers' => $this->headers,
                    'json' => $this->jsonData,
                    'http_errors'   => false,
                ]
            );
        } catch (GuzzleMainException $guzzleException) {
            return null;
        }
    }
}
