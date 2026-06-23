# Panduan Instalasi Payment Gateway Midtrans

Panduan ini disiapkan untuk project MyKit berbasis Native PHP.

## 1. Siapkan Akun Midtrans

1. Buat akun di dashboard Midtrans: https://dashboard.midtrans.com/
2. Masuk ke mode Sandbox untuk development.
3. Buka menu `Settings` > `Access Keys`.
4. Salin:
   - `Server Key`
   - `Client Key`

Gunakan key Sandbox saat development. Jangan gunakan production key sebelum transaksi benar-benar siap.

## 2. Install SDK Midtrans PHP

Jalankan dari root project:

```bash
composer require midtrans/midtrans-php
```

Jika `vendor` sudah ada tetapi autoload belum mengenali package baru, jalankan:

```bash
composer dump-autoload
```

## 3. Tambahkan Konfigurasi Environment

Isi file `.env`:

```env
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxxxxxx
MIDTRANS_IS_PRODUCTION=false
```

Untuk production nanti:

```env
MIDTRANS_SERVER_KEY=Mid-server-xxxxxxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=Mid-client-xxxxxxxxxxxxxxxx
MIDTRANS_IS_PRODUCTION=true
```

Jangan commit file `.env` karena berisi secret key.

## 4. Buat File Konfigurasi Midtrans

Contoh file `config/midtrans.php`:

```php
<?php

function mykit_midtrans_env(string $key, $default = null)
{
    $value = $_ENV[$key] ?? getenv($key);

    return ($value === false || $value === null || $value === '') ? $default : $value;
}

return [
    'server_key' => mykit_midtrans_env('MIDTRANS_SERVER_KEY'),
    'client_key' => mykit_midtrans_env('MIDTRANS_CLIENT_KEY'),
    'is_production' => filter_var(
        mykit_midtrans_env('MIDTRANS_IS_PRODUCTION', false),
        FILTER_VALIDATE_BOOLEAN
    ),
];
```

## 5. Inisialisasi Midtrans di Controller

Contoh minimal untuk membuat Snap Token:

```php
<?php

use Midtrans\Config;
use Midtrans\Snap;

$midtrans = require __DIR__ . '/../../config/midtrans.php';

Config::$serverKey = $midtrans['server_key'];
Config::$isProduction = $midtrans['is_production'];
Config::$isSanitized = true;
Config::$is3ds = true;

$orderId = 'MYKIT-' . time();

$params = [
    'transaction_details' => [
        'order_id' => $orderId,
        'gross_amount' => 50000,
    ],
    'customer_details' => [
        'first_name' => 'Nama User',
        'email' => 'user@example.com',
    ],
    'item_details' => [
        [
            'id' => 'premium-monthly',
            'price' => 50000,
            'quantity' => 1,
            'name' => 'MyKit Premium Bulanan',
        ],
    ],
];

$snapToken = Snap::getSnapToken($params);
```

Kirim `$snapToken` ke view pembayaran.

## 6. Pasang Snap.js di View

Gunakan Sandbox URL saat development:

```html
<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="<?= htmlspecialchars($midtransClientKey) ?>">
</script>
```

Tombol pembayaran:

```html
<button id="pay-button" type="button">Bayar Sekarang</button>

<script>
document.getElementById('pay-button').addEventListener('click', function () {
    snap.pay('<?= htmlspecialchars($snapToken) ?>', {
        onSuccess: function (result) {
            window.location.href = '/payment/success?order_id=' + encodeURIComponent(result.order_id);
        },
        onPending: function (result) {
            window.location.href = '/payment/pending?order_id=' + encodeURIComponent(result.order_id);
        },
        onError: function () {
            window.location.href = '/payment/failed';
        },
        onClose: function () {
            alert('Pembayaran belum selesai.');
        }
    });
});
</script>
```

Untuk production, ganti URL Snap.js menjadi:

```html
https://app.midtrans.com/snap/snap.js
```

## 7. Siapkan Notification URL

Di dashboard Midtrans, isi Payment Notification URL ke endpoint aplikasi, misalnya:

```text
https://domain-kamu.com/payment/notification
```

Endpoint ini harus:

1. Menerima JSON dari Midtrans.
2. Verifikasi signature/status transaksi.
3. Update status order di database.
4. Mengembalikan HTTP 200 jika berhasil diproses.

Contoh struktur status order:

```text
pending
settlement
capture
deny
cancel
expire
refund
```

## 8. Checklist Testing Sandbox

1. Jalankan aplikasi:

```bash
php -S localhost:8000 -t public public/index.php
```

2. Buat transaksi dengan nominal kecil.
3. Pastikan Snap popup muncul.
4. Test pembayaran sukses, pending, dan gagal.
5. Pastikan notification URL mengubah status order di database.
6. Baru pindah ke production setelah flow sandbox stabil.

## Referensi Resmi

- Dokumentasi Midtrans: https://docs.midtrans.com/
- SDK PHP Midtrans: https://github.com/Midtrans/midtrans-php
