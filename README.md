# PANEL DATA – DIGITAL TOPUP PANEL (DIGIFLAZZ INTEGRATION)

Panel Data adalah aplikasi panel top-up & voucher berbasis web yang terintegrasi dengan API Digiflazz.  
Didesain khusus untuk reseller, agen, dan developer yang ingin membuat layanan top-up otomatis dengan update status real-time melalui callback.

Project ini dibuat menggunakan **PHP Native** dengan struktur **MVC sederhana** agar mudah dipelajari, dimodifikasi, dan dikembangkan sesuai kebutuhan bisnis.

---

## ✨ FITUR UTAMA

- 🔐 Login User + Session
- 🛍️ Order otomasi ke Digiflazz
- 📦 Detail dan status transaksi
- 🔄 Auto update via callback real-time
- 📜 Log callback (debug & audit)
- ⚙️ Setting API Key langsung di panel
- 💳 Input API Key tersimpan di database (tidak hardcode)
- 💡 Produk mudah ditambah
- 🎨 UI responsive (Bootstrap)
- 🧱 Struktur kode rapi & modular

---

## 🏗 STRUKTUR PROJECT

backend/
├─ public/
│ ├─ api.php
│ └─ callback/
│ └─ digiflazz.php
├─ config/
│ ├─ app.php
│ └─ db.php
├─ controllers/
├─ lib/
├─ models/
└─ database/
├─ migrations.sql
├─ panel_data.sql
└─ seed.sql

frontend/
├─ assets/
│ ├─ css/
│ └─ js/
├─ layout/
└─ views/



---

## 🛠 TEKNOLOGI

- PHP Native (tanpa framework)
- MySQL / MariaDB
- HTML5
- CSS (Bootstrap 5)
- JavaScript (Fetch API)
- MVC 

---

## 🚀 CARA INSTALL

### 1️⃣ Clone Repo / Download ZIP

Clone melalui Git:

```bash
git clone https://github.com/dbnewgrup-afk/Panel-Data.git
