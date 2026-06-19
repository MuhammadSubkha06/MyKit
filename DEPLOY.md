# Panduan Upload ke GitHub & Online-kan MyKit

## ⚠️ Penting dulu sebelum apa pun: ganti password database

Password Supabase kamu (`DB_PASSWORD`) sempat tertulis polos di percakapan ini.
Sebelum project di-online-kan, **ganti password database-mu** di dashboard Supabase
(Project Settings → Database → Reset Database Password), lalu update `.env` kamu
dengan password yang baru. Jangan pakai password lama lagi.

---

## 1. Push ke GitHub

File `.env` dan `vendor/` **sudah** masuk daftar `.gitignore`, jadi aman — kredensial
database tidak akan ikut ter-upload selama kamu tidak menghapus baris itu dari `.gitignore`.

Dari folder `MyKit/`, jalankan:

```bash
git init
git add .
git commit -m "Initial commit"
```

Buat repo baru di https://github.com/new (jangan centang "Add README", karena project
kamu sudah punya), lalu:

```bash
git remote add origin https://github.com/USERNAME/NAMA-REPO.git
git branch -M main
git push -u origin main
```

Setelah ini, cek dulu di GitHub web bahwa file `.env` **tidak muncul** di daftar file —
itu tandanya `.gitignore` bekerja dengan benar.

---

## 2. Kenapa tidak bisa pakai GitHub Pages

GitHub Pages hanya menyajikan file statis (HTML/CSS/JS). Project ini butuh **PHP berjalan
di server** + koneksi ke database PostgreSQL (Supabase) — itu tidak bisa dilakukan GitHub
Pages. Kamu perlu hosting yang menjalankan PHP.

---

## 3. Deploy ke Railway (gratis untuk mulai, cocok untuk PHP + auto-deploy dari GitHub)

1. Buat akun di https://railway.app, login pakai akun GitHub kamu.
2. Klik **New Project → Deploy from GitHub repo**, pilih repo MyKit yang baru kamu push.
3. Railway otomatis mendeteksi PHP (lewat `composer.json`) dan akan menjalankan perintah
   di file `Procfile` yang sudah saya siapkan:
   ```
   web: php -S 0.0.0.0:${PORT:-8000} -t public public/index.php
   ```
4. Buka tab **Variables** di project Railway, tambahkan environment variable yang sama
   persis isinya dengan `.env` kamu (gunakan password Supabase yang **baru**, hasil reset
   di langkah 1):
   - `APP_NAME` = MyKit
   - `DB_CONNECTION` = pgsql
   - `DB_HOST` = (host Supabase kamu)
   - `DB_PORT` = 5432
   - `DB_DATABASE` = postgres
   - `DB_USERNAME` = (username Supabase kamu)
   - `DB_PASSWORD` = (password baru)
5. Railway akan otomatis build & deploy. Setelah selesai, klik **Settings → Generate Domain**
   untuk dapat URL publik (`namaapp.up.railway.app`).
6. Setiap kali kamu `git push` ke GitHub lagi, Railway otomatis deploy ulang.

### Alternatif lain (kalau Railway tidak cocok)
- **Render.com** — caranya mirip, juga support Procfile & env vars, ada free tier.
- **Hostinger / 000webhost** — hosting PHP+MySQL klasik, tapi support PostgreSQL terbatas;
  kalau pakai ini, perlu migrasi database dari Supabase (Postgres) ke MySQL, jadi lebih
  ribet untuk project ini. Railway/Render lebih cocok karena native Postgres.

---

## 4. Checklist sebelum online

- [ ] Password Supabase sudah direset
- [ ] `.env` tidak ikut ter-push ke GitHub (cek manual di GitHub web)
- [ ] Environment variables sudah diisi lengkap di dashboard hosting
- [ ] Coba akses domain yang di-generate, test login & register
- [ ] (Opsional) Pasang custom domain kalau punya
