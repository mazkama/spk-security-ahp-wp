# Struktur Database

| Tabel                | Deskripsi                                      |
|----------------------|------------------------------------------------|
| periode              | Data periode seleksi                           |
| kriteria             | Daftar kriteria seleksi                        |
| perbandingan_kriteria| Pairwise comparison antar kriteria (AHP)       |
| bobot_kriteria       | Bobot hasil AHP                                |
| kandidat             | Data kandidat                                  |
| penilaian            | Nilai penilaian kandidat per kriteria          |
| hasil_wp             | Hasil perhitungan WP dan ranking               |

**Relasi:**
- Semua entitas terikat ke satu periode.
- Penilaian menghubungkan kandidat dan kriteria.
- Bobot_kriteria mengacu ke kriteria dan periode.
