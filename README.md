# Interoperabilitas OpenELIS dan OpenMRS

## Tentang Integrasi

Integrasi **OpenMRS** (Open Medical Record System) dan **OpenELIS** (Open Enterprise Laboratory Information System) bertujuan untuk membentuk sistem layanan kesehatan yang lebih interoperabel, efisien, dan berstandar. Integrasi ini mengatasi masalah input manual, inkonsistensi format data, dan keterlambatan akses informasi yang sering menghambat proses diagnosis klinis.

Dengan pendekatan berbasis **RESTful API** dan standar **HL7 FHIR**, sistem ini mampu:

* Mengekspor pesanan laboratorium dari OpenMRS ke OpenELIS secara otomatis
* Menyinkronkan hasil laboratorium dari OpenELIS ke OpenMRS dalam format yang terstandarisasi
* Menjamin keamanan dan integritas informasi melalui middleware yang mendukung autentikasi dan pemetaan entitas

## Fitur Utama

* **Integrasi Otomatis End-to-End**: Pembuatan pesanan di OpenMRS langsung muncul di OpenELIS tanpa input manual
* **Dukungan Standar HL7 FHIR**: Menggunakan struktur JSON yang sesuai dengan standar internasional untuk pertukaran data
* **Middleware Custom**: Menjembatani komunikasi dua sistem dengan keamanan dan pemetaan entitas data yang presisi
* **Pengujian HAPI FHIR**: Validasi pengelolaan data pasien, dokter, dan order lab sesuai spesifikasi FHIR
* **Konsistensi dan Transparansi Data**: Pemanfaatan katalog API dan ERD untuk memastikan pertukaran data konsisten dan dapat ditelusuri

## Penggunaan

### Menyambungkan OpenELIS dan OpenMRS

1. Jalankan container Docker untuk masing-masing sistem (OpenMRS, OpenELIS, dan middleware)
2. Konfigurasikan endpoint REST API OpenMRS dan OpenELIS dalam middleware
3. Gunakan credential autentikasi yang sesuai
4. Jalankan integrasi dan uji pengiriman pesanan dan hasil lab secara end-to-end

### Melihat Hasil Lab di OpenMRS

1. Login ke dashboard OpenMRS
2. Akses halaman pasien dan buka tab "Lab Orders" atau "Hasil Pemeriksaan"
3. Verifikasi bahwa hasil dari OpenELIS telah disinkronkan otomatis ke tampilan rekam medis

### Memantau Status dan Debugging

1. Gunakan katalog API atau middleware dashboard untuk melacak status pesan
2. Cek log untuk kesalahan pengiriman atau pemetaan data

## Cara Menjalankan Laravel

Untuk menjalankan proyek Laravel (misalnya middleware atau dashboard integrasi):

### 1. Clone Repositori

```bash
git clone https://github.com/nama-user/nama-repo.git
cd nama-repo
```

### 2. Install Dependency

```bash
composer install
```

### 3. Salin File .env dan Generate Key

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan dengan pengaturan database lokal Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi dan Seed Database

```bash
php artisan migrate --seed
```

### 6. Jalankan Server Lokal

```bash
php artisan serve
```

Aplikasi akan berjalan di http://localhost:8000

## Manfaat Integrasi

* **Percepatan Diagnosis**: Data lab otomatis tampil di rekam medis tanpa keterlambatan
* **Pengurangan Kesalahan**: Eliminasi input manual mengurangi risiko kesalahan entri data
* **Transparansi dan Skalabilitas**: Berbasis API dan kontainer Docker untuk penerapan di berbagai skala layanan
* **Literatur Open Source**: Studi kasus kontribusi nyata pada pengembangan sistem kesehatan terbuka