# 🧪 Pengujian Sistem

Sistem SPK Security telah melalui serangkaian pengujian fungsional dan metodologis untuk menjamin akurasi dan reliabilitas operasional.

## Matriks Pengujian Black-Box

| No | Modul | Skenario Uji | Hasil Harapan | Status |
| :---: | :--- | :--- | :--- | :---: |
| 1 | **Autentikasi** | Login dengan user terdaftar | Admin masuk ke Dashboard | ✅ Berhasil |
| 2 | **Periode** | Membuat periode seleksi baru | Data tersimpan dengan status aktif | ✅ Berhasil |
| 3 | **Kriteria** | Input kriteria benefit & cost | Kriteria terdaftar dengan tipe benar | ✅ Berhasil |
| 4 | **AHP Matrix** | Perbandingan berpasangan | CR terhitung secara otomatis | ✅ Berhasil |
| 5 | **Consistency** | Input nilai tidak konsisten | Muncul peringatan (CR > 0.1) | ✅ Berhasil |
| 6 | **Kandidat** | Input data kandidat massal | Data tersimpan & terikat periode | ✅ Berhasil |
| 7 | **Evaluasi** | Input nilai performa kandidat | Matriks keputusan terisi lengkap | ✅ Berhasil |
| 8 | **WP Ranking** | Kalkulasi ranking otomatis | Kandidat diurutkan berdasarkan V | ✅ Berhasil |
| 9 | **Report** | Ekspor laporan ke PDF | File PDF terunduh dengan benar | ✅ Berhasil |
| 10 | **Responsive** | Akses sistem via mobile | Layout menyesuaikan layar (Mobile) | ✅ Berhasil |

---

## Verifikasi Metodologi (AHP + WP)

Uji metodologi dilakukan dengan membandingkan hasil kalkulasi manual (Excel) dengan hasil sistem:
- **Hasil**: Sistem memberikan presisi hingga 6 digit di belakang koma.
- **Kesimpulan**: Algoritma AHP dan WP telah diimplementasikan dengan akurasi 100%.

> [!TIP]
> Pengujian dilakukan pada environment PHP 8.1 dengan database MySQL 8.0. Seluruh unit test fitur utama telah lulus 100%.
