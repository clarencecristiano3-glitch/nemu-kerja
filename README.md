# Nemu Kerja

Nemu Kerja adalah aplikasi portal lowongan kerja berbasis Laravel. Aplikasi ini menyediakan beranda lowongan, pencarian dan filter pekerjaan, detail pekerjaan, halaman lamaran, daftar perusahaan, registrasi, dan login pengguna.

## Status Project

Project ini masih berada pada tahap prototype. Beberapa data pekerjaan dan perusahaan masih ditulis langsung di controller, bukan diambil dari database.

Fitur yang sudah tersedia:

- Beranda dengan daftar kategori dan lowongan kerja.
- Pencarian lowongan berdasarkan kata kunci dan lokasi.
- Filter lowongan berdasarkan kategori.
- Halaman detail lowongan.
- Halaman form lamaran kerja.
- Daftar perusahaan.
- Registrasi pengguna.
- Login menggunakan username dan password.
- Session authentication Laravel.

Fitur yang belum tersedia atau belum selesai:

- Dashboard dan panel admin.
- Role atau permission admin.
- CRUD lowongan, perusahaan, kategori, dan pengguna.
- Penyimpanan data lamaran dan upload CV.
- Logout pada route web.
- Data lowongan dan perusahaan dari database.
- Link Tips Karir dan beberapa tombol perusahaan yang masih berupa `#`.

## Teknologi

- PHP 8.3 atau lebih baru
- Laravel 13
- SQLite sebagai database default
- Tailwind CSS 4
- Vite
- Pest untuk testing

## Persyaratan Instalasi

Pastikan aplikasi berikut sudah terpasang:

- PHP >= 8.3
- Composer
- Node.js dan npm
- Git, jika project diambil dari repository

## Instalasi

Masuk ke folder project:

```bash
cd d:/laragon/www/nemu-kerja
```

Jalankan setup otomatis:

```bash
composer run setup
```

Perintah tersebut akan:

1. Menginstal dependency PHP.
2. Membuat file `.env` dari `.env.example` jika belum ada.
3. Membuat application key.
4. Menjalankan migration database.
5. Menginstal dependency JavaScript.
6. Membuild asset frontend.

Jika setup dijalankan secara manual:

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

Pada Linux atau macOS, gunakan perintah berikut untuk menyalin environment file:

```bash
cp .env.example .env
```

## Menjalankan Aplikasi

Untuk menjalankan server Laravel, queue listener, dan Vite sekaligus:

```bash
composer run dev
```

Buka aplikasi melalui:

```text
http://localhost:8000
```

Alternatifnya, jalankan setiap proses secara terpisah:

```bash
php artisan serve
npm run dev
```

## URL Halaman

| Method | URL | Keterangan |
| --- | --- | --- |
| GET | `/` | Beranda |
| GET | `/home` | Beranda alternatif |
| GET | `/login` | Halaman login |
| POST | `/login` | Proses login |
| GET | `/register` | Halaman registrasi |
| POST | `/register` | Proses registrasi |
| GET | `/companies` | Daftar perusahaan |
| GET | `/job/detail` | Detail lowongan Hotway |
| GET | `/job/apply` | Form lamaran |

Nama route yang digunakan di Blade antara lain `home`, `login`, `register`, `companies.index`, `job.detail`, dan `job.apply`.

## Tutorial Registrasi dan Login User

### Membuat akun baru

1. Jalankan aplikasi dengan `composer run dev`.
2. Buka `http://localhost:8000/register`.
3. Isi username dengan minimal 3 karakter.
4. Isi password minimal 8 karakter.
5. Isi konfirmasi password dengan nilai yang sama.
6. Pilih umur antara 13 sampai 100 tahun.
7. Klik **Daftar**.

Setelah berhasil, pengguna otomatis login dan diarahkan ke halaman beranda.

### Login

1. Buka `http://localhost:8000/login`.
2. Masukkan username yang digunakan saat registrasi.
3. Masukkan password.
4. Klik **Masuk**.

Login menggunakan **username**, bukan email. Jika username atau password salah, halaman login akan menampilkan pesan error.

### Catatan akun database

Seeder bawaan project masih menggunakan data `Test User` dan `test@example.com`, tetapi login aplikasi membutuhkan username. Karena itu, akun tersebut tidak boleh dianggap sebagai akun login yang siap digunakan. Cara paling aman untuk mencoba login adalah membuat akun melalui halaman `/register`.

## Login Admin

Saat ini project **belum memiliki fitur admin**. Tidak tersedia:

- URL login admin khusus.
- Akun admin.
- Kolom atau role admin pada tabel users.
- Middleware `admin`.
- Controller admin.
- Dashboard admin.
- Halaman pengelolaan lowongan, perusahaan, atau pengguna.

Dengan kondisi kode saat ini, tidak ada username dan password admin yang dapat digunakan. Login melalui `/login` hanya melakukan autentikasi user biasa dan setelah berhasil mengarahkan pengguna ke beranda.

### Yang diperlukan untuk menambahkan admin

Implementasi admin membutuhkan setidaknya:

1. Menambahkan kolom `role` atau `is_admin` pada tabel `users`.
2. Membuat migration dan memperbarui model `User`.
3. Membuat middleware untuk membatasi akses admin.
4. Membuat route admin, misalnya `/admin`.
5. Membuat controller dan view dashboard admin.
6. Menambahkan akun admin melalui seeder atau perintah khusus.
7. Menambahkan test untuk login dan authorization admin.

Jangan menggunakan kredensial admin palsu dari README ini sebelum fitur tersebut benar-benar dibuat di aplikasi.

## Struktur Folder Penting

```text
app/Http/Controllers/       Controller halaman, login, dan registrasi
app/Models/                  Model User, Job, dan Category
database/migrations/         Struktur tabel database
database/seeders/            Data awal database
resources/views/             Template Blade aplikasi
resources/css/               Style frontend
resources/js/                JavaScript frontend
routes/web.php               Route aplikasi web
public/images/               Asset gambar aplikasi
tests/                       Test Feature dan Unit
```

Controller utama:

- `HomeController`: data kategori dan lowongan pada beranda.
- `DetailJobController`: detail lowongan dan form lamaran.
- `CompanyController`: daftar perusahaan.
- `LoginController`: proses login dan fungsi logout controller.
- `RegisterController`: validasi dan pembuatan akun baru.

## Database

Database default menggunakan SQLite. Konfigurasi berada di `.env`:

```env
DB_CONNECTION=sqlite
```

Menjalankan migration:

```bash
php artisan migrate
```

Mengulang database dari awal, termasuk menghapus data lama:

```bash
php artisan migrate:fresh --seed
```

Perintah `migrate:fresh --seed` hanya gunakan pada development karena seluruh data database akan dihapus.

## Testing

Jalankan seluruh test dengan:

```bash
composer run test
```

Atau:

```bash
php artisan test --compact
```

Saat ini test yang tersedia masih berupa test contoh Laravel. Test untuk login, registrasi, lamaran, dan hak akses admin belum dibuat.

## Troubleshooting

### Route tidak ditemukan

Bersihkan cache Laravel lalu periksa daftar route:

```bash
php artisan optimize:clear
php artisan route:list
```

### Asset frontend tidak tampil

Jalankan kembali Vite atau build asset:

```bash
npm run dev
```

atau:

```bash
npm run build
```

### Database error

Pastikan file SQLite tersedia dan migration sudah dijalankan:

```bash
php artisan migrate
```

## Lisensi

Project ini menggunakan Laravel dan mengikuti lisensi MIT Laravel. Lisensi aplikasi dapat disesuaikan dengan kebutuhan pemilik project.
