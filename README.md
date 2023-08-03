Database : 10.10.2-MariaDB
PHP : PHP Version 8.1.12
Framework : Laravel Framework 10.16.1

### PANDUAN INSTALL APLIKASI
```
git clone https://github.com/afanokta/nickel-app.git
composer install
npm install
npm run build
php artisan db:migrate
php artisan db:seed
php artisan db:seed
```
### Attachment
1.[ Activity Diagram](https://github.com/afanokta/nickel-app/blob/e05d2dccc03a53e885cdf4ae5530b3a5cc218dac/Activity%20Diagram.png)
![Physical Data Model](/Activity%20Diagram.png)
1. [Physical Data Model](https://github.com/afanokta/nickel-app/blob/e05d2dccc03a53e885cdf4ae5530b3a5cc218dac/Physical%20Data%20Model.png)
![Physical Data Model](/Physical%20Data%20Model.png)


### Email & role
semua password akun adalah "password" (tanpa petik)
1. anto@gmail.com -> pegawai
2. admin@gmail.com -> admin
3. bambang@gmail.com -> direktur
4. sari@gmail.com  -> supervisor
5. tono@gmail.com -> direktur-utama
6. gito@gmail.com -> pegawai
7. sutanto@gmail.com -> manajer

### Panduan Aplikasi
A. Untuk pemesan
1. Login ke akun yang akan digunakan untuk memesan kendaraan
2. Ke menu pesan kendaraan
3. Isi data pemesanan
4. Tunggu hingga pemesanan diproses admin
5. Setelah pemesanan dinyatakan disetujui, isi konsumsi BBM do menu pesan kendaraan
6. Pemesanan kendaraan selesai

B. Untuk Admin
1. Login ke akun admin
2. Proses pemesanan dengan menginputkan data driver dan penyetuju di menu pesan kedaraan -> edit
3. Dashboard admin berisi informasi penggunaan kendaraan

C. Untuk Penyetuju
1. Login ke akun penyetuju
2. Buka menu persetujuan dan lakukan persetujuan
