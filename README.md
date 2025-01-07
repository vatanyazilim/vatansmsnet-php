
# VatanSMS PHP SDK

VatanSMS.NET API'sini PHP projelerinizde kolayca kullanmak için geliştirilmiş bir SDK.

## Kurulum

Composer ile kütüphaneyi yükleyin:

    composer require vatanyazilim/vatansmsnet-php
## Kullanım

    require 'vendor/autoload.php';
    
    use VatanSms\VatanSmsClient;
    
    $client = new VatanSmsClient('API_ID', 'API_KEY');
    
    // 1-to-N SMS Gönderimi
    $response = $client->sendSms(
        ['5xxxxxxxxx', '5xxxxxxxxx'],
        'Bu bir test mesajıdır.',
        'SMSBASLIGINIZ'
    );
    print_r($response);
    
    // N-to-N SMS Gönderimi
    $response = $client->sendNtoNSms(
        [
            ['phone' => '5xxxxxxxxx', 'message' => 'Mesaj 1'],
            ['phone' => '5xxxxxxxxx', 'message' => 'Mesaj 2'],
        ],
        'SMSBASLIGINIZ'
    );
    print_r($response);
## Yöntemler
### 1. `sendSms`

1-to-N SMS gönderimi.

    $client->sendSms(array $phones, string $message, string $sender, string $messageType = 'normal', string $messageContentType = 'bilgi', ?string $sendTime = null);
### 2. `sendNtoNSms`

N-to-N SMS gönderimi.

    $client->sendNtoNSms(array $phones, string $sender, string $messageType = 'turkce', string $messageContentType = 'bilgi', ?string $sendTime = null);
    
  ### 3. `getSenderNames`

Gönderici adlarını sorgulama.

    $client->getSenderNames();

### 4. `getUserInformation`

Kullanıcı bilgilerini sorgulama.


    $client->getUserInformation();` 

### 5. `getReportDetail`

Rapor detayı sorgulama.

    $client->getReportDetail(int $reportId, int $page = 1, int $pageSize = 20);` 

### 6. `getReportsByDate`

Tarih bazlı rapor sorgulama.

    $client->getReportsByDate(string $startDate, string $endDate);` 

### 7. `getReportStatus`

Sonuç sorgusu.

    $client->getReportStatus(int $reportId);` 

### 8. `cancelFutureSms`

İleri tarihli SMS iptali.

    $client->cancelFutureSms(int $id);` 

----------

## Testler

Testleri çalıştırmak için şu komutu kullanabilirsiniz:

    vendor/bin/phpunit`





