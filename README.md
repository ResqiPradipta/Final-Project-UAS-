**Mata Kuliah : Pemrograman Web**

## Link YT : https://youtu.be/Mc6FZgixt4c 
## Link website : https://simaja.site/ 

login website
username : adminresqi
password : resqi123

**Dokumentasi Proyek Aplikasi SIMAJA (Sistem Manajemen Inventaris dan Perawatan Aset)**.

---

## 📝 **1. Dokumentasi Proyek Aplikasi SIMAJA**

### a) ✅ **Cara Instalasi Aplikasi**

#### 💻 Persyaratan Sistem:

* Web Server: Apache (disarankan menggunakan XAMPP)
* PHP: Versi 7.4 atau lebih baru
* MySQL/MariaDB
* Browser modern (Chrome, Firefox, Edge)

#### 📦 Langkah Instalasi:

1. **Download & Ekstrak Aplikasi:**

   * Ekstrak folder `simaja` ke direktori web server, contoh: `C:\xampp\htdocs\simaja`.

2. **Siapkan Database:**

   * Buka `phpMyAdmin`.
   * Buat database baru, misalnya: `simaja_db`.
   * Import file `simaja.sql` (disediakan bersama proyek).

3. **Konfigurasi Koneksi Database:**

   * Buka file `config/db.php`.
   * Sesuaikan dengan konfigurasi lokal:

     ```php
     $conn = new mysqli("localhost", "root", "", "simaja_db");
     ```
   * Pastikan tidak ada error koneksi.

4. **Jalankan Aplikasi:**

   * Buka browser dan akses: `http://localhost/simaja/login.php`.

---

### b) 🗃️ **Struktur Database**

#### 📌 Tabel-Tabel Utama:

1. **`users`**

   * Menyimpan data pengguna (admin, teknisi, dsb)
   * Kolom: `id`, `nama`, `username`, `password`, `role_id`
   * Relasi: `role_id` → `roles.id`

2. **`roles`**

   * Menyimpan jenis peran (admin, teknisi, viewer)
   * Kolom: `id`, `nama`

3. **`assets`**

   * Menyimpan data aset/inventaris
   * Kolom: `id`, `nama`, `kategori_id`, `lokasi_id`, `tanggal_beli`
   * Relasi: `kategori_id` → `categories.id`, `lokasi_id` → `locations.id`

4. **`categories`**

   * Menyimpan kategori aset
   * Kolom: `id`, `nama`

5. **`locations`**

   * Menyimpan lokasi penyimpanan aset
   * Kolom: `id`, `nama`

6. **`maintenance`**

   * Menyimpan histori perawatan aset
   * Kolom: `id`, `aset_id`, `tanggal`, `deskripsi`, `teknisi_id`
   * Relasi: `aset_id` → `assets.id`, `teknisi_id` → `users.id`


### c) 📘 **Panduan Penggunaan Aplikasi**

#### 1. 🔐 **Login**

* Buka `http://localhost/simaja/login.php`
* Gunakan username dan password sesuai data di tabel `users`
* Contoh:

  * Username: `admin`
  * Password: `admin123` (tergantung data hash)

#### 2. 🧭 **Navigasi Menu**

* Navigasi utama berada di navbar:

  * **Dashboard:** Menampilkan statistik aset, user, perawatan
  * **Users:** Manajemen akun pengguna
  * **Aset:** Tambah/edit/hapus data aset
  * **Perawatan:** Catat dan lihat histori perawatan aset
  * **Laporan:** Unduh laporan aset atau perawatan
  * **Pengaturan:** Manajemen kategori, lokasi, role
  * **Logout:** Keluar dari aplikasi

#### 3. 🧩 **Modul-Module Utama**

| Modul           | Fungsi                                            |
| --------------- | ------------------------------------------------- |
| **Users**       | Tambah/edit user dan role                         |
| **Assets**      | Kelola aset: nama, kategori, lokasi, tanggal beli |
| **Maintenance** | Catat dan lihat perawatan aset oleh teknisi       |
| **Laporan**     | Cetak/export laporan aset/perawatan               |
| **Pengaturan**  | Tambah kategori, lokasi, role                     |

---
