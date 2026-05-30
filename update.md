# Update Orang Tua Multi-Anak

Dokumen ini berisi daftar folder/file yang berubah untuk update cPanel, serta akun yang bisa dipakai untuk mengecek fitur orang tua punya lebih dari satu anak.

## Update Terakhir

- Dashboard orang tua sekarang menampilkan ringkasan total anak, jadwal aktif, kelas anak, dan wali kelas.
- Card biodata anak di dashboard orang tua bisa diklik untuk membuka detail lengkap santri.
- Modal detail biodata anak sudah diperbaiki agar backdrop tidak menutupi halaman atau tertinggal setelah modal ditutup.

## Folder Yang Berubah

Upload/replace folder berikut ke cPanel:

- `app/Http/Controllers`
- `app/Models`
- `database/migrations`
- `database/seeders`
- `resources/views`

Kalau ingin upload file satu-satu, file yang berubah adalah:

- `app/Http/Controllers/DashboardController.php`
- `app/Http/Controllers/JadwalController.php`
- `app/Http/Controllers/MataPelajaranController.php`
- `app/Http/Controllers/PDFController.php`
- `app/Http/Controllers/RapotController.php`
- `app/Http/Controllers/UserController.php`
- `app/Models/Santri.php`
- `app/Models/User.php`
- `app/Models/UserDetail.php`
- `database/migrations/2023_10_06_000003_create_santri_table.php`
- `database/migrations/2023_10_06_000005_create_userdetail_table.php`
- `database/migrations/2026_05_30_000001_move_orangtua_relation_to_santri_table.php`
- `database/migrations/2026_05_30_000002_add_available_santri_for_parent_test.php`
- `database/seeders/AbsensiSantriSeeder.php`
- `database/seeders/JadwalSeeder.php`
- `database/seeders/KelasSeeder.php`
- `database/seeders/MataPelajaranSeeder.php`
- `database/seeders/NilaiRapotSeeder.php`
- `database/seeders/NilaiSeeder.php`
- `database/seeders/RapotSeeder.php`
- `database/seeders/SantriSeeder.php`
- `database/seeders/UserDetailSeeder.php`
- `database/seeders/UserSeeder.php`
- `resources/views/dashboardortu.blade.php`
- `resources/views/orangtua/jadwal/index.blade.php`
- `resources/views/orangtua/mapel/index.blade.php`
- `resources/views/rapot/ortu/listsantri.blade.php`
- `resources/views/users/createortu.blade.php`
- `resources/views/users/editortu.blade.php`

Untuk update UI dashboard orang tua terbaru saja, minimal replace:

- `resources/views/dashboardortu.blade.php`
- `update.md`

## Perintah Setelah Upload

Jangan jalankan `migrate:fresh` di cPanel/production karena itu akan menghapus semua tabel dan data.

Jalankan ini setelah file di-upload:

```bash
php artisan migrate
php artisan view:clear
php artisan cache:clear
php artisan config:clear
```

Migration baru akan:

- Menambahkan kolom `orangtua_id` pada tabel `santri`.
- Memindahkan relasi lama dari `userdetail.santri_id` ke `santri.orangtua_id`.
- Menghapus kolom lama `userdetail.santri_id`.
- Menambahkan beberapa santri kosong untuk test tambah orang tua multi-anak pada database existing.

## Akun Untuk Cek Update

Login memakai field `username`, bukan email.

Jika database dibuat ulang memakai seeder terbaru, password semua akun di bawah adalah:

```text
password
```

Daftar username:

- `admin` - administrator.
- `jufri` - guru/wali kelas.
- `orangtua` - orang tua dengan contoh multi-anak, santri `ALFIN DIANUL HAKKIs` dan `Tuturu`.
- `bapaktap` - orang tua santri `Tap`.
- `azrul` - guru.

Untuk melihat update multi-anak, login sebagai:

```text
username: orangtua
password: password
```

Lalu cek menu:

- Dashboard: tampil lebih dari satu biodata anak, dan card biodata bisa diklik untuk melihat detail.
- Rapot: tampil list semua anak milik orang tua.
- Jadwal: ada kolom santri agar jelas jadwal milik anak siapa.
- Mapel: ada kolom santri agar jelas mapel milik anak siapa.

Untuk test membuat orang tua baru dari admin, buka menu tambah orang tua lalu pilih lebih dari satu santri yang belum punya orang tua. Data seeder/migration menyediakan santri kosong berikut:

- `Tarataktum`
- `Nabila Rahma`
- `Rizky Maulana`
- `Siti Aisyah`

Catatan: kalau database production tidak di-reset dan tidak memakai seeder baru, password akun mengikuti data production yang sudah ada.
