<?php

namespace Sashapekh\VfApi\Service;

class SendSmsService
{
    public static function sendOneSms(string $phone, string $message): string
    {
        return "phone = $phone, message = $message";
    }
}
