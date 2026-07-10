{{-- ──────────────────────────────────────────
     PARTIAL: Satu kartu identitas siswa
     Desain mengikuti modal Kartu Identitas di web
     Ukuran: KTP (85.6×54mm), 4 per halaman A4 landscape
────────────────────────────────────────── --}}

@php
  $statusLabel = ['aktif'=>'Aktif','lulus'=>'Lulus','pindah'=>'Pindah','nonaktif'=>'Non-Aktif'];
@endphp

<div class="kartu">

  {{-- HEADER --}}
  <div class="k-header">
    <div class="k-hdr-left">
      <div class="k-icon-wrap"><span>🎓</span></div>
      <div class="k-hdr-text">
        <div class="k-sekolah">MI NURUL HUDA 3</div>
        <div class="k-subtitle">Profil Identitas Peserta Didik</div>
      </div>
    </div>
    <div class="k-hdr-right">
      <span class="k-badge"><span class="k-badge-dot"></span>{{ $statusLabel[$s->status] ?? ucfirst($s->status) }}</span>
    </div>
  </div>

  {{-- BODY --}}
  <div class="k-body">
    <div class="k-col-foto">
      <div class="k-foto">
        @if ($s->foto && file_exists(storage_path('app/public/' . $s->foto)))
          <img src="{{ storage_path('app/public/' . $s->foto) }}">
        @else
          <div class="k-foto-ph">Foto<br>tidak<br>tersedia</div>
        @endif
      </div>
    </div>

    <div class="k-col-data">
      <div class="k-nama">{{ $s->nama }}</div>
      <div class="k-nisn">
        <span class="k-nisn-icon">📋</span>
        <span class="k-nisn-text">NISN {{ $s->nisn ?? '—' }}</span>
      </div>

      {{-- IDENTITAS SISWA --}}
      <div class="k-sct">Identitas Siswa</div>

      <div class="k-row2">
        <div class="k-c2a">
          <div class="k-lbl">Tempat, Tanggal Lahir</div>
          <div class="k-val k-val-sm">{{ $s->tempat_lahir ?? '—' }}, {{ $s->tanggal_lahir ? $s->tanggal_lahir->translatedFormat('d F Y') : '—' }}</div>
        </div>
        <div class="k-c2b">
          <div class="k-lbl">Jenis Kelamin</div>
          <div class="k-val k-val-sm">{{ $s->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
        </div>
      </div>

      <div class="k-lbl">Agama</div>
      <div class="k-val k-val-sm">{{ $s->agama ?? '—' }}</div>

      <div class="k-lbl">Alamat</div>
      <div class="k-val k-val-sm">{{ $s->orangTua?->alamat ?? '—' }}</div>

      {{-- DATA ORANG TUA --}}
      <div class="k-sct">Data Orang Tua / Wali</div>

      <div class="k-row2">
        <div class="k-c2a">
          <div class="k-lbl">Nama Ayah</div>
          <div class="k-val k-val-sm">{{ $s->orangTua?->nama_ayah ?? '—' }}</div>
        </div>
        <div class="k-c2b">
          <div class="k-lbl">Nama Ibu</div>
          <div class="k-val k-val-sm">{{ $s->orangTua?->nama_ibu ?? '—' }}</div>
        </div>
      </div>

      <div class="k-lbl">No. Telepon Wali</div>
      <div class="k-val k-val-sm">{{ $s->orangTua?->no_hp ?? '—' }}</div>
    </div>
  </div>

  {{-- BANNER AKADEMIK --}}
  <div class="k-akad">
    <div class="k-akad-col">
      <div class="k-akad-lbl">Kelas Aktif</div>
      <div class="k-akad-val">{{ $s->kelas ? 'Kelas ' . $s->kelas->full_name : '—' }}</div>
    </div>
    <div class="k-akad-col">
      <div class="k-akad-lbl">Wali Kelas</div>
      <div class="k-akad-val">{{ $s->kelas?->waliKelas?->nama ?? '—' }}</div>
    </div>
    <div class="k-akad-col">
      <div class="k-akad-lbl">Tahun Ajaran</div>
      <div class="k-akad-val">{{ $s->kelas?->tahun_ajaran ?? '—' }}</div>
    </div>
  </div>

  {{-- FOOTER --}}
  <div class="k-footer">
    <div class="k-foot-left">
      <div class="k-foot-v">&#10003; VERIFIED STUDENT IDENTITY</div>
      <div class="k-foot-id">
        ID: ID-MI3-{{ now()->format('ym') }}-{{ str_pad($s->id, 4, '0', STR_PAD_LEFT) }}<br>
        Issued: {{ now()->translatedFormat('d M Y') }}
      </div>
    </div>
    <div class="k-foot-right">
      <div class="k-qr"></div>
    </div>
  </div>

</div>
