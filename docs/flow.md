# 🔄 System Workflows

Aplikasi SPK Security beroperasi dalam alur modular yang terintegrasi. Setiap tahap dalam sistem dirancang untuk meminimalisir bias manusia melalui validasi data dan algoritma SPK.

## Peta Proses Utama (Flowchart)

```mermaid
graph TD
    Start((Mulai)) --> Auth[Login Admin]
    Auth --> Dashboard{Dashboard Utama}
    
    Dashboard --> Period[1. Inisialisasi Periode]
    Period --> Criterion[2. Kelola Kriteria]
    Criterion --> AHP[3. Pembobotan AHP]
    
    AHP --> Consistency{Konsisten?}
    Consistency -- Tidak --> AHP
    Consistency -- Ya --> Candidate[4. Input Kandidat]
    
    Candidate --> Scoring[5. Input Nilai Performa]
    Scoring --> WP[6. Kalkulasi WP]
    
    WP --> Ranking[7. Laporan Hasil Ranking]
    Ranking --> End((Selesai))

    subgraph "Core SPK Logic"
    AHP
    WP
    end

    style Period fill:#f9f,stroke:#333,stroke-width:2px
    style Candidate fill:#bbf,stroke:#333,stroke-width:2px
    style Ranking fill:#bfb,stroke:#333,stroke-width:2px
```

## Penjelasan Tahap Detail

### 1. Inisialisasi & Kriteria
Admin membuat periode seleksi baru. Data kriteria (seperti Tinggi Badan, Pengalaman, Tes Fisik) ditentukan bersama tipenya:
- **Benefit**: Semakin besar nilai semakin baik.
- **Cost**: Semakin kecil nilai semakin baik.

### 2. Analytical Hierarchy Process (AHP)
Tahap krusial untuk menentukan **Bobot Prioritas**. Admin membandingkan kepentingan antar kriteria (Pairwise Comparison). Sistem menghitung *Consistency Ratio* (CR) secara otomatis untuk menjamin validitas perbandingan.

### 3. Evaluasi & Weighted Product (WP)
Setiap kandidat dinilai pada matriks keputusan. Algoritma WP melakukan normalisasi bobot dan menghitung nilai preferensi (Vektor V).

### 4. Pelaporan
Sistem mengurutkan nilai V dari tertinggi ke terendah sebagai dasar keputusan penerimaan petugas keamanan. Laporan dapat diekspor ke PDF untuk arsip resmi.

---

> [!TIP]
> Anda dapat memantau progres setiap tahap secara real-time melalui bar navigasi pada aplikasi yang akan berubah status saat data prasyarat telah terpenuhi.
