
 
# VatanSMS.Net PHP SDK
VatanSMS.Net API'sini PHP projelerinizde kolayca kullanmak için geliştirilmiş bir SDK.  
  
## Kurulum

Composer ile kütüphaneyi yükleyin:

  

```bash
composer  require  vatanyazilim/vatansmsnet-php
```

  

---

  

## Kullanım

  

Aşağıda, PHP ile **VatanSMS PHP SDK** kullanılarak API isteklerinin nasıl yapıldığını gösteren örnekler yer almaktadır:

  

---

  

### 1. 1-to-N SMS Gönderimi

**Açıklama:**

Birden fazla numaraya aynı mesajı göndermek için kullanılır.

  

**Parametreler:**

-  `array $phones`: Mesaj gönderilecek telefon numaralarının listesi.

-  `string $message`: Gönderilecek mesaj içeriği.

-  `string $sender`: Gönderici adı (örneğin, "FIRMA").

-  `string $messageType`: Mesaj türü, varsayılan olarak "normal".

-  `string $messageContentType`: Mesaj içerik türü, örneğin "bilgi" veya "ticari".

-  `?string $sendTime`: Mesajın gönderileceği tarih ve saat. Varsayılan olarak hemen gönderilir.

  

**Örnek Kullanım:**

```php
require 'vendor/autoload.php';

use VatanSms\VatanSmsClient;

$client = new VatanSmsClient('API_ID', 'API_KEY');
$response = $client->sendSms(
    ['5xxxxxxxxx', '5xxxxxxxxx'],
    'Bu bir test mesajıdır.',
    'SMSBASLIGINIZ'
);
print_r($response);
```

  

---

  

### 2. N-to-N SMS Gönderimi

**Açıklama:**

Her telefon numarasına farklı mesajlar göndermek için kullanılır.

  

**Parametreler:**

-  `array $phones`: Telefon numaralarını ve mesajlarını içeren bir dizi. Her eleman `['phone' => '...', 'message' => '...']` şeklinde olmalıdır.

-  `string $sender`: Gönderici adı.

-  `string $messageType`: Mesaj türü, varsayılan olarak "turkce".

-  `string $messageContentType`: Mesaj içerik türü, örneğin "bilgi" veya "ticari".

-  `?string $sendTime`: Mesajın gönderileceği tarih ve saat. Varsayılan olarak hemen gönderilir.

  

**Örnek Kullanım:**

```php
$response = $client->sendNtoNSms(
    [
        ['phone' => '5xxxxxxxxx', 'message' => 'Mesaj 1'],
        ['phone' => '5xxxxxxxxx', 'message' => 'Mesaj 2']
    ],
    'SMSBASLIGINIZ'
);
print_r($response);
```

  

---

  

### 3. Gönderici Adlarını Sorgulama

**Açıklama:**

Hesabınıza tanımlı gönderici adlarını sorgulamak için kullanılır.

  

**Parametreler:**

Hiçbir parametre almaz.

  

**Örnek Kullanım:**

```php
$response =  $client->getSenderNames();
print_r($response);
```

  

---

  

### 4. Kullanıcı Bilgilerini Sorgulama

**Açıklama:**

Hesap bilgilerinizi sorgulamak için kullanılır.

  

**Parametreler:**

Hiçbir parametre almaz.

  

**Örnek Kullanım:**

```php
$response =  $client->getUserInformation();
print_r($response);
```

  

---

  

### 5. Rapor Detayı Sorgulama

**Açıklama:**

Belirli bir raporun detaylarını sorgulamak için kullanılır.

  

**Parametreler:**

-  `int $reportId`: Sorgulanacak raporun ID'si.

-  `int $page`: Sayfa numarası, varsayılan olarak 1.

-  `int $pageSize`: Bir sayfada gösterilecek rapor sayısı, varsayılan olarak 20.

  

**Örnek Kullanım:**

```php
$response =  $client->getReportDetail(123456);
print_r($response);
```

  

---

  

### 6. Tarih Bazlı Rapor Sorgulama

**Açıklama:**

Belirli bir tarih aralığındaki raporları sorgulamak için kullanılır.

  

**Parametreler:**

-  `string $startDate`: Başlangıç tarihi (örneğin, '2023-01-01').

-  `string $endDate`: Bitiş tarihi (örneğin, '2023-12-31').

  

**Örnek Kullanım:**

```php
$response =  $client->getReportsByDate('2023-01-01',  '2023-12-31');
print_r($response);
```

  

---

  

### 7. Sonuç Sorgusu

**Açıklama:**

Gönderilen bir raporun durumunu sorgulamak için kullanılır.

  

**Parametreler:**

-  `int $reportId`: Sorgulanacak raporun ID'si.

  

**Örnek Kullanım:**

```php
$response =  $client->getReportStatus(123456);
print_r($response);
```

  

---

  

### 8. İleri Tarihli SMS İptali

**Açıklama:**

Zamanlanmış bir SMS gönderimini iptal etmek için kullanılır.

  

**Parametreler:**

-  `int $id`: İptal edilecek SMS'in ID'si.

  

**Örnek Kullanım:**

```php
$response =  $client->cancelFutureSms(123);
print_r($response);
```

  

---

  

## Testler

  

Testleri çalıştırmak için şu komutu kullanabilirsiniz:

  

```bash
vendor/bin/phpunit
```

  

---

  

## Lisans

  

Bu SDK, MIT lisansı ile lisanslanmıştır. Daha fazla bilgi için `LICENSE` dosyasına göz atabilirsiniz.
