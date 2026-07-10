<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }

  @page {
    size: A4 landscape;
    margin: 8mm 8mm;
  }

  body {
    font-family: 'DejaVu Sans', Arial, sans-serif;
    background: #fff;
    font-size: 0;
  }

  /* ══════ GRID 4 kartu/halaman (2×2) ══════ */
  .baris {
    display: table;
    width: 100%;
    margin-bottom: 5mm;
  }
  .baris:last-child { margin-bottom: 0; }

  .kolom {
    display: table-cell;
    width: 50%;
    vertical-align: top;
    padding-right: 2.5mm;
  }
  .kolom:last-child { padding-right: 0; padding-left: 2.5mm; }

  .page-break { page-break-after: always; }

  /* ══════ KARTU ══════ */
  .kartu {
    width: 100%;
    border: 1pt solid #064e3b;
    border-radius: 5pt;
    overflow: hidden;
    background: #f8fafb;
    page-break-inside: avoid;
  }

  /* ── HEADER ── */
  .k-header {
    background: #064e3b;
    padding: 5pt 8pt;
    display: table;
    width: 100%;
  }
  .k-hdr-left  { display: table-cell; vertical-align: middle; width: 75%; }
  .k-hdr-right { display: table-cell; vertical-align: middle; text-align: right; width: 25%; }

  .k-icon-wrap {
    display: inline-block;
    vertical-align: middle;
    width: 18pt;
    height: 18pt;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    text-align: center;
    line-height: 18pt;
    margin-right: 4pt;
  }
  .k-icon-wrap span {
    font-size: 8pt;
    color: #fff;
  }
  .k-hdr-text {
    display: inline-block;
    vertical-align: middle;
  }
  .k-sekolah {
    font-size: 7.5pt;
    font-weight: bold;
    color: #ffffff;
    letter-spacing: 0.4pt;
    line-height: 1.2;
  }
  .k-subtitle {
    font-size: 4.5pt;
    color: #95d3ba;
    letter-spacing: 0.3pt;
  }
  .k-badge {
    display: inline-block;
    background: rgba(108,248,187,0.2);
    border: 0.5pt solid rgba(108,248,187,0.4);
    border-radius: 10pt;
    padding: 1.5pt 6pt;
    font-size: 4.5pt;
    font-weight: bold;
    color: #6cf8bb;
    letter-spacing: 0.4pt;
    text-transform: uppercase;
  }
  .k-badge-dot {
    display: inline-block;
    width: 3pt;
    height: 3pt;
    border-radius: 50%;
    background: #6cf8bb;
    vertical-align: middle;
    margin-right: 2pt;
  }

  /* ── BODY ── */
  .k-body {
    display: table;
    width: 100%;
    padding: 6pt 8pt 5pt;
  }
  .k-col-foto {
    display: table-cell;
    width: 50pt;
    vertical-align: top;
    padding-right: 7pt;
  }
  .k-col-data {
    display: table-cell;
    vertical-align: top;
  }

  /* Foto */
  .k-foto {
    width: 48pt;
    height: 60pt;
    border: 1pt solid #d1d5db;
    border-radius: 4pt;
    overflow: hidden;
    background: #e8f5f0;
  }
  .k-foto img { width: 100%; height: 100%; }
  .k-foto-ph {
    width: 100%; height: 100%;
    font-size: 4.5pt; color: #9ca3af;
    text-align: center;
    padding: 14pt 2pt;
    line-height: 1.4;
  }

  /* Nama & NISN */
  .k-nama {
    font-size: 9pt;
    font-weight: bold;
    color: #003527;
    line-height: 1.15;
    margin-bottom: 2pt;
  }
  .k-nisn {
    display: inline-block;
    background: #ffffff;
    border: 0.6pt solid #d1d5db;
    border-radius: 3pt;
    padding: 1.5pt 5pt;
    margin-bottom: 5pt;
  }
  .k-nisn-icon {
    font-size: 5pt;
    color: #6b7280;
    vertical-align: middle;
    margin-right: 2pt;
  }
  .k-nisn-text {
    font-size: 5.5pt;
    font-weight: bold;
    color: #111827;
    font-family: 'DejaVu Sans Mono', monospace;
    letter-spacing: 0.3pt;
    vertical-align: middle;
  }

  /* Section title */
  .k-sct {
    font-size: 4pt;
    font-weight: bold;
    color: #059669;
    text-transform: uppercase;
    letter-spacing: 0.6pt;
    margin-bottom: 2pt;
    margin-top: 4pt;
  }

  /* 2-kolom layout */
  .k-row2 { display: table; width: 100%; margin-bottom: 1pt; }
  .k-c2a  { display: table-cell; width: 55%; vertical-align: top; padding-right: 4pt; }
  .k-c2b  { display: table-cell; width: 45%; vertical-align: top; }

  .k-lbl { font-size: 4pt; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.3pt; line-height: 1.5; }
  .k-val { font-size: 5.5pt; color: #111827; font-weight: bold; line-height: 1.3; margin-bottom: 2pt; }
  .k-val-sm { font-size: 5pt; }

  /* ── BANNER AKADEMIK ── */
  .k-akad {
    background: #064e3b;
    padding: 4pt 8pt;
    display: table;
    width: 100%;
  }
  .k-akad-col {
    display: table-cell;
    vertical-align: middle;
    width: 33.33%;
    padding-right: 5pt;
  }
  .k-akad-col + .k-akad-col {
    border-left: 0.3pt solid rgba(255,255,255,0.2);
    padding-left: 5pt;
    padding-right: 0;
  }
  .k-akad-lbl { font-size: 3.5pt; color: #95d3ba; text-transform: uppercase; letter-spacing: 0.5pt; font-weight: bold; }
  .k-akad-val { font-size: 5.5pt; color: #ffffff; font-weight: bold; margin-top: 1pt; line-height: 1.2; }

  /* ── FOOTER ── */
  .k-footer {
    background: #f0fdf4;
    border-top: 0.4pt solid #a7f3d0;
    padding: 3.5pt 8pt;
    display: table;
    width: 100%;
  }
  .k-foot-left  { display: table-cell; vertical-align: middle; }
  .k-foot-right { display: table-cell; vertical-align: middle; text-align: right; width: 30pt; }
  .k-foot-v { font-size: 4.5pt; color: #059669; font-weight: bold; letter-spacing: 0.3pt; }
  .k-foot-id {
    font-size: 3.5pt;
    color: #9ca3af;
    font-family: 'DejaVu Sans Mono', monospace;
    margin-top: 1pt;
    line-height: 1.6;
  }
  .k-qr {
    width: 24pt; height: 24pt;
    border: 0.5pt solid #a7f3d0;
    border-radius: 2pt;
    background: #fff;
    overflow: hidden;
  }
</style>
</head>
<body>

@php
  $chunks = $siswas->chunk(4);
  $statusLabel = ['aktif'=>'Aktif','lulus'=>'Lulus','pindah'=>'Pindah','nonaktif'=>'Non-Aktif'];
@endphp

@foreach ($chunks as $chunk)
  @php
    $baris1 = $chunk->slice(0, 2);
    $baris2 = $chunk->slice(2, 2);
  @endphp

  <div class="{{ !$loop->last ? 'page-break' : '' }}">

    {{-- BARIS 1 --}}
    <div class="baris">
      @foreach ($baris1 as $s)
      <div class="kolom">
        @include('operator.pdf._kartu-item', ['s' => $s])
      </div>
      @endforeach
      @if ($baris1->count() < 2)<div class="kolom"></div>@endif
    </div>

    {{-- BARIS 2 --}}
    @if ($baris2->count() > 0)
    <div class="baris">
      @foreach ($baris2 as $s)
      <div class="kolom">
        @include('operator.pdf._kartu-item', ['s' => $s])
      </div>
      @endforeach
      @if ($baris2->count() < 2)<div class="kolom"></div>@endif
    </div>
    @endif

  </div>
@endforeach

</body>
</html>