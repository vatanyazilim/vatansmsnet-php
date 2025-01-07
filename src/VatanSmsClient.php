<?php

namespace VatanSms;

use VatanSms\Exceptions\VatanSmsException;

class VatanSmsClient
{
    private string $apiId;
    private string $apiKey;
    private string $baseUrl;

    public function __construct(string $apiId, string $apiKey, string $baseUrl = 'https://api.toplusmspaketleri.com/api/v1')
    {
        $this->apiId = $apiId;
        $this->apiKey = $apiKey;
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * 1-to-N SMS Gönderimi
     */
    public function sendSms(array $phones, string $message, string $sender, string $messageType = 'normal', string $messageContentType = 'bilgi', ?string $sendTime = null): array
    {
        $payload = [
            'api_id' => $this->apiId,
            'api_key' => $this->apiKey,
            'sender' => $sender,
            'message_type' => $messageType,
            'message' => $message,
            'message_content_type' => $messageContentType,
            'phones' => $phones,
        ];

        if ($sendTime) {
            $payload['send_time'] = $sendTime;
        }

        return $this->sendRequest('/1toN', $payload);
    }

    /**
     * N-to-N SMS Gönderimi
     */
    public function sendNtoNSms(array $phones, string $sender, string $messageType = 'turkce', string $messageContentType = 'bilgi', ?string $sendTime = null): array
    {
        $payload = [
            'api_id' => $this->apiId,
            'api_key' => $this->apiKey,
            'sender' => $sender,
            'message_type' => $messageType,
            'message_content_type' => $messageContentType,
            'phones' => $phones,
        ];

        if ($sendTime) {
            $payload['send_time'] = $sendTime;
        }

        return $this->sendRequest('/NtoN', $payload);
    }

    /**
     * Gönderici Adlarını Sorgulama
     */
    public function getSenderNames(): array
    {
        $payload = [
            'api_id' => $this->apiId,
            'api_key' => $this->apiKey,
        ];

        return $this->sendRequest('/senders', $payload);
    }

    /**
     * Kullanıcı Bilgilerini Sorgulama
     */
    public function getUserInformation(): array
    {
        $payload = [
            'api_id' => $this->apiId,
            'api_key' => $this->apiKey,
        ];

        return $this->sendRequest('/user/information', $payload);
    }

    /**
     * Rapor Sorgulama - Rapor Detayı
     */
    public function getReportDetail(int $reportId, int $page = 1, int $pageSize = 20): array
    {
        $payload = [
            'api_id' => $this->apiId,
            'api_key' => $this->apiKey,
            'report_id' => $reportId,
        ];

        $endpoint = "/report/detail?page={$page}&pageSize={$pageSize}";
        return $this->sendRequest($endpoint, $payload);
    }

    /**
     * Rapor Sorgulama - Tarih Bazlı
     */
    public function getReportsByDate(string $startDate, string $endDate): array
    {
        $payload = [
            'api_id' => $this->apiId,
            'api_key' => $this->apiKey,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        return $this->sendRequest('/report/between', $payload);
    }

    /**
     * Rapor Sorgulama - Sonuç Sorgusu
     */
    public function getReportStatus(int $reportId): array
    {
        $payload = [
            'api_id' => $this->apiId,
            'api_key' => $this->apiKey,
            'report_id' => $reportId,
        ];

        return $this->sendRequest('/report/single', $payload);
    }

    /**
     * İleri Tarihli SMS İptali
     */
    public function cancelFutureSms(int $id): array
    {
        $payload = [
            'api_id' => $this->apiId,
            'api_key' => $this->apiKey,
            'id' => $id,
        ];

        return $this->sendRequest('/cancel/future-sms', $payload);
    }

    /**
     * HTTP POST İsteği
     */
    private function sendRequest(string $endpoint, array $payload): array
    {
        $ch = curl_init();

        $options = [
            CURLOPT_URL => $this->baseUrl . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ];

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new VatanSmsException("Curl hatası: " . $error);
        }

        $responseDecoded = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new VatanSmsException("Geçersiz JSON yanıtı: " . $response);
        }

        return $responseDecoded;
    }
}
