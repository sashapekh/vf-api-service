<?php

namespace Sashapekh\VfApi;

use Psr\Http\Message\ResponseInterface;

class SendSmsService
{
    private $tokenService;
    private $sendSmsUri;
    private $mainDomain;
    private $sendMultipleSmsUri;

    public function __construct()
    {
        $this->mainDomain = config('vf-service-variables.mainDomain');
        $this->tokenService = new TokenService();
        $this->sendSmsUri = config('vf-service-variables.SendSmsUri');
        $this->sendMultipleSmsUri = config('vf-service-variables.SendMultipleUri');
    }

    public function sendOneSms(string $phone, string $message)
    {
        $jsonData = [
            'phone' => $phone,
            'message' => $message
        ];

        $response = (new CurlSenderService(
            $this->sendSmsUri,
            $this->setHeaders(),
            $jsonData
        ))->sendPostCurl();

        return $this->getProcessedResponse($response);

    }

    public function sendMultipleSms(array $phones = [], string $message = '')
    {
        if (empty($phones) && empty($message)) {
            return null;
        }

        $jsonData = [
            'phone' => $phones,
            'message' => $message
        ];

        $response = (new CurlSenderService(
            $this->sendMultipleSmsUri,
            $this->setHeaders(),
            $jsonData
        ))->sendPostCurl();

        return $this->getProcessedResponse($response);
    }

    private function setHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->tokenService->getToken()

        ];
    }

    private function getProcessedResponse($response)
    {
        return isset($response)
            ? json_decode($response->getBody()->getContents(), true)
            : null;
    }
}
