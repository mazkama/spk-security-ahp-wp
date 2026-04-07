# 🗄️ Database Architecture

Sistem ini dirancang menggunakan basis data relasional MySQL dengan integritas data yang ketat. Semua data operasional terikat pada entitas **Periode** untuk memastikan pemisahan data antar gelombang seleksi.

## Entity Relationship Diagram (ERD)

```mermaid
erDiagram
    USERS ||--o{ LOGS : performs
    PERIODE ||--o{ KRITERIA : contains
    PERIODE ||--o{ KANDIDAT : evaluates
    PERIODE ||--o{ BOBOT_KRITERIA : stores_result
    PERIODE ||--o{ PERBANDINGAN_KRITERIA : stores_steps
    KRITERIA ||--o{ PERBANDINGAN_KRITERIA : participates
    KRITERIA ||--o{ PENILAIAN : has_score
    KANDIDAT ||--o{ PENILAIAN : receives_score
    KANDIDAT ||--o{ HASIL_WP : ranked_in
    PERIODE ||--o{ HASIL_WP : finalized_in

    PERIODE {
        int id PK
        string nama_periode
        date tanggal_mulai
        date tanggal_selesai
        enum status "aktif, inaktif, selesai"
    }

    KRITERIA {
        int id PK
        int periode_id FK
        string nama_kriteria
        enum tipe "benefit, cost"
    }

    KANDIDAT {
        int id PK
        int periode_id FK
        string nama
        string email
        string no_telp
    }

    PENILAIAN {
        int id PK
        int kandidat_id FK
        int kriteria_id FK
        double nilai
    }

    HASIL_WP {
        int id PK
        int kandidat_id FK
        int periode_id FK
        double nilai_v
        int ranking
    }
```

## Tabel Konfigurasi Detail

| Tabel | Deskripsi | Field Utama |
| :--- | :--- | :--- |
| **`periode`** | Inti dari pemisahan data. | `nama_periode`, `status`, `range_tanggal` |
| **`kriteria`** | Parameter penilaian. | `nama_kriteria`, `tipe` (Cost/Benefit) |
| **`perbandingan_kriteria`** | Data matriks berpasangan AHP. | `kriteria_id_1`, `kriteria_id_2`, `nilai` |
| **`bobot_kriteria`** | Hasil normalisasi matriks AHP. | `kriteria_id`, `bobot_prioritas` |
| **`kandidat`** | Data peserta seleksi. | `nama`, `kontak` |
| **`penilaian`** | Matriks keputusan kandidat. | `kandidat_id`, `kriteria_id`, `nilai` |
| **`hasil_wp`** | Hasil akhir perangkingan. | `nilai_v`, `ranking` |

---

> [!NOTE]
> Sistem menggunakan **Foreign Key Constraints** pada tingkat database untuk menjamin jika sebuah Periode dihapus, semua data terkait (Kriteria, Kandidat, Penilaian) akan ikut terhapus secara otomatis (*Cascade Delete*).
