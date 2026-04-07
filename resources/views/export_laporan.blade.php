<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Seleksi SPK Security</title>
    <style>
        @page { margin: 2cm; }
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #444; padding-bottom: 15px; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 22px; text-transform: uppercase; letter-spacing: 2px; }
        .header p { margin: 5px 0 0; font-size: 12px; color: #666; font-weight: bold; }
        
        .section-title { font-size: 14px; font-weight: bold; text-transform: uppercase; border-left: 4px solid #4f46e5; padding-left: 10px; margin: 25px 0 15px; background: #f8fafc; padding-top: 5px; padding-bottom: 5px; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; table-layout: fixed; }
        th, td { border: 1px solid #e2e8f0; padding: 10px; font-size: 11px; word-wrap: break-word; }
        th { background-color: #f1f5f9; color: #475569; font-weight: bold; text-transform: uppercase; text-align: center; }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        
        .badge { padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; }
        .badge-primary { background: #4f46e5; color: white; }
        
        .footer { margin-top: 50px; font-size: 10px; color: #94a3b8; text-align: right; border-top: 1px solid #e2e8f0; padding-top: 10px; }
        
        .rank-1 { background-color: #fef3c7; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>SPK Security Command Center</h1>
        <p>Laporan Hasil Analisis Rekrutmen Petugas Keamanan</p>
    </div>

    <div class="section-title">Informasi Bobot Kriteria (AHP)</div>
    <table>
        <thead>
            <tr>
                <th style="width: 10%">No</th>
                <th style="width: 50%">Kriteria</th>
                <th style="width: 20%">Tipe</th>
                <th style="width: 20%">Bobot Prioritas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bobot as $i => $b)
            <tr>
                <td class="text-center">{{ $i+1 }}</td>
                <td>{{ $b->kriteria->nama ?? '-' }}</td>
                <td class="text-center">{{ ucfirst($b->kriteria->tipe ?? '-') }}</td>
                <td class="text-center font-bold">{{ number_format($b->bobot, 4) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">Hasil Akhir Ranking (Weighted Product)</div>
    <table>
        <thead>
            <tr>
                <th style="width: 15%">Ranking</th>
                <th style="width: 45%">Nama Kandidat</th>
                <th style="width: 20%">Nilai S</th>
                <th style="width: 20%">Nilai V (Vektor)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasil as $row)
            <tr class="{{ $row->ranking == 1 ? 'rank-1' : '' }}">
                <td class="text-center">
                    @if($row->ranking == 1)
                        <span class="badge badge-primary">JUARA 1</span>
                    @else
                        {{ $row->ranking }}
                    @endif
                </td>
                <td>{{ $row->kandidat->nama ?? '-' }}</td>
                <td class="text-center">{{ number_format($row->nilai_s, 6) }}</td>
                <td class="text-center font-bold text-primary">{{ number_format($row->nilai_v, 4) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ date('d F Y H:i:s') }}<br>
        Sistem Pendukung Keputusan Multi-Kriteria (AHP & WP)
    </div>
</body>
</html>
