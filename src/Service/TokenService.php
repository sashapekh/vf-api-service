<?php


namespace Sashapekh\VfApi;


class TokenService
{
    public function getToken(): ?string
    {
        $token = VfApiToken::first();
        if ($token) {
            if (!$token->isExpireToken()) {
                return $token->token;
            } else {
                $this->refreshToken();
            }
        }

        return $this->createNewToken();
    }

    public function createNewToken(): ?string
    {
        $tokenResponse = $this->getResponseToken();
        $newToken = new VfApiToken();
        $newToken->token = $tokenResponse;
        $newToken->save();
        return $newToken->token;
    }

    public function refreshToken()
    {

    }

    public function getResponseToken(): ?string
    {
        $configVars = config('vf-service-variables');

        $headers = [
            'Accept' => 'application/json',
        ];
        $data = [
            'user' => $configVars['user'],
            'password' => $configVars['password']
        ];
        $curlResponse = (new CurlSenderService(
            $configVars['tokenUri'],
            $headers,
            $data
        ))->sendPostCurl();

        return json_decode($curlResponse->getBody()->getContents())->token;
    }
}
