# SIAKAD Al-Ikhlas

SIAKAD Al-Ikhlas adalah aplikasi sistem informasi akademik berbasis Laravel untuk mengelola data madrasah, santri, guru, orang tua, jadwal pelajaran, absensi, mata pelajaran, nilai, rapot, user, role, permission, dan log aktivitas.

## Teknologi

- PHP `^7.3|^8.0`
- Laravel `8.x`
- MySQL/MariaDB
- Laravel UI
- Bootstrap 4
- Laravel Mix
- Spatie Permission
- Spatie Activity Log
- DomPDF

## Fitur Utama

- Login berbasis `username`.
- Manajemen user administrator, guru, dan orang tua.
- Manajemen role dan permission.
- Manajemen kelas, santri, mata pelajaran, jadwal, absensi, nilai, dan rapot.
- Dashboard berbeda untuk administrator, guru, dan orang tua.
- Orang tua dapat melihat biodata anak, jadwal, mata pelajaran, absensi, dan rapot.
- Satu akun orang tua dapat memiliki lebih dari satu anak.
- Satu santri hanya dapat terhubung ke satu akun orang tua.
- Akses rapot orang tua dibatasi hanya untuk santri miliknya.

## Update Multi-Anak Orang Tua

Update terbaru memindahkan relasi orang tua-anak dari `userdetail.santri_id` ke `santri.orangtua_id`.

Perubahan utama:

- Tabel `santri` memiliki kolom baru `orangtua_id`.
- Kolom lama `userdetail.santri_id` dihapus setelah data lama dipindahkan.
- Model `User` memiliki relasi `anak()`.
- Model `Santri` memiliki relasi `orangtua()`.
- Form tambah/edit orang tua memakai multi-select santri.
- Dashboard, Rapot, Jadwal, dan Mapel orang tua menampilkan semua anak yang terhubung.

## Requirement Server

Pastikan server memiliki:

- PHP 7.3 atau 8.x
- Composer
- MySQL/MariaDB
- Extension PHP umum Laravel: `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`
- Node.js dan npm jika ingin build asset dari source

## Instalasi Lokal

Clone repository:

```bash
git clone https://github.com/adiwarsa/siakad-alikhlas.git
cd siakad-alikhlas
```

Install dependency PHP:

```bash
composer install
```

Install dependency frontend:

```bash
npm install
```

Salin environment:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

Atur database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siakad-alikhlas
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi dan seeder:

```bash
php artisan migrate --seed
```

Build asset:

```bash
npm run dev
```

Jalankan server lokal:

```bash
php artisan serve
```

Akses aplikasi:

```text
http://127.0.0.1:8000
```

## Update Database Existing

Untuk database yang sudah berjalan, gunakan:

```bash
php artisan migrate
php artisan view:clear
php artisan cache:clear
php artisan config:clear
```

Jangan jalankan `php artisan migrate:fresh` di production karena akan menghapus semua tabel dan data.

Migration update multi-anak akan:

- Menambahkan `orangtua_id` ke tabel `santri`.
- Menyalin data lama dari `userdetail.santri_id` ke `santri.orangtua_id`.
- Menghapus kolom lama `userdetail.santri_id`.

## Deploy ke cPanel

Upload/replace folder berikut jika melakukan update manual:

- `app/Http/Controllers`
- `app/Models`
- `database/migrations`
- `database/seeders`
- `resources/views`

Setelah upload, jalankan:

```bash
php artisan migrate
php artisan view:clear
php artisan cache:clear
php artisan config:clear
```

Pastikan permission folder berikut dapat ditulis oleh aplikasi:

- `storage`
- `bootstrap/cache`

## Akun Seeder

Login memakai field `username`, bukan email.

Jika database dibuat ulang memakai seeder terbaru, password default semua akun di bawah adalah:

```text
password
```

Daftar username:

- `admin` - administrator.
- `jufri` - guru/wali kelas.
- `orang tua` - orang tua dengan contoh multi-anak.
- `bapaktap` - orang tua dengan satu anak.
- `azrul` - guru.

Untuk melihat update multi-anak, login sebagai:

```text
username: orang tua
password: password
```

Data contoh:

- User `orang tua` memiliki santri `ALFIN DIANUL HAKKIs` dan `Tuturu`.
- User `bapaktap` memiliki santri `Tap`.

Catatan: jika database production tidak di-reset atau tidak memakai seeder terbaru, password mengikuti data production yang sudah ada.

## Struktur Penting

```text
app/Http/Controllers     Controller aplikasi
app/Models               Model Eloquent
database/migrations      Struktur tabel database
database/seeders         Data awal aplikasi
resources/views          Blade template
routes/web.php           Route web aplikasi
public                   Entry point dan asset public
storage                  Cache, log, dan file runtime
```

## Perintah Berguna

Membersihkan cache:

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

Melihat route:

```bash
php artisan route:list
```

Menjalankan test:

```bash
php artisan test
```

Build asset production:

```bash
npm run prod
```

## Catatan Test

Test bawaan Laravel pada `tests/Feature/ExampleTest.php` mungkin gagal karena route `/` memang redirect ke `/dashboard` dengan status `302`, sedangkan test default mengharapkan `200`.

## Lisensi

Project ini mengikuti lisensi Laravel bawaan, yaitu MIT, kecuali ada ketentuan lain dari pemilik repository.
