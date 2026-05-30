# SIAKAD Al-Ikhlas

SIAKAD Al-Ikhlas adalah aplikasi sistem informasi akademik berbasis Laravel untuk mengelola data akademik madrasah seperti user, role, santri, guru, orang tua, kelas, mata pelajaran, jadwal, absensi, nilai, dan rapot.

## Dependencies

### Backend

- PHP `^7.3|^8.0`
- Laravel Framework `^8.12`
- MySQL atau MariaDB
- Composer
- Laravel UI `^3.0`
- Spatie Laravel Permission `^3.18`
- Spatie Laravel Activitylog `^4.7`
- Laravel DomPDF
- Guzzle HTTP `^7.0.1`

### Frontend

- Node.js
- npm
- Laravel Mix `^5.0.1`
- Bootstrap `^4.0.0`
- jQuery `^3.5`
- Sass

### PHP Extensions

Pastikan extension PHP berikut aktif di server:

- `bcmath`
- `ctype`
- `fileinfo`
- `json`
- `mbstring`
- `openssl`
- `pdo`
- `pdo_mysql`
- `tokenizer`
- `xml`

## Installation

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

Copy file environment:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Atur koneksi database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siakad-alikhlas
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migration dan seeder:

```bash
php artisan migrate --seed
```

Build asset development:

```bash
npm run dev
```

Jalankan aplikasi:

```bash
php artisan serve
```

Buka aplikasi di browser:

```text
http://127.0.0.1:8000
```

## Production Build

Untuk build asset production:

```bash
npm run prod
```

Untuk membersihkan cache Laravel:

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Useful Commands

Melihat daftar route:

```bash
php artisan route:list
```

Menjalankan test:

```bash
php artisan test
```

Menjalankan migration:

```bash
php artisan migrate
```

Menjalankan seeder:

```bash
php artisan db:seed
```

## Storage Permission

Pastikan folder berikut writable oleh web server:

```text
storage
bootstrap/cache
```
