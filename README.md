# Welcome Guys

Selamat Datang di Projek PROGNET Kelompok 21

Disini kita membuat sebuah aplikasi penginputan KRS nih guys

Fitur yang belum :

- Nilai KHS
- View Berdasarkan Tahun Ajaranddaw

Cara Jalanin

```code
composer install

npm i

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```
