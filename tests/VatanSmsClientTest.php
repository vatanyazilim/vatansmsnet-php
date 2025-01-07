<?php

/**
 * VatanSMS PHP SDK
 * Developed by Timur (https://github.com/lyreq)
 * 
 * This SDK allows you to interact with the VatanSMS.Net API seamlessly.
 * For more details, visit https://vatansms.net
 * 
 * License: MIT
 */


use PHPUnit\Framework\TestCase;
use VatanSms\VatanSmsClient;
use VatanSms\Exceptions\VatanSmsException;

class VatanSmsClientTest extends TestCase
{
    private VatanSmsClient $client;

    protected function setUp(): void
    {
        $this->client = new VatanSmsClient('test_api_id', 'test_api_key', 'https://api.vatansms.net/api/v1');
    }

    public function testSendSms(): void
    {
        $phones = ['5xxxxxxxxx'];
        $message = 'Test mesajı';
        $sender = 'TEST';

        $this->expectException(VatanSmsException::class);
        $this->client->sendSms($phones, $message, $sender);
    }

    public function testSendNtoNSms(): void
    {
        $phones = [
            ['phone' => '5xxxxxxxxx', 'message' => 'Mesaj 1'],
            ['phone' => '5xxxxxxxxx', 'message' => 'Mesaj 2'],
        ];
        $sender = 'TEST';

        $this->expectException(VatanSmsException::class);
        $this->client->sendNtoNSms($phones, $sender);
    }

    public function testGetSenderNames(): void
    {
        $this->expectException(VatanSmsException::class);
        $this->client->getSenderNames();
    }

    public function testGetUserInformation(): void
    {
        $this->expectException(VatanSmsException::class);
        $this->client->getUserInformation();
    }

    public function testGetReportDetail(): void
    {
        $this->expectException(VatanSmsException::class);
        $this->client->getReportDetail(1);
    }

    public function testCancelFutureSms(): void
    {
        $this->expectException(VatanSmsException::class);
        $this->client->cancelFutureSms(123);
    }
}
