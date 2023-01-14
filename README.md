<h1 align="center">Selamat datang di Sistem E-Presensi Siswa! 👋</h1>

## Apa itu Sistem E-Presensi Siswa?

Web Sistem E-Presensi Siswa yang dibuat oleh <a href="https://github.com/vikarmaulanaarrisyad"> Vikar Maulana Arrisyad </a>. **Sistem E-Presensi Siswa  adalah Sistem untuk para siswa , guru, dan orangtua dapat melihat absensi siswa dan para guru dapat menambahkan nilai siswa dengan muda melalui website**

## Fitur apa saja yang tersedia di Sistem E-Presensi Siswa ?

-   Fitur login dan logout untuk siswa dan guru.
-   Fitur untuk mengelola kelas, seperti menambah, mengedit, dan menghapus kelas.
-   Fitur untuk mengelola siswa, seperti menambah, mengedit, dan menghapus siswa serta menambahkan siswa ke dalam kelas.
-   Fitur untuk mengelola absensi siswa, seperti menandai absensi siswa, melihat riwayat absensi, dan mengedit status absensi.
-   Fitur untuk mengelola laporan absensi, seperti mencetak laporan absensi harian, mingguan, bulanan dan tahunan.
-   Fitur untuk mengelola role user, seperti menambah, mengedit dan menghapus role.
-   Fitur untuk mengelola akun, seperti mengganti password, mengedit profil dan menghapus akun.
-   Fitur untuk mengelola pengingat, seperti menambahkan pengingat absensi dan mengedit pengingat absensi.
-   Fitur untuk mengelola notifikasi, seperti menambahkan, mengedit dan menghapus notifikasi.
-   Fitur untuk mengelola izin siswa, seperti menambah, mengedit dan menghapus izin siswa.
-   Fitur untuk mengelola pengaturan aplikasi, seperti mengubah tema, bahasa dan konfigurasi lainnya.
-   Fitur untuk mengelola backup data, seperti menyimpan dan mengambil backup data aplikasi.
-   Fitur untuk mengelola aktivitas, seperti melihat log aktivitas siswa dan guru.
-   Fitur untuk mengelola perizinan, seperti menambah, mengedit dan menghapus perizinan.
-   Fitur untuk mengelola laporan, seperti menambah, mengedit dan menghapus laporan.

## ramework apa yang digunakan dalam Sistem E-Presensi Siswa ?

**Backend**

-   Framework Laravel version 9

**Frontend**

-   Bootstrap V4

---

## Release Date

**Release date : 14 Januari 2023**

> Sistem E-Presensi Siswa  merupakan project open source yang dibuat oleh Vikar Maulana Arrisyad. dalam menyelesaikan tugas akhir program studi DIII Teknik Komputer. Cukup beri stars di project ini agar memberiku semangat. Terima kasih!

---

## Default Account for testing

**Admin Default Account**

-   email: admin@gmail.com
-   Password: 12345678

---

## Install

1. **Clone Repository**

```bash
https://github.com/vikarmaulanaarrisyad/E-Presensi-Siswa.git
cd E-Presensi-Siswa
composer install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate --seed
```

4. **Jalankan website**

```bash
php artisan serve
```

## Author

-   Facebook : <a href="https://web.facebook.com/viikar.arrisyad.7/"> Vikar Maulana</a>
-   Instagram : <a href="https://www.instagram.com/vikar_maulana_/"> Vikar Maulana</a>

## Contributing

Contributions, issues and feature requests di persilahkan.
Jangan ragu untuk memeriksa halaman masalah jika Anda ingin berkontribusi. **Berhubung Project ini masih saya kembangkan sendiri, namun banyak fitur yang kalian dapat tambahkan silahkan berkontribusi yaa!**

## License

-   Copyright © 2021 Vikar Maulana.
-   **Sistem E-Presensi Siswa  is open-sourced software licensed under the MIT license.**
