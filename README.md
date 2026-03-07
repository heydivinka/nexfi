# 🚀 NEXFI — Sistem Manajemen Keuangan

**Nexfi** adalah aplikasi manajemen keuangan berbasis web yang dibangun dengan **Laravel 12**. Aplikasi ini dirancang untuk memudahkan pengelolaan saldo, transaksi, dan laporan keuangan secara efisien.

### ✨ Fitur Utama

- 💰 Manajemen saldo & transaksi
- 📱 Generate & Scan QR Code untuk transaksi
- 📊 Export / Cetak laporan keuangan
- ✅ Approval testimoni oleh admin
- 📩 Pesan dari landing page masuk ke dashboard admin

---

## 🛠️ Tech Stack

| Teknologi | Versi |
|-----------|-------|
| PHP | 8.3+ |
| Laravel | 12 |
| MySQL | - |
| Node.js & NPM | - |
| Laragon | Disarankan *(bukan XAMPP)* |

---

## 📋 Prasyarat

Sebelum memulai, pastikan kamu sudah menginstal:

- ✅ [Laragon](https://laragon.org/) — disarankan sebagai local development environment
- ✅ PHP 8.3+
- ✅ Composer
- ✅ Node.js & NPM
- ✅ MySQL

> ⚠️ **Catatan:** Nexfi direkomendasikan menggunakan **Laragon**, bukan XAMPP, agar konfigurasi lebih stabil dan kompatibel dengan Laravel 12.

---

## ⚙️ Panduan Instalasi (Step by Step)

### 1️⃣ Clone Repository

```bash
git clone https://github.com/username/nexfi.git
cd nexfi
```

---

### 2️⃣ Install Dependency Backend

```bash
composer install
```

---

### 3️⃣ Setup File Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Lalu generate application key:

```bash
php artisan key:generate
```

---

### 4️⃣ Konfigurasi Database

Buka file `.env`, lalu sesuaikan dengan konfigurasi database kamu:

```env
DB_DATABASE=nexfi
DB_USERNAME=root
DB_PASSWORD=
```

> 💡 **Penting:** Buat database baru di **phpMyAdmin** dengan nama yang sama seperti `DB_DATABASE` sebelum melakukan migrasi.

---

### 5️⃣ Storage Link *(WAJIB)*

```bash
php artisan storage:link
```

**Mengapa ini wajib?**

Command ini membuat *symbolic link* dari `storage/app/public` ke `public/storage`, sehingga file yang diupload bisa diakses melalui browser.

Tanpa perintah ini:
- 🚫 QR Code tidak akan tampil
- 🚫 File laporan tidak bisa diakses
- 🚫 Foto & file upload user tidak muncul

---

### 6️⃣ Install Dependency Frontend

```bash
npm install
```

Build assets untuk production:

```bash
npm run build
```

Atau jalankan dalam mode development (live reload):

```bash
npm run dev
```

---

### 7️⃣ Setup Package QR Code

Jika package belum terinstal, jalankan:

```bash
composer require simplesoftwareio/simple-qrcode
```

Publish konfigurasi (jika diperlukan):

```bash
php artisan vendor:publish --provider="SimpleSoftwareIO\QrCode\QrCodeServiceProvider"
```

> 📁 File QR Code tersimpan di: `storage/app/public/qr/`  
> Pastikan `storage:link` sudah dijalankan agar QR Code bisa tampil di browser.

---

### 8️⃣ Setup Export / Cetak Laporan

Jika package belum terinstal, jalankan:

```bash
composer require maatwebsite/excel
```

Publish konfigurasi:

```bash
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```

> 📁 File laporan biasanya tersimpan di: `storage/app/public/laporan/`  
> Atau bisa langsung terdownload otomatis melalui browser.

Jika laporan **gagal didownload**, periksa hal berikut:
- Pastikan `storage:link` sudah dijalankan
- Cek permission folder `storage/`
- Pastikan konfigurasi path export sudah benar

---

### 9️⃣ Migrasi Database

> ⚠️ Pastikan nama database di `.env` sudah sesuai sebelum menjalankan perintah ini.

Migrasi pertama kali:

```bash
php artisan migrate
```

Reset dan jalankan ulang semua migrasi:

```bash
php artisan migrate:fresh
```

Reset + jalankan seeder (data dummy):

```bash
php artisan migrate:fresh --seed
```

Rollback migrasi terakhir:

```bash
php artisan migrate:rollback
```

---

### 🔟 Jalankan Server

```bash
php artisan serve
```

Buka di browser:

```
http://127.0.0.1:8000
```

Jika menggunakan **Laragon**:

```
http://nexfi.test
```

---

## 🧹 Command Penting Saat Error

Jika mengalami error cache atau tampilan tidak terupdate, jalankan perintah berikut:

```bash
# Clear semua cache sekaligus
php artisan optimize:clear

# Clear cache konfigurasi
php artisan config:clear

# Clear cache tampilan (view)
php artisan view:clear
```
---

## 👤 Cara Menggunakan Nexfi

### Sebagai Pengguna (User)
1. Register akun baru
2. Login ke dashboard
3. Kelola saldo & transaksi
4. Generate QR Code untuk transaksi
5. Export / cetak laporan keuangan

### Sebagai Admin
1. Akses dashboard admin
2. Approve / tolak testimoni dari pengguna
3. Baca & kelola pesan yang masuk dari landing page
4. Kelola data pengguna dan role akun

---

## 🔑 Cara Set Akun Admin

Secara default, akun yang baru dibuat memiliki role `pengguna`. Berikut cara mengubahnya menjadi `admin`:

---

### Cara 1: Manual via Database (phpMyAdmin)

1. Buka **phpMyAdmin**
2. Pilih database `nexfi` → buka tabel `users`
3. Cari user yang ingin dijadikan admin
4. Klik **Edit**, ubah kolom `role` dari `pengguna` → `admin`
5. Klik **Simpan**

> ⚡ Setelah disimpan, user tersebut langsung bisa login dan mengakses **dashboard admin**.

---

### Cara 2: Via Artisan Tinker *(Direkomendasikan)*

Artisan Tinker adalah REPL (interactive shell) Laravel yang memungkinkan kita memanipulasi database langsung dari terminal, tanpa perlu membuka phpMyAdmin.

**Langkah-langkah:**

**1. Buka terminal, masuk ke folder project:**

```bash
cd path/ke/folder/nexfi
```

**2. Jalankan Artisan Tinker:**

```bash
php artisan tinker
```

**3. Cari user berdasarkan email:**

```php
$user = \App\Models\User::where('email', 'email@example.com')->first();
```

**4. Ubah role menjadi admin:**

```php
$user->role = 'admin';
$user->save();
```

**5. Verifikasi perubahan (opsional):**

```php
$user->fresh();
// Akan menampilkan data user terbaru, pastikan role sudah berubah menjadi 'admin'
```

**Atau gunakan shortcut 1 baris:**

```php
\App\Models\User::where('email', 'email@example.com')->first()->update(['role' => 'admin']);
```

**6. Keluar dari Tinker:**

```bash
exit
```

> ⚡ Setelah diubah, user bisa langsung login dan mengakses **dashboard admin** tanpa perlu daftar ulang.

---

## ⚠️ Hal yang Sering Menyebabkan Error

| Masalah | Solusi |
|--------|--------|
| Gambar / QR tidak tampil | Jalankan `php artisan storage:link` |
| Tampilan berantakan / CSS tidak jalan | Jalankan `npm install` dan `npm run build` |
| Error saat migrate | Cek konfigurasi database di `.env` |
| Error cache / config lama | Jalankan `php artisan optimize:clear` |
| Versi PHP tidak sesuai | Pastikan PHP 8.3+ sudah aktif di Laragon |
| Permission storage error | Cek permission folder `storage/` dan `bootstrap/cache/` |

---

## 📌 Catatan Penting

- 🟢 Gunakan **Laragon** sebagai local server, bukan XAMPP
- 🟢 Pastikan PHP versi **8.3 atau lebih baru**
- 🟢 Selalu jalankan `storage:link` setelah clone project
- 🟢 Sesuaikan konfigurasi `.env` sebelum migrate
- 🟢 Hanya berikan role `admin` kepada orang yang terpercaya

---

## 🧹 Command Penting Untuk NEXFI

# Install DBAL (dibutuhkan untuk operasi migrasi database)
composer require doctrine/dbal

# Install package untuk generate QR Code
composer require simplesoftwareio/simple-qrcode

# Install package untuk export PDF
composer require barryvdh/laravel-dompdf

# Install package untuk export/import Excel
composer require maatwebsite/excel

# Install HTTP client untuk request API
composer require guzzlehttp/guzzle

# Mengatur permission folder assets agar bisa diakses server
chmod -R 755 public/assets_public

# Membuat symbolic link dari storage ke public
php artisan storage:link

# ❗ Opsional: Clear semua cache Laravel supaya fresh
php artisan optimize:clear
php artisan config:clear
php artisan view:clear
php artisan cache:clear
php artisan route:clear

---

*Dibuat dengan ❤️ menggunakan kekompakan team nexfi*
