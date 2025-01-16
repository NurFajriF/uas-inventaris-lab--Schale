# Schale Lab Inventory

Schale Lab Inventory adalah aplikasi manajemen inventaris laboratorium yang dirancang untuk mempermudah pengelolaan alat dan peminjaman di lingkungan akademik. Aplikasi ini memiliki fitur utama untuk admin (asisten lab) dan pengguna umum (dosen, staf akademik, dan mahasiswa).

---

## Fitur Utama

### 1. Manajemen Inventaris
- Admin dapat menambah, mengubah, dan menghapus data alat laboratorium.
- Melihat jumlah alat yang tersedia.

### 2. Sistem Peminjaman Alat
- **Halaman Khusus Peminjaman**:
  - Untuk dosen/staf akademik: Memasukkan data (nama, NIP, kontak), memilih alat, tanggal peminjaman, dan tanggal pengembalian.
  - Untuk mahasiswa: Memasukkan data (nama, NIM, kontak), memilih alat, tanggal peminjaman, dan tanggal pengembalian.
- Tidak memerlukan login untuk peminjam.
- Validasi form untuk memastikan data lengkap dan benar.

### 3. Role Management
- **Admin (Asisten Lab)**:
  - Login untuk mengelola inventaris dan peminjaman.
  - Menyetujui atau menolak permintaan peminjaman.
  - Melihat laporan riwayat peminjaman.

---

## Teknologi yang Digunakan
- **Backend**: Laravel
- **Frontend**: Blade Template Engine (dengan integrasi DataTables untuk laporan)
- **Database**: MySQL
- **Role Management**: Spatie Laravel Permission

---

## Instalasi

### 1. Clone Repository
```bash
$ git clone https://github.com/username/schale-lab-inventory.git
$ cd schale-lab-inventory
```

### 2. Install Dependencies
```bash
$ composer install
$ npm install
```

### 3. Konfigurasi Environment
Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=schale_inventory
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi dan Seed Database
```bash
$ php artisan migrate 
$ php artisan db:seed
```

### 5. Jalankan Server
```bash
$ php artisan serve
```
Akses aplikasi di [http://localhost:8000](http://localhost:8000).

---

## Penggunaan

### 1. Akses untuk Peminjam
- Buka halaman utama di [http://localhost:8000](http://localhost:8000).
- Isi form peminjaman dan submit.

### 2. Akses untuk Admin
- Login melalui halaman admin di [http://localhost:8000/admin](http://localhost:8000/admin).
- Kelola inventaris dan peminjaman.

---

## Demo Video
[https://drive.google.com/drive/folders/1N2d0me741sgpqipdY8tnXZiOAO3Et8Pa?usp=drive_link](#)

---
