<!-- Banner -->
<p align="center">
  <img src="https://github.com/rirriin/dataMahasiswa/blob/2b008ae6b8e46fb57c81d7be2f428a1394ed6cfe/UI%20UX/banner.png" width="100%" alt="dataMahasiswa Banner"/>
</p>

<h1 align="center">🎓 dataMahasiswa</h1>
<p align="center">
  A simple yet powerful student data management system built with <b>PHP</b> and <b>MySQL</b>.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.0+-777BB4?logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/HTML5-Frontend-E34F26?logo=html5&logoColor=white" />
  <img src="https://img.shields.io/badge/CSS3-Design-1572B6?logo=css3&logoColor=white" />
  <img src="https://img.shields.io/badge/JavaScript-Interactive-F7DF1E?logo=javascript&logoColor=black" />
  <img src="https://img.shields.io/badge/License-MIT-green.svg" />
</p>

---

## 📖 Deskripsi

**dataMahasiswa** adalah aplikasi web berbasis **PHP & MySQL** yang digunakan untuk mengelola data mahasiswa secara efisien.  
Aplikasi ini memiliki fitur **login, registrasi, CRUD data mahasiswa, serta visualisasi data dengan Chart.js**.  
Didesain dengan antarmuka **modern dan responsif**, cocok untuk kebutuhan sekolah, kampus, atau proyek pembelajaran web development.

---

## 🚀 Fitur Utama

✅ **Dashboard Interaktif** — Menampilkan statistik mahasiswa secara visual.  
✅ **CRUD Data Mahasiswa** — Tambah, ubah, hapus, dan lihat data mahasiswa dengan mudah.  
✅ **Autentikasi Pengguna** — Login dan registrasi dengan validasi aman.  
✅ **Upload Gambar Mahasiswa** — Simpan foto profil di folder `uploads/img`.  
✅ **Tampilan Modern** — Menggunakan CSS custom dan desain clean.  
✅ **Mengingat Tab Terakhir** — Navigasi tab yang otomatis menyimpan posisi terakhir pengguna.

---

## 🧠 Teknologi yang Digunakan

| Teknologi | Fungsi |
|------------|--------|
| **PHP 8+** | Backend & logic pemrosesan |
| **MySQL** | Database penyimpanan data |
| **HTML5, CSS3, JS** | Frontend dan interaktivitas UI |
| **Chart.js** | Visualisasi data statistik |

---

## ⚙️ Cara Instalasi & Menjalankan Proyek

1. **Clone repository**
   ```bash
   git clone https://github.com/rirriin/dataMahasiswa.git
   ```

2. **Masuk ke folder proyek**
   ```bash
   cd dataMahasiswa
   ```

3. **Import database**
   - Buka **phpMyAdmin**
   - Buat database baru bernama `db_mahasiswa`
   - Import file SQL dari folder `db/`

4. **Jalankan di local server**
   - Letakkan folder di `htdocs` (XAMPP)
   - Akses melalui browser:
     ```
     http://localhost/dataMahasiswa
     ```

---

## 📁 Struktur Folder

```
dataMahasiswa/
│
├── UI UX/                   # Desain & aset visual
├── db/                      # File database SQL
├── uploads/
│   └── img/                 # Folder untuk menyimpan gambar
│       └── icon             # Folder untuk menyimpan icon
│       └── profile          # Folder untuk menyimpan foto mahasiswa
├── config.php               # Konfigurasi aplikasi
├── db.php                   # Koneksi database
├── index.php                # Dashboard utama
├── login.php                # Halaman login
├── login_process.php        # Proses login
├── logout.php               # Logout
├── register.php             # Halaman registrasi
├── register_process.php     # Proses registrasi
├── get_data.php             # Data untuk chart
├── simpan.php               # Simpan data mahasiswa
├── edit.php                 # Edit data mahasiswa
├── delete.php               # Hapus data mahasiswa
├── style.css                # File CSS utama
├── script.js                # Logika JavaScript
└── README.md
```

---

## 📊 Preview Antarmuka

| Dashboard | Data Mahasiswa |
|------------|----------------|
| ![Dashboard](UI%20UX/dashboard.png) | ![Data Mahasiswa](UI%20UX/tables.png) |

---

## 👨‍💻 Pengembang

**Meilian Ririn Anggani**  
💬 *“Koding bukan sekadar logika, tapi juga seni dalam menyelesaikan masalah.”*  

🌐 [GitHub](https://github.com/rirriin)  
📧 meilian237650@student.smkn1kandeman.sch.id

---

## 🪪 Lisensi

Proyek ini dilindungi oleh **[MIT License](LICENSE)**.  
Silakan digunakan dan dimodifikasi untuk kebutuhan pembelajaran atau proyek pribadi.

---

<p align="center">✨ Dibuat dengan semangat dan kopi oleh <b>Meilian Ririn Anggani</b> ✨</p>
