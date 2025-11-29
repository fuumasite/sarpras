# 📚 SarPras SV IPB — Sistem Pelaporan Sarana & Prasarana Kampus

## **1. Ringkasan Proyek**

**SarPras SV IPB** adalah sistem pelaporan dan manajemen sarana & prasarana kampus yang memungkinkan pengguna (mahasiswa/user) melaporkan kerusakan, permintaan perbaikan, dan memantau status penyelesaian. Sistem ini menggunakan UUID untuk keamanan dan mendukung peran Admin dan Pengguna.

Fitur utama termasuk **Laporan Real-time**, **Manajemen Aset**, **Permintaan Perbaikan**, dan **Audit Trails** untuk jejak tindakan pengguna.

## **1. Technical Stack**

Ang system ay binuo gamit ang mga sumusunod na teknolohiya base sa requirements:

-   **Framework:** Laravel 12 (PHP 8.2)
-   **Database:** MySQL (LAMP)
-   **Frontend:** Bootstrap 5 (Sass/SCSS) + Vite
-   **Scripting:** JavaScript (ES6), jQuery
-   **PDF & Barcodes:** `barryvdh/laravel-dompdf` & `picqer/php-barcode-generator`
-   **Authentication:** Laravel Breeze (Customized)


## **2. Installation Guide (How to Run)**

Kung ililipat sa ibang computer o ide-deploy, sundin ito:

**Step 1: Prerequisites**

-   Install XAMPP / LAMP (Start Apache & MySQL).
-   Install Composer & Node.js.

**Step 2: Clone & Install Dependencies**

```bash
git clone [repository_url]
cd inventory_system
composer install
npm install
```

**Step 3: Pengaturan Environment**

1.  Salin `.env.example` menjadi `.env`.
2.  Isi kredensial database (`DB_DATABASE=inventory_system`).
3.  (Opsional) Isi kredensial Mail jika ingin mengaktifkan notifikasi email.

**Step 4: Key Generation & Migration**

```bash
php artisan key:generate
php artisan migrate:fresh --seed
```

_(Ang `--seed` ay gagawa ng default Admin: `admin@example.com` / `password`)_.

**Step 5: Link Storage**
Mahalaga ito para lumabas ang images.

```bash
php artisan storage:link

**Step 6: Menjalankan Aplikasi**
Buka terminal untuk menjalankan backend dan (opsional) frontend:
```powershell
php artisan serve
npm run dev
```
```
