# Nemu Kerja

Nemu Kerja adalah website pencarian lowongan kerja yang menghubungkan pencari kerja dengan perusahaan. Pengunjung dapat melihat lowongan dan perusahaan yang telah diverifikasi. Pengguna yang memiliki akun dapat mengirim lamaran, sementara pemilik perusahaan dapat mengajukan perusahaan untuk diverifikasi dan mengelola lowongannya setelah disetujui.

Website memiliki tiga jenis akun:

- **Pencari kerja (`user`)**: mencari lowongan dan mengirim lamaran.
- **Admin perusahaan (`company_admin`)**: mengelola lowongan serta lamaran untuk perusahaan miliknya yang telah diverifikasi.
- **Superadmin (`superadmin`)**: mengelola verifikasi perusahaan dan konten seluruh website.

## Fitur Website

### Untuk pengunjung

- Beranda dan daftar lowongan.
- Pencarian lowongan berdasarkan kata kunci dan lokasi.
- Detail lowongan, termasuk posisi, pendidikan, lokasi, jumlah pelamar, kuota, dan masa berlaku.
- Daftar perusahaan dan halaman profil perusahaan yang sudah terverifikasi.
- Halaman tips karier yang dipublikasikan.

Lowongan hanya ditampilkan kepada publik jika statusnya **published**, perusahaan terkait sudah disetujui, dan tanggal berlakunya belum lewat.

### Untuk pencari kerja

- Membuat akun dan masuk menggunakan username.
- Mengirim lamaran ke lowongan yang tersedia.
- Mengunggah CV/surat lamaran dan hingga tiga dokumen pendukung.

### Untuk perusahaan

- Mengajukan data perusahaan beserta dokumen legalitas.
- Memantau status pengajuan dan alasan penolakan.
- Mengirim ulang dokumen legalitas apabila pengajuan ditolak.
- Setelah disetujui, menggunakan panel admin perusahaan untuk mengelola lowongan dan memeriksa lamaran.

## Persyaratan

- PHP 8.3 atau lebih baru
- Composer
- Node.js dan npm
- Database yang dikonfigurasi untuk Laravel (SQLite digunakan pada konfigurasi lokal bawaan)

## Instalasi dan Menjalankan Secara Lokal

Jalankan perintah berikut dari folder repository:

```bash
composer run setup
```

Perintah setup menginstal dependency PHP dan JavaScript, membuat `.env` jika belum ada, membuat application key, menjalankan migration, dan membangun asset frontend. Jika ingin menyiapkan project secara manual:

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

Di Linux/macOS, gunakan `cp .env.example .env` sebagai pengganti perintah `copy`.

Jalankan aplikasi:

```bash
composer run dev
```

Buka `http://localhost:8000`. Perintah tersebut menjalankan server Laravel, queue listener, dan Vite. Untuk menjalankan server saja, gunakan `php artisan serve`; asset frontend tetap perlu dijalankan melalui `npm run dev` atau dibuat dengan `npm run build`.

## Membuat Akun Pencari Kerja

1. Buka `/register`.
2. Isi username yang unik. Username minimal 3 karakter dan hanya boleh berisi huruf, angka, tanda hubung, atau garis bawah.
3. Buat password minimal 8 karakter, lalu isi konfirmasi password dengan nilai yang sama.
4. Masukkan tanggal lahir. Usia yang diterima saat pendaftaran adalah 13 sampai 100 tahun.
5. Klik **Daftar**. Akun akan dibuat dan Anda langsung masuk ke website.

Untuk login berikutnya, buka `/login`, masukkan username dan password, lalu klik **Masuk**. Pendaftaran tidak meminta alamat email; sistem membuat alamat internal untuk akun. Saat melamar, pencari kerja tetap diminta mengisi email kontak yang dapat digunakan perusahaan.

## Cara Melamar Pekerjaan

1. Cari lowongan melalui beranda atau halaman `/jobs`, lalu buka detail lowongan.
2. Masuk atau buat akun jika belum login.
3. Buka formulir lamaran untuk lowongan tersebut.
4. Isi nama lengkap, tanggal lahir, pendidikan terakhir (SMA/SMK, D1/D3, atau S1), serta email kontak.
5. Unggah CV/surat lamaran berformat PDF, DOC, atau DOCX, maksimal 10 MB.
6. Jika perlu, unggah maksimal tiga dokumen pendukung dengan format dan batas ukuran yang sama.
7. Klik **Kirim Lamaran**. Jika berhasil, website menampilkan notifikasi bahwa lamaran telah dikirim.

Status lamaran dimulai sebagai **pending**. Admin perusahaan dapat memperbaruinya menjadi **reviewed** (sudah ditinjau) atau **rejected** (ditolak), dan dapat menambahkan catatan peninjauan.

## Mengajukan Perusahaan

Pengajuan perusahaan dapat dilakukan oleh pengguna yang sudah memiliki akun:

1. Login, lalu buka `/profile/companies`.
2. Pilih opsi untuk menambahkan/mengajukan perusahaan.
3. Isi nama perusahaan, slug unik, wilayah, nama pemilik, jumlah outlet, dan nama badan usaha jika ada.
4. Unggah dokumen legalitas berformat PDF/JPG/PNG maksimal 10 MB. Logo bersifat opsional, berformat JPG/PNG/WEBP, maksimal 2 MB.
5. Kirim pengajuan. Status awal perusahaan adalah **pending**.
6. Pantau status dari `/profile/companies`. Jika ditolak, buka detail perusahaan untuk melihat alasan penolakan, kemudian unggah dokumen pengganti untuk mengajukan ulang.

Perusahaan yang menunggu verifikasi atau ditolak belum dapat menampilkan lowongan ke publik. Pengguna menjadi admin perusahaan setelah superadmin menyetujui pengajuan perusahaan.

## Panel Admin Perusahaan

Panel admin perusahaan hanya dapat diakses akun dengan role `company_admin`. Setelah login, akun tersebut diarahkan ke `/admin`.

Fitur yang tersedia:

- **Dashboard**: ringkasan lowongan dan lamaran dari perusahaan terverifikasi milik akun.
- **Lowongan** (`/admin/vacancies`): membuat, melihat daftar, mengubah, dan mengarsipkan lowongan. Lowongan dapat disimpan sebagai draft atau dipublikasikan.
- **Lamaran** (`/admin/applications`): melihat lamaran yang masuk ke lowongan perusahaan sendiri, melihat detail dan dokumen pelamar, serta memperbarui status menjadi ditinjau atau ditolak dengan catatan opsional.

Admin perusahaan hanya dapat mengelola data perusahaan miliknya. Admin perusahaan **tidak** menyetujui pengajuan perusahaan; keputusan verifikasi hanya tersedia untuk superadmin.

## Panel Superadmin

Superadmin memiliki akses ke seluruh data operasional dan diarahkan ke `/superadmin` setelah login.

Fitur panel:

- **Dashboard**: ringkasan jumlah lowongan, perusahaan, pengajuan yang menunggu, tips karier, lamaran, dan pengguna; juga menampilkan lowongan terbaru.
- **Verifikasi perusahaan** (`/superadmin/verifications`): memfilter pengajuan berdasarkan status, memeriksa detail dan dokumen legalitas, lalu menyetujui atau menolak pengajuan. Alasan penolakan wajib diisi. Saat perusahaan disetujui, pemiliknya otomatis mendapat role admin perusahaan; saat pengajuan ditolak, role diperbarui berdasarkan apakah pemilik masih memiliki perusahaan lain yang terverifikasi.
- **Perusahaan** (`/superadmin/companies`): melihat seluruh perusahaan dan statusnya.
- **Pengguna** (`/superadmin/users`): melihat daftar pengguna, role, dan jumlah perusahaan yang dimiliki. Halaman yang tersedia saat ini adalah daftar baca-saja.
- **Lowongan** (`/superadmin/vacancies`): membuat, mengubah, dan mengarsipkan lowongan untuk perusahaan. Lowongan hanya dapat tampil kepada publik jika perusahaan terverifikasi.
- **Lamaran** (`/superadmin/applications`): melihat dan meninjau lamaran dari seluruh perusahaan, termasuk dokumen pelamar.
- **Tips karier** (`/superadmin/career-tips`): membuat, mengubah, mengarsipkan, dan mengatur status publikasi tips karier.

Role dibatasi oleh middleware: akun biasa tidak dapat membuka panel admin, admin perusahaan tidak dapat membuka panel superadmin, dan masing-masing admin perusahaan hanya melihat lamaran serta lowongan milik perusahaannya.

## Menyiapkan Akun Superadmin

Tidak ada password superadmin bawaan yang aman untuk dipakai bersama. Untuk membuat atau memperbarui akun superadmin lokal:

1. Tambahkan password rahasia pilihan Anda ke file `.env`:

   ```env
   SUPERADMIN_PASSWORD=password-yang-kuat-dan-rahasia
   ```

2. Jalankan seeder superadmin:

   ```bash
   php artisan db:seed --class=AdminSeeder
   ```

3. Masuk melalui `/login` dengan username `superadmin` dan password yang Anda atur sendiri.

Simpan `SUPERADMIN_PASSWORD` hanya di environment lokal/hosting yang aman. Jangan commit `.env` atau membagikan password ke repository. Seeder ini membuat akun superadmin; akun perusahaan sebaiknya memperoleh role admin melalui alur persetujuan perusahaan.

## Halaman Utama

| URL | Keterangan |
| --- | --- |
| `/` | Beranda |
| `/jobs` | Daftar dan pencarian lowongan |
| `/job/{id}` | Detail lowongan |
| `/job/{id}/apply` | Form lamaran (wajib login) |
| `/companies` | Daftar perusahaan terverifikasi |
| `/companies/{slug}` | Detail perusahaan |
| `/tips` | Tips karier yang dipublikasikan |
| `/register` | Pendaftaran akun |
| `/login` | Login |
| `/profile` | Profil pengguna |
| `/profile/companies` | Daftar dan status perusahaan milik pengguna |
| `/admin` | Dashboard admin perusahaan |
| `/superadmin` | Dashboard superadmin |

## Teknologi dan Struktur Project

- Laravel 13 dan PHP 8.3+
- Blade, Tailwind CSS, dan Vite
- SQLite pada konfigurasi lokal bawaan; database dapat disesuaikan melalui `.env`
- Pest untuk pengujian

Folder penting:

```text
app/Http/Controllers/       Controller halaman, autentikasi, dan panel admin
app/Http/Requests/          Validasi input
app/Models/                 Model pengguna, perusahaan, lowongan, dan lamaran
app/Policies/               Aturan akses data
database/migrations/        Struktur database
database/seeders/           Seeder data dan superadmin
resources/views/            Template Blade
resources/css/              Style frontend
resources/js/               JavaScript frontend
routes/web.php              Daftar route aplikasi
tests/                      Test aplikasi
```

## Database dan Pengujian

Menjalankan migration:

```bash
php artisan migrate
```

Menjalankan test:

```bash
composer run test
```

`php artisan migrate:fresh --seed` akan menghapus seluruh data database sebelum membuat ulang tabel. Gunakan hanya pada lingkungan pengembangan yang datanya boleh dihapus. Jika menjalankan `DatabaseSeeder`, pastikan `SUPERADMIN_PASSWORD` sudah diatur karena seeder tersebut juga membuat akun superadmin.

## Troubleshooting

- **Route belum terbaca**: jalankan `php artisan optimize:clear`, lalu periksa dengan `php artisan route:list`.
- **Asset tidak tampil**: jalankan `npm run dev` selama pengembangan atau `npm run build` untuk membangun asset.
- **Database bermasalah**: periksa konfigurasi database di `.env`, lalu jalankan `php artisan migrate`.
- **Gagal membuat akun superadmin saat seeding**: pastikan `SUPERADMIN_PASSWORD` sudah diatur di `.env`.
