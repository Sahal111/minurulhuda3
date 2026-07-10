<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Guru</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #10b981;
        }
        .header h1 {
            font-size: 18px;
            font-weight: bold;
            color: #10b981;
            margin-bottom: 5px;
        }
        .header h2 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 3px;
        }
        .header p {
            font-size: 9px;
            color: #666;
        }
        .info-box {
            background: #f3f4f6;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .info-box p {
            margin-bottom: 3px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background: #10b981;
            color: white;
            padding: 8px 5px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
            border: 1px solid #059669;
        }
        td {
            padding: 6px 5px;
            border: 1px solid #e5e7eb;
            font-size: 9px;
        }
        tr:nth-child(even) {
            background: #f9fafb;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }
        .badge-pns { background: #dbeafe; color: #1e40af; }
        .badge-honorer { background: #fef3c7; color: #92400e; }
        .badge-pppk { background: #d1fae5; color: #065f46; }
        .badge-aktif { background: #d1fae5; color: #065f46; }
        .badge-nonaktif { background: #f3f4f6; color: #6b7280; }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .footer p {
            margin-bottom: 50px;
        }
        .summary {
            margin-top: 20px;
            padding: 10px;
            background: #f0fdf4;
            border-left: 4px solid #10b981;
        }
        .summary h3 {
            font-size: 11px;
            margin-bottom: 8px;
            color: #10b981;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .summary-item {
            background: white;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #d1fae5;
        }
        .summary-item strong {
            display: block;
            font-size: 16px;
            color: #10b981;
            margin-bottom: 2px;
        }
        .summary-item span {
            font-size: 8px;
            color: #6b7280;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <h1>MI NURUL HUDA 3</h1>
        <h2>LAPORAN DATA GURU & TENAGA PENDIDIK</h2>
        <p>Jl. Contoh No. 123, Kota, Provinsi | Telp: (021) 12345678</p>
    </div>

    {{-- Info Laporan --}}
    <div class="info-box">
        <p><strong>Jenis Laporan:</strong> 
            @if($type === 'kepegawaian')
                Rekap Berdasarkan Status Kepegawaian
            @elseif($type === 'pendidikan')
                Rekap Berdasarkan Pendidikan
            @elseif($type === 'sertifikasi')
                Rekap Sertifikasi Guru
            @else
                Laporan Lengkap Data Guru
            @endif
        </p>
        <p><strong>Tanggal Cetak:</strong> {{ now()->translatedFormat('d F Y, H:i') }} WIB</p>
        <p><strong>Total Guru:</strong> {{ $gurus->count() }} orang</p>
    </div>

    {{-- Tabel Data --}}
    @if($type === 'kepegawaian')
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama Guru</th>
                    <th width="15%">NUPTK</th>
                    <th width="15%">Status Kepegawaian</th>
                    <th width="10%">Golongan</th>
                    <th width="15%">TMT</th>
                    <th width="15%">Masa Bakti</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gurus as $index => $g)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $g->nama }}</strong><br><small>{{ $g->jabatan }}</small></td>
                    <td>{{ $g->nuptk ?? '-' }}</td>
                    <td>
                        <span class="badge badge-{{ strtolower($g->status_kepegawaian) }}">
                            {{ $g->status_kepegawaian }}
                        </span>
                    </td>
                    <td>{{ $g->golongan ?? '-' }}</td>
                    <td>{{ $g->tanggal_bergabung ? \Carbon\Carbon::parse($g->tanggal_bergabung)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $g->masa_bakti ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Summary --}}
        <div class="summary">
            <h3>Ringkasan Status Kepegawaian</h3>
            <div class="summary-grid">
                <div class="summary-item">
                    <strong>{{ $gurus->where('status_kepegawaian', 'PNS')->count() }}</strong>
                    <span>PNS</span>
                </div>
                <div class="summary-item">
                    <strong>{{ $gurus->where('status_kepegawaian', 'PPPK')->count() }}</strong>
                    <span>PPPK</span>
                </div>
                <div class="summary-item">
                    <strong>{{ $gurus->where('status_kepegawaian', 'Honorer')->count() }}</strong>
                    <span>Honorer</span>
                </div>
            </div>
        </div>

    @elseif($type === 'pendidikan')
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama Guru</th>
                    <th width="15%">NUPTK</th>
                    <th width="20%">Pendidikan S1</th>
                    <th width="15%">Jurusan</th>
                    <th width="20%">Pendidikan S2</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gurus as $index => $g)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $g->nama }}</strong><br><small>{{ $g->mapel ?? '-' }}</small></td>
                    <td>{{ $g->nuptk ?? '-' }}</td>
                    <td>{{ $g->pendidikan ?? '-' }}<br><small>{{ $g->kampus ?? '' }}</small></td>
                    <td>{{ $g->jurusan ?? '-' }}</td>
                    <td>{{ $g->pendidikan_s2 ?? '-' }}<br><small>{{ $g->kampus_s2 ?? '' }}</small></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Summary --}}
        <div class="summary">
            <h3>Ringkasan Pendidikan</h3>
            <div class="summary-grid">
                <div class="summary-item">
                    <strong>{{ $gurus->whereNotNull('pendidikan')->count() }}</strong>
                    <span>Memiliki S1</span>
                </div>
                <div class="summary-item">
                    <strong>{{ $gurus->whereNotNull('pendidikan_s2')->count() }}</strong>
                    <span>Memiliki S2</span>
                </div>
                <div class="summary-item">
                    <strong>{{ $gurus->whereNull('pendidikan')->count() }}</strong>
                    <span>Belum Tercatat</span>
                </div>
            </div>
        </div>

    @elseif($type === 'sertifikasi')
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama Guru</th>
                    <th width="15%">NUPTK</th>
                    <th width="15%">No. Sertifikasi</th>
                    <th width="10%">Tahun</th>
                    <th width="20%">Bidang Sertifikasi</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gurus as $index => $g)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $g->nama }}</strong><br><small>{{ $g->jabatan }}</small></td>
                    <td>{{ $g->nuptk ?? '-' }}</td>
                    <td>{{ $g->no_sertifikasi ?? '-' }}</td>
                    <td>{{ $g->tahun_sertifikasi ?? '-' }}</td>
                    <td>{{ $g->bidang_sertifikasi ?? '-' }}</td>
                    <td>
                        @if($g->no_sertifikasi && !in_array(trim($g->no_sertifikasi), ['', '-', '–']))
                            <span class="badge badge-aktif">Sudah</span>
                        @else
                            <span class="badge badge-nonaktif">Belum</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Summary --}}
        <div class="summary">
            <h3>Ringkasan Sertifikasi</h3>
            <div class="summary-grid">
                <div class="summary-item">
                    <strong>{{ $gurus->filter(fn($g) => $g->no_sertifikasi && !in_array(trim($g->no_sertifikasi), ['', '-', '–']))->count() }}</strong>
                    <span>Sudah Sertifikasi</span>
                </div>
                <div class="summary-item">
                    <strong>{{ $gurus->filter(fn($g) => !$g->no_sertifikasi || in_array(trim($g->no_sertifikasi), ['', '-', '–']))->count() }}</strong>
                    <span>Belum Sertifikasi</span>
                </div>
                <div class="summary-item">
                    <strong>{{ $gurus->filter(fn($g) => $g->no_sertifikasi && !in_array(trim($g->no_sertifikasi), ['', '-', '–']))->count() > 0 ? number_format(($gurus->filter(fn($g) => $g->no_sertifikasi && !in_array(trim($g->no_sertifikasi), ['', '-', '–']))->count() / $gurus->count()) * 100, 1) : 0 }}%</strong>
                    <span>Persentase</span>
                </div>
            </div>
        </div>

    @else
        {{-- Laporan Lengkap --}}
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama Guru</th>
                    <th width="12%">NUPTK</th>
                    <th width="15%">Jabatan</th>
                    <th width="12%">Kepegawaian</th>
                    <th width="15%">Mapel</th>
                    <th width="12%">Pendidikan</th>
                    <th width="9%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gurus as $index => $g)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $g->nama }}</strong></td>
                    <td>{{ $g->nuptk ?? '-' }}</td>
                    <td>{{ $g->jabatan ?? '-' }}</td>
                    <td>
                        <span class="badge badge-{{ strtolower($g->status_kepegawaian) }}">
                            {{ $g->status_kepegawaian }}
                        </span>
                    </td>
                    <td>{{ $g->mapel ?? '-' }}</td>
                    <td>{{ $g->pendidikan ?? '-' }}</td>
                    <td>
                        <span class="badge badge-{{ $g->status_aktif ? 'aktif' : 'nonaktif' }}">
                            {{ $g->status_aktif ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <p>Mengetahui,<br>Kepala Sekolah</p>
        <p><strong><u>Nama Kepala Sekolah</u></strong><br>NIP. 123456789012345678</p>
    </div>
</body>
</html>
