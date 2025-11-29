# 📚 SarPras SV IPB — Sistem Pelaporan Sarana & Prasarana Kampus

## **1. Ringkasan Proyek**

**SarPras SV IPB** adalah sistem pelaporan dan manajemen sarana & prasarana kampus yang memungkinkan pengguna (mahasiswa/user) melaporkan kerusakan, permintaan perbaikan, dan memantau status penyelesaian. Sistem ini menggunakan UUID untuk keamanan dan mendukung peran Admin dan Pengguna.

Fitur utama termasuk **Laporan & Statistik Real-time**, **Manajemen Aset**, **Permintaan Restock / Perbaikan**, dan **Audit Trails** untuk jejak tindakan pengguna.

## **2. Technical Stack**

Ang system ay binuo gamit ang mga sumusunod na teknolohiya base sa requirements:

-   **Framework:** Laravel 12 (PHP 8.2)
-   **Database:** MySQL (XAMPP)
-   **Frontend:** Bootstrap 5 (Sass/SCSS) + Vite
-   **Scripting:** JavaScript (ES6), jQuery
-   **Charts:** Chart.js (Data Visualization)
-   **PDF & Barcodes:** `barryvdh/laravel-dompdf` & `picqer/php-barcode-generator`
-   **Authentication:** Laravel Breeze (Customized)
-   **Security:** Sistem menggunakan autentikasi standar; reCAPTCHA dan verifikasi email dinonaktifkan dalam deployment ini (opsional)

## **3. System Architecture**

### **A. Database Design (Strict UUID)**

Lahat ng Primary Keys at Foreign Keys sa database ay gumagamit ng **UUID (Universally Unique Identifier)** sa halip na auto-increment integers.

-   **Tables:** `users`, `products`, `categories`, `restock_requests`, `activity_logs`.
-   **Security Benefit:** Hindi mahuhulaan ang ID ng records (e.g., `/products/999` vs `/products/123e4567-e89b...`).

### **B. Role-Based Access Control (RBAC)** [cite: 26-28]

May dalawang user roles na protektado ng Middleware:

1.  **Admin:** Full Access (CRUD Products/Categories, Manage Users, Reports, Analytics).
2.  **User:** Restricted Access (View Inventory, Stock In/Out, Request Restock, Print Labels).

## **4. Features & Functionalities**

### **🔐 Autentikasi & Keamanan**

-   **Modern Split-Screen UI:** Desain ramah pengguna dengan tema hijau pastel.
-   **Keamanan:** Autentikasi berbasis Laravel (Breeze). Fitur reCAPTCHA dan verifikasi email tidak aktif secara default pada konfigurasi ini.
-   **Notifikasi:** Toast notifications untuk pemberitahuan sukses dan error.
-   **Password Visibility:** Toggle Eye Icon untuk kenyamanan pengguna.

### **📊 Admin Dashboard (Analytics)**

-   **Interactive Charts:**
    -   **Bar Chart:** Inventory distribution per category (Drill-down capability).
    -   **Doughnut Chart:** Real-time Stock Health (Healthy vs. Low Stock).
-   **Live Stats Cards:** Total Products, Categories, Users, at Low Stock Alerts.
-   **Design:** Cards with "Lift Effect" shadow animation.

### **📦 Product Management**

-   **Full CRUD:** Create, Read, Update, Delete products.
-   **Image Handling:** Upload at storage sa `public/storage/products`.
-   **DataTables Integration:** Searchable, Sortable, at Paginated na listahan.
-   **Low Stock Indicators:** Automatic na nagkukulay pula ang stock count kapag \<= 10.

### **🏷️ Category Management**

-   Create, Edit, Delete categories gamit ang **Bootstrap Modals** (walang page reload).

### **🔄 Stock Control (User Features)**

-   **Quick Adjust:** `+` (Stock In) at `-` (Stock Out) buttons na may logs ng rason (e.g., "Sold", "Damaged").
-   **Restock Requests:** Ang user ay pwedeng mag-request ng stocks sa Admin.
    -   _Flow:_ User Request -> Admin Review -> Approve (Auto-add stock) / Reject.
-   **Barcode Printing:** Generate ng PDF stickers na may Barcode, Name, at Price. (Layout: 3 Columns, Legal Size).

### **👥 User Management**

-   Ang Admin ay pwedeng mag-**Add**, **Edit**, at **Delete** ng User accounts.
-   Auto-generated avatar based sa initials kung walang inupload na picture.

### **📝 Audit Trail & Reports**

-   **Activity Logs:** Lahat ng galaw (Sino nag-add, nag-bura, nag-edit) ay naka-record sa database at makikita sa Profile ng user.
-   **PDF Export:** Downloadable inventory report na may total asset value computation.

## **5. UI/UX Design System**

-   **Color Palette (Pastel Green):**
    -   Primary: `#B0DB9C` (Buttons, Icons)
    -   Background: `#ECFAE5` (Left Panels, Highlights)
    -   Accent: `#DDF6D2`
-   **Layout:**
    -   **Fixed Header & Footer:** Naka-pako sa taas at baba ng screen habang nagso-scroll ang content.
    -   **Responsive:** Mobile-friendly gamit ang Bootstrap 5 grid.
    -   **Glassmorphism:** Sa landing page (`/`) para sa futuristic look.

## **6. Installation Guide (How to Run)**

Kung ililipat sa ibang computer o ide-deploy, sundin ito:

**Step 1: Prerequisites**

-   Install XAMPP (Start Apache & MySQL).
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
