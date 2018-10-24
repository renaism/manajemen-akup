# Manajemen Akup
Sistem manajemen Rumah Makan Bakso Akup cabang Banjaran.

## Validasi Data (Tugas minggu ini)
### 1. Existence Check

### 2. Data-type Check

### 3. Domain Check

### 4. Combination Check

### 5. Self-checking digit

### 6. Format check

Aplikasi ini menggunakan framework [Laravel](https://laravel.com/).

Manajemen Akup merupakan tugas besar dari mata kuliah APPL dan IMPAL. **Sangat disarankan untuk membaca SKPL dan DPPL terlebih dahulu untuk dapat memahami fungsi dari aplikasi ini**. SKPL dan DPPL bisa didapatkan [di sini](https://drive.google.com/drive/folders/1xzuX0f45B-VJ0At7I0y6f2OIdEBuHvpO?usp=sharing).

## Implementasi P-Spec
Implementasi *program specification* (P-Spec) dalam bahasa Pascal dapat dilihat di dalam folder [pspec-implementations](https://github.com/renaism/manajemen-akup/tree/master/docs/pspec-implementation). Adapun P-Spec yang diimplementasikan yaitu:
1. Insert Bahan
2. Insert Menu
3. Input Pembelian
4. Input Transaksi

## Mockup Aplikasi
*Mockup* dari aplikasi ini dapat dilihat di folder [mockups](https://github.com/renaism/manajemen-akup/tree/master/docs/mockups).

## Database Aplikasi
Sintaks SQL yang digunakan untuk membangun *table-table* yang akan digunakan di *database* aplikasi ini dapat dilihat di folder [database](https://github.com/renaism/manajemen-akup/tree/master/docs/database).

*Salam profit dari ketua kami, Bayu Arifat Firdaus.*

# Project Setup

Hai *guys*!!! B-b-balik lagi sama gua. Di sini gua bakal ngejelasin gimana caranya temen-temen ngejalanin *project* ini di komputer/laptop masing-masing. Oke, pertama temen-temen install dulu semua aplikasi ini secara berurutan:
1. [Git](https://git-scm.com/downloads)
2. [XAMPP](https://www.apachefriends.org/)
3. [Composer](https://getcomposer.org/download/) (Pilih yang Windows Installer)

Untuk lebih jelasnya, video tutorial *step by step* instalasinya akan dibuat oleh *YouTuber* kebanggan qta (sekaligus *leader* juga) yaitu [Bayu Arifat](https://www.youtube.com/channel/UC71TKqN-dRYpudR2Iv4tuCA/). Pantengin aja terus channelnya hehe jangan lupa subscribe dan klik belnya.

## A. Clone Repository
1. Buka suatu folder di File Explorer (misal: D:\GitHub)
2. Klik kanan, pilih Git Bash Here
3. Di terminal masukin *command* ini (kalo mau copas harus klik kanan->Paste):
```
$ git clone https://github.com/renaism/manajemen-akup.git
```
4. Tunggu aja sampe selesai

## B. Setup Database MySQL
1. Buka XAMPP
2. Jalanin Apache sama MySQL
3. Buka http://localhost/phpmyadmin/ di browser
4. Di bagian atas, klik tab Databases
5. Create database dengan nama "manajemen-akup"

## C. Setup Laravel dan Dependency
1. Masih di terminal yang sama dari step A, `cd` ke folder yang baru dibuat:
```
$ cd manajemen-akup
```
2. Setup laravel dengan masukin *command* ini satu-satu perbaris:
```
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate
``` 
3. Jalanin *development server* laravel:
```
$ php artisan serve
```
4. Coba test buka http://127.0.0.1:8000/ di browser

## D. Panduan Git
Capek ah udahan dulu. Udah pada jago juga ini.