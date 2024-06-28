
# Implementasi website inventaris sekolah data barang SDN SUKABUMI UTARA 01

Proyek ini bertujuan untuk mengembangkan situs web yang ramah pengguna dan menarik untuk SDN Sukabumi Utara 01, sebuah sekolah dasar negeri. Situs web ini akan berfungsi sebagai platform untuk mengelola dan melacak inventaris barang sekolah, menyediakan informasi penting tentang barang-barang yang tersedia, serta memudahkan proses administrasi dan pelaporan.

### Instalasi

-  Pastikan sudah isntall php versi 8.2 yang lebih aman
-  Pastikan sudah insall composer untuk management library pada laravel


## Installation

Install my-project with composer install

```bash
  composer install
```

```bash
  npm install
```


### Edit file env pada database agar sesuai dengan database postgree anda


```bash
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=esteh_db
    DB_USERNAME=postgres
    DB_PASSWORD=root // sesuaikan dengan password postgree kamu
```

### Buat database di postgree

##### Masuk postgree dengan terminal

```bash
    psql -U postgres
```


### Buat database esteh_db

```bash
  create database esteh_db
```

### jalankan migration

```bash
  php artisan migrate
```

### jalankan seeder

```bash
  php artisan migrate:fresh --seed
```

### jalankan aplikasi

```bash
  php artisan serve
```

### buka diterminal yang baru untuk menjalankan frontend vite

```bash
  npm run dev
```

### Buka aplikasi di port 8000    

login dengan email admin@gmail.com password rahasia