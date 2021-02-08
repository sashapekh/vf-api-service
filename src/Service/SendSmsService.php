<?php

namespace Sashapekh\VfApi;

class SendSmsService
{
    private $tokenService;
    private $sendSmsUri;
    private $mainDomain;
    private $sendMultipleSmsUri;

    /**
     * SendSmsService constructor.
     */
    public function __construct()
    {
        $this->mainDomain = config('vf-service-variables.mainDomain');
        $this->tokenService = new TokenService();
        $this->sendSmsUri = config('vf-service-variables.SendSmsUri');
        $this->sendMultipleSmsUri = config('vf-service-variables.SendMultipleUri');
    }

    /**
     * @param string $phone
     * @param string $message
     * @return mixed|null
     */
    public function sendOneSms(string $phone, string $message)
    {
        $jsonData = [
            'phone' => $phone,
            'message' => $message,
            'domain_url' => config('vf-service-variables.domain_url')
        ];

        $response = (new CurlSenderService(
            $this->sendSmsUri,
            $this->setHeaders(),
            $jsonData
        ))->sendPostCurl();

        return $this->getProcessedResponse($response);

    }

    /**
     * @param array $phones
     * @param string $message
     * @return mixed|null
     */
    public function sendMultipleSms(array $phones = [], string $message = '')
    {
        if (empty($phones) && empty($message)) {
            return null;
        }

        $jsonData = [
            'phone' => $phones,
            'message' => $message,
            'domain_url' => config('vf-service-variables.domain_url')
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

    /**
     * @param $response
     * @return mixed|null
     */
    private function getProcessedResponse($response)
    {
        return isset($response)
            ? json_decode($response->getBody()->getContents(), true)
            : null;
    }
}
