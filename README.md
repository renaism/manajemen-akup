# Manajemen Akup
Sistem manajemen Rumah Makan Bakso Akup cabang Banjaran. Aplikasi ini menggunakan framework [Laravel](https://laravel.com/). Manajemen Akup merupakan tugas besar dari mata kuliah APPL dan IMPAL. **Sangat disarankan untuk membaca SKPL dan DPPL terlebih dahulu untuk dapat memahami fungsi dari aplikasi ini**. SKPL dan DPPL bisa didapatkan [di sini](https://drive.google.com/drive/folders/1xzuX0f45B-VJ0At7I0y6f2OIdEBuHvpO?usp=sharing).

*Salam profit dari ketua kami, Bayu Arifat Firdaus.*

# Progress Mingguan
## 1. Screenshot Aplikasi
<table>
<tr>
<td><img src="docs/screenshots/index_bahan.png" alt="Kelola Bahan" height="250"></td>
<td><img src="docs/screenshots/inser_bahan_01.png" alt="Insert Bahan" height="250"></td>
</tr>
<tr>
<td><small>Kelola Bahan</small></td>
<td><small>Insert Bahan</small></td>
</tr>
</table>

## 2. Equivalence Partition Testing
### A. Class Bahan
Pada proses insert data bahan, terdapat data *field* berupa stok yang berupa angka dan mempunyai range dari 0 sampai 999,999.99 (desimal). Berdasarkan kriteria tersebut, partisi dari testing yang dilakukan adalah:

**Stok**:
* < 0 : Ditolak sistem (**Invalid**) 
* 0 - 999,999.99 : Diterima sistem (**Valid**) 
* \> 999,999.99 : Ditolak sistem (**Invalid**)

## B. Class Menu
Pada proses insert menu, terdapat data *field* berupa harga yang merupakan angka dan mempunyai range dari 0 sampai 99,999,999 (integer). Berdasarkan kriteria tersebut, partisi dari testing yang dilakukan adalah:

**Harga**:
* < 0 : Ditolak sistem (**Invalid**) 
* 0 - 99,999,999 : Diterima sistem (**Valid**) 
* \> 99,999,999 : Ditolak sistem (**Invalid**)

## 3. Penerapan MVC di Laravel
* Model dari aplikasi ada di folder [`app`](app/) (Contoh: [`Bahan.php`](app/Bahan.php))
* View dari aplikasi ada di foler [`resources/views`](resources/views/) (Contoh: [`create.blade.php`](resources/views/bahan/create.blade.php))
* Controller dari aplikasi ada di folder [`app/Http/Controllers`](app/Http/Controllers/) (Contoh: [`BahanController.php`](app/Http/Controllers/BahanController.php))

# Project Setup

Di sini gua bakal ngejelasin gimana caranya temen-temen ngejalanin *project* ini di komputer/laptop masing-masing. Oke, pertama temen-temen install dulu semua aplikasi ini secara berurutan:
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
5. ???
6. *Profit!!!*

## D. Panduan Git
Capek ah udahan dulu. Udah pada jago juga ini.
