<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekam Medis - {{ $patient->name }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        .header {
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
        }
        .header p {
            margin: 2px 0;
            font-size: 11px;
            color: #555;
        }
        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .info-table td {
            padding: 4px;
            vertical-align: top;
        }
        .info-table .label {
            width: 120px;
            color: #555;
        }
        .section-title {
            background-color: #f0f0f0;
            padding: 5px;
            font-weight: bold;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        .data-table th, .data-table td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }
        .data-table th {
            background-color: #f9f9f9;
        }
        .nadi-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .signature {
            margin-top: 40px;
            width: 250px;
            float: right;
            text-align: center;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            margin-top: 60px;
            margin-bottom: 5px;
        }
        .clear { clear: both; }
    </style>
</head>
<body>

    <div class="header">
        <h1>LKP Mandiri</h1>
        <p>Lembaga Kursus dan Pelatihan Akupunktur & Penyehat Tradisional</p>
        <p>Jl. S Parman III / 18, Malang | Telp: (0341) 478292</p>
    </div>

    <div class="title">REKAM MEDIS AKUPUNKTUR</div>

    <table class="info-table">
        <tr>
            <td class="label">No. Registrasi</td>
            <td style="width: 250px;">: <strong>{{ $patient->registration_number }}</strong></td>
            <td class="label">Tanggal Kunjungan</td>
            <td>: {{ $record->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td class="label">Nama Pasien</td>
            <td>: <strong>{{ $patient->name }}</strong></td>
            <td class="label">Usia / Gender</td>
            <td>: {{ $patient->age }} Tahun / {{ $patient->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
    </table>

    <div class="section-title">I. WAWANCARA (ANAMNESIS)</div>
    <table class="info-table">
        <tr><td class="label">Keluhan Utama</td><td>: {{ $record->keluhan_utama ?? '-' }}</td></tr>
        <tr><td class="label">Keluhan Tambahan</td><td>: {{ $record->keluhan_tambahan ?? '-' }}</td></tr>
        <tr><td class="label">Riwayat Penyakit</td><td>: {{ $record->riwayat_penyakit_sekarang ?? '-' }}</td></tr>
    </table>

    <div class="section-title">II. PENGAMATAN (FISIK & LIDAH)</div>
    <table class="info-table">
        <tr>
            <td class="label">Kesadaran (Shen)</td><td>: {{ $record->shen_kesadaran ?? '-' }}</td>
            <td class="label">Bentuk Lidah</td><td>: {{ $record->lidah_bentuk ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Warna Wajah</td><td>: {{ $record->warna_wajah ?? '-' }}</td>
            <td class="label">Warna Lidah</td><td>: {{ $record->lidah_warna ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">III. PEMERIKSAAN NADI & TITIK</div>
    @php
        $nadiKanan = json_decode($record->nadi_kanan, true) ?? [];
        $nadiKiri = json_decode($record->nadi_kiri, true) ?? [];
    @endphp
    <table width="100%">
        <tr>
            <td width="48%" valign="top">
                <div class="nadi-box">
                    <strong>Nadi Kanan:</strong><br>
                    Cun (Paru): {{ $nadiKanan['cun'] ?? '-' }}<br>
                    Guan (Limpa): {{ $nadiKanan['guan'] ?? '-' }}<br>
                    Chi (Ming Men): {{ $nadiKanan['chi'] ?? '-' }}
                </div>
            </td>
            <td width="4%"></td>
            <td width="48%" valign="top">
                <div class="nadi-box">
                    <strong>Nadi Kiri:</strong><br>
                    Cun (Jantung): {{ $nadiKiri['cun'] ?? '-' }}<br>
                    Guan (Hati): {{ $nadiKiri['guan'] ?? '-' }}<br>
                    Chi (Ginjal): {{ $nadiKiri['chi'] ?? '-' }}
                </div>
            </td>
        </tr>
    </table>

    @if($record->pointChecks && $record->pointChecks->count() > 0)
    <table class="data-table">
        <thead>
            <tr>
                <th>Meridian Abnormal</th>
                <th style="text-align: center; width: 60px;">Yen</th>
                <th style="text-align: center; width: 60px;">Su</th>
                <th style="text-align: center; width: 60px;">Mu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($record->pointChecks as $point)
            <tr>
                <td>{{ $point->meridian_name }}</td>
                <td align="center">{{ $point->yen_point ? 'V' : '-' }}</td>
                <td align="center">{{ $point->su_point ? 'V' : '-' }}</td>
                <td align="center">{{ $point->mu_point ? 'V' : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="section-title">IV. DIAGNOSIS & TERAPI</div>
    <table class="info-table">
        <tr><td class="label">Diagnosis Penyakit</td><td>: <strong>{{ $record->diagnosis_penyakit ?? '-' }}</strong></td></tr>
        <tr><td class="label">Diagnosis Sindrom</td><td>: <strong>{{ $record->diagnosis_sindrom ?? '-' }}</strong></td></tr>
        <tr><td class="label">Titik Akupuntur</td><td>: {{ $record->titik_akupuntur ?? '-' }}</td></tr>
        <tr><td class="label">Saran / Anjuran</td><td>: {{ $record->saran_anjuran ?? '-' }}</td></tr>
    </table>

    <div class="signature">
        <p>Malang, {{ date('d F Y', strtotime($record->created_at)) }}</p>
        <p>Praktisi / Akupunkturis</p>
        <div class="signature-line"></div>
        <p>( ................................................. )</p>
    </div>

    <div class="clear"></div>

</body>
</html>
