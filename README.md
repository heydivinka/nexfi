# 🚀 NEXFI

Sistem Manajemen Keuangan berbasis Laravel 12.

Nexfi adalah aplikasi pengelolaan keuangan yang memiliki fitur:
- Manajemen saldo & transaksi
- Generate QR Code
- Export / Extract laporan
- Approval testimoni oleh admin
- Pesan dari landing page masuk ke dashboard admin

---

# 🛠 Tech Stack

- PHP 8.3+
- Laravel 12
- MySQL
- Node.js & NPM
- Laragon (disarankan, bukan XAMPP)

---

# ⚙️ INSTALLATION GUIDE

## 1️⃣ Clone Repository

```bash
git clone https://github.com/username/nexfi.git
cd nexfi
```

---

## 2️⃣ Install Dependency Backend

```bash
composer install
```

---

## 3️⃣ Setup Environment

Copy file environment:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

## 4️⃣ Setting Database

Buka file `.env` dan sesuaikan:

```env
DB_DATABASE=nexfi
DB_USERNAME=root
DB_PASSWORD=
```

Buat database baru di phpMyAdmin dengan nama yang sama sebelum migrate.

---

## 5️⃣ Storage Link (WAJIB)

```bash
php artisan storage:link
```

### Fungsi storage:link

Command ini membuat symbolic link dari:

```
storage/app/public
```

ke:

```
public/storage
```

Tanpa perintah ini:
- QR Code tidak akan tampil
- File laporan export tidak bisa diakses
- File upload user tidak muncul

Wajib dijalankan setelah clone project.

---

## 6️⃣ Install Dependency Frontend

```bash
npm install
```

Build assets:

```bash
npm run build
```

Atau mode development:

```bash
npm run dev
```

---

## 7️⃣ Setup Package QR Code

Jika belum terinstall:

```bash
composer require simplesoftwareio/simple-qrcode
```

Publish config (jika diperlukan):

```bash
php artisan vendor:publish --provider="SimpleSoftwareIO\QrCode\QrCodeServiceProvider"
```

Folder penyimpanan QR biasanya di:

```
storage/app/public/qr
```

Karena itu storage:link wajib dijalankan.

---

## 8️⃣ Setup Export / Extract Laporan

Jika menggunakan Laravel Excel:

Install:

```bash
composer require maatwebsite/excel
```

Publish config:

```bash
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```

File laporan biasanya tersimpan di:

```
storage/app/public/laporan
```

Atau langsung terdownload otomatis via response download.

Jika laporan tidak bisa didownload:
- Pastikan storage:link sudah dijalankan
- Cek permission folder storage
- Cek konfigurasi path export

---

## 9️⃣ Migrasi Database

Pastikan nama database sudah sesuai sebelum migrate.

```bash
php artisan migrate
```

---

### Reset Database

```bash
php artisan migrate:fresh
```

Dengan seeder:

```bash
php artisan migrate:fresh --seed
```

Rollback migration:

```bash
php artisan migrate:rollback
```

---

## 🔟 Jalankan Server

```bash
php artisan serve
```

Akses melalui:

```
http://127.0.0.1:8000
```

Jika menggunakan Laragon:

```
http://nexfi.test
```

---

# 🧹 Command Penting Saat Error

Clear semua cache:

```bash
php artisan optimize:clear
```

Clear config:

```bash
php artisan config:clear
```

Clear view:

```bash
php artisan view:clear
```

---

# 📂 Struktur Folder Penting

- app/ → Logic aplikasi
- routes/web.php → Routing
- database/migrations → Struktur tabel
- resources/views → Tampilan
- storage/app/public → File upload, QR, laporan
- public/storage → Akses file ke browser (hasil storage:link)

---

# ⚠️ Hal yang Sering Menyebabkan Error

- Lupa setting database sebelum migrate
- Lupa menjalankan storage:link
- Lupa npm install
- Versi PHP tidak sesuai
- Permission folder storage bermasalah

---

# 👨‍💻 Cara Menggunakan Nexfi

1. Register akun
2. Login ke dashboard
3. Kelola saldo dan transaksi
4. Generate QR untuk transaksi
5. Export laporan keuangan
6. Admin dapat approve testimoni dan membaca pesan dari landing page

---

# 📌 Notes

Disarankan menggunakan Laragon agar konfigurasi lebih stabil dan kompatibel dengan Laravel 12.

---
