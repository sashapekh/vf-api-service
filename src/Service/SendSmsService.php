<?php

namespace Sashapekh\VfApi;

class SendSmsService
{
    private $tokenService;
    private $sendSmsUri;
    private $mainDomain;

    public function __construct()
    {
        $this->mainDomain = config('vf-service-variables.mainDomain');
        $this->tokenService = new TokenService();
        $this->sendSmsUri = config('vf-service-variables.SendSmsUri');
    }

    public function sendOneSms(string $phone, string $message)
    {
        $header = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->tokenService->getToken()

        ];

        $jsonData = [
            'phone' => $phone,
            'message' => $message
        ];

        $response = (new CurlSenderService(
            $this->sendSmsUri,
            $header,
            $jsonData
        ))->sendPostCurl();

        return json_decode($response->getBody()->getContents(), true);
    }
}
