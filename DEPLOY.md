# Panduan Deploy AP Kreasi ke Hosting

## Persyaratan Hosting

| Kebutuhan | Versi Minimum |
|-----------|---------------|
| PHP | 8.3+ |
| Ekstensi PHP | `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo` |
| Web Server | Apache (dengan mod_rewrite) atau Nginx |
| Composer | 2.x |

> Hosting shared seperti **Niagahoster, Hostinger, DomaiNesia** umumnya sudah support PHP 8.3.

---

## Langkah Deploy (Shared Hosting / cPanel)

### 1. Upload File
- Upload seluruh isi folder `reklame-neonbox-fresh/` ke server
- Untuk shared hosting: upload ke folder `public_html` atau subfolder
- **Penting:** Isi folder `public/` harus menjadi document root

### 2. Konfigurasi Document Root
Di cPanel → **Domains** → arahkan domain ke folder `public/` (bukan root project).

Jika tidak bisa mengubah document root, buat file `.htaccess` di root:
```apache
RewriteEngine On
RewriteRule ^(.*)$ public/$1 [L]
```

### 3. Setup .env
```bash
# Copy template dan isi nilainya
cp .env.production.example .env
```

Edit `.env` dan isi:
- `APP_KEY` — generate dengan: `php artisan key:generate --show`
- `APP_URL` — domain Anda, contoh: `https://apkreasi.com`
- `APP_DEBUG=false` ← **WAJIB false di production**
- `APP_ENV=production`

### 4. Install Dependencies
```bash
composer install --optimize-autoloader --no-dev
```

### 5. Jalankan Perintah Optimasi
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. Set Permission Folder
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### 7. Buat Symlink Storage (jika diperlukan)
```bash
php artisan storage:link
```

---

## Deploy ke VPS (Ubuntu/Nginx)

### Nginx Config
```nginx
server {
    listen 80;
    server_name apkreasi.com www.apkreasi.com;
    root /var/www/apkreasi/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## Checklist Sebelum Go-Live

- [ ] `APP_DEBUG=false` di `.env`
- [ ] `APP_ENV=production` di `.env`
- [ ] `APP_URL` diisi domain yang benar
- [ ] `SESSION_DRIVER=file` (bukan database)
- [ ] `CACHE_STORE=file` (bukan database)
- [ ] `composer install --no-dev` sudah dijalankan
- [ ] `php artisan config:cache` sudah dijalankan
- [ ] `php artisan route:cache` sudah dijalankan
- [ ] `php artisan view:cache` sudah dijalankan
- [ ] Folder `storage/` dan `bootstrap/cache/` writable (755)
- [ ] File `.env` **tidak** ter-upload ke Git/repo publik
- [ ] SSL/HTTPS sudah aktif di domain

---

## Catatan Penting

Karena ini adalah **UI-only** (tidak ada database, tidak ada login asli):
- Tidak perlu `php artisan migrate`
- Tidak perlu setup database MySQL
- SQLite default sudah cukup (hanya untuk session jika diperlukan)
- Semua data adalah dummy/hardcoded di Blade views
