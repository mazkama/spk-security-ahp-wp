# 🏆 Hasil & Pelaporan

Modul ini adalah *output* utama dari Sistem SPK Security, tempat di mana keputusan akhir diambil berdasarkan data yang telah diproses secara matematis.

## 📊 Interpretasi Hasil Ranking
Hasil perangkingan ditampilkan dalam urutan menurun (descending) berdasarkan **Nilai Preferensi (V)**:
- **Nilai V Tertinggi**: Kandidat dengan kecocokan terbaik terhadap bobot kriteria prioritas.
- **Nilai V Terendah**: Kandidat dengan performa paling tidak sesuai dengan parameter yang ditentukan.

## 🛡️ Keamanan Data Hasil
1. **Status Selesai**: Ketika sebuah periode seleksi ditandai sebagai `selesai`, data penilaian dan ranking akan dikunci secara permanen untuk mencegah perubahan pasca-keputusan.
2. **Audit Log**: Setiap perubahan pada parameter kriteria sebelum penguncian akan dicatat dalam sistem log untuk keperluan audit internal.

## 📄 Laporan Ekspor (PDF)
Fitur ekspor laporan menghasilkan dokumen PDF profesional yang mencakup:
- **Ringkasan Periode**: Nama gelombang, tanggal, dan status.
- **Tabel Bobot Kriteria**: Menunjukkan transparansi pembobotan hasil AHP.
- **Tabel Skor Kandidat**: Matriks keputusan awal.
- **Tabel Ranking Akhir**: Daftar urutan kandidat dengan nilai V masing-masing.

---

> [!TIP]
> Gunakan laporan PDF ini sebagai lampiran resmi dalam berita acara penerimaan petugas keamanan untuk menjamin akuntabilitas di hadapan manajemen atau auditor.
