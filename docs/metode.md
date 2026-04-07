# 🧮 Metodologi Komputasi (AHP + WP)

Sistem ini menggunakan pendekatan *Hybrid Multi-Criteria Decision Making* (MCDM) untuk menjamin objektivitas dalam pemilihan personel keamanan.

---

## 1. Analytical Hierarchy Process (AHP)
AHP digunakan untuk menentukan **bobot prioritas** setiap kriteria.

### Langkah-langkah:
1. **Penyusunan Matriks Perbandingan Berpasangan**: Membandingkan kriteria $i$ dengan kriteria $j$ menggunakan skala Saaty (1-9).
2. **Normalisasi Matriks**: Membagi setiap elemen matriks dengan jumlah total kolomnya.
3. **Perhitungan Eigenvector (Bobot)**: Menghitung rata-rata baris dari matriks ternormalisasi.
4. **Uji Konsistensi**:
   - Menghitung $\lambda_{max}$ (Principal Eigenvalue).
   - Menghitung Consistency Index (CI): $CI = \frac{\lambda_{max} - n}{n - 1}$.
   - Menghitung Consistency Ratio (CR): $CR = \frac{CI}{IR}$, di mana IR adalah Index Random.
   - **Syarat**: Jika $CR \le 0.1$, maka perbandingan dinyatakan konsisten.

---

## 2. Weighted Product (WP)
WP digunakan untuk melakukan **perangkingan** alternatif (kandidat) berdasarkan bobot yang diperoleh dari AHP.

### Langkah-langkah:
1. **Normalisasi Bobot ($w_j$)**: Memastikan total bobot adalah 1 ($\sum w_j = 1$).
2. **Perhitungan Vektor S ($S_i$)**:
   $$S_i = \prod_{j=1}^{n} x_{ij}^{w_j}$$
   - Nilai $w_j$ bernilai positif untuk kriteria **Benefit**.
   - Nilai $w_j$ bernilai negatif untuk kriteria **Cost**.
3. **Perhitungan Vektor V ($V_i$)**: Menentukan nilai preferensi relatif setiap kandidat.
   $$V_i = \frac{S_i}{\sum_{k=1}^{m} S_k}$$
4. **Perangkingan**: Kandidat diurutkan berdasarkan nilai $V_i$ dari yang terbesar ke terkecil.

---

## 🛠️ Implementasi Kode
Logika komputasi ini diimplementasikan pada backend menggunakan Service Class di Laravel untuk memisahkan logika bisnis dari Controller, memastikan perhitungan yang presisi dan dapat diuji (*testable*).

> [!IMPORTANT]
> Sistem ini secara otomatis menangani kriteria bertipe **Cost** (seperti Jarak atau Usia jika diperlukan) dengan mengubah pangkat bobot menjadi negatif dalam perhitungan Vektor S.
