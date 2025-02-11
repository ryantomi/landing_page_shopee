Panduan Instalasi dan Konfigurasi
Deskripsi Singkat
Repository ini berisi skrip SQL dan file PHP untuk mengatur dashboard dan login, serta menghitung jumlah pengunjung.

Instalasi
1. Mengimpor File SQL ke MySQL

Menggunakan phpMyAdmin:
Buka phpMyAdmin.
Buat database baru (jika diperlukan).
Pilih database login.sql dan dashboard_db.sql
Klik tab "Import".
Pilih file dashboard_db.sql lalu klik "Go".

3. Mengatur Koneksi Database
Ubah konfigurasi koneksi database pada file api.php dan login/api.php sesuai dengan kredensial MySQL Anda.

4. Mereset Visitor Counter
Untuk mereset visitor counter yang disimpan dalam file visitor_count.txt

5. Penggunaan
Setelah instalasi selesai, Anda dapat mengakses dashboard dan halaman login sesuai dengan implementasi aplikasi Anda.
Login : user : admmin & pass : admin

Kontribusi
Pull request sangat diterima. Untuk perubahan besar, silakan buka issue terlebih dahulu untuk mendiskusikan apa yang ingin Anda ubah.
