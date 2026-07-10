{{-- ──────────────────────────────────────────
     PARTIAL: Satu kartu identitas guru
     Desain mengikuti modal Kartu Identitas di web
     Ukuran: KTP (85.6×54mm), 4 per halaman A4 landscape
────────────────────────────────────────── --}}

<div class="kartu">

  {{-- HEADER --}}
  <div class="k-header">
    <div class="k-hdr-left">
      <div class="k-icon-wrap"><span>🏛️</span></div>
      <div class="k-hdr-text">
        <div class="k-sekolah">MI NURUL HUDA 3</div>
        <div class="k-subtitle">Profil Identitas Pendidik & Tenaga Kependidikan</div>
      </div>
    </div>
    <div class="k-hdr-right">
      <span class="k-badge"><span class="k-badge-dot"></span>{{ $g->status_aktif ? 'Aktif' : 'Non-Aktif' }}</span>
    </div>
  </div>

  {{-- BODY --}}
  <div class="k-body">
    <div class="k-col-foto">
      <div class="k-foto">
        @if ($g->foto && file_exists(storage_path('app/public/' . $g->foto)))
          <img src="{{ storage_path('app/public/' . $g->foto) }}">
        @else
          <div class="k-foto-ph">Foto<br>tidak<br>tersedia</div>
        @endif
      </div>
    </div>

    <div class="k-col-data">
      <div class="k-nama">{{ $g->nama }}</div>
      <div class="k-nisn">
        <span class="k-nisn-icon">🆔</span>
        <span class="k-nisn-text">NUPTK {{ $g->nuptk ?? '—' }}</span>
      </div>

      {{-- IDENTITAS PENDIDIK --}}
      <div class="k-sct">Identitas Pendidik</div>

      <div class="k-row2">
        <div class="k-c2a">
          <div class="k-lbl">Tempat, Tanggal Lahir</div>
          <div class="k-val k-val-sm">{{ $g->tempat_lahir ?? '—' }}, {{ $g->tanggal_lahir ? $g->tanggal_lahir->translatedFormat('d F Y') : '—' }}</div>
        </div>
        <div class="k-c2b">
          <div class="k-lbl">NIP</div>
          <div class="k-val k-val-sm">{{ $g->nip ?? '—' }}</div>
        </div>
      </div>

      <div class="k-row2">
        <div class="k-c2a">
          <div class="k-lbl">Agama</div>
          <div class="k-val k-val-sm">{{ $g->agama ?? '—' }}</div>
        </div>
        <div class="k-c2b">
          <div class="k-lbl">Jenis Kelamin</div>
          <div class="k-val k-val-sm">{{ $g->jenis_kelamin ?? '—' }}</div>
        </div>
      </div>

      <div class="k-lbl">Alamat</div>
      <div class="k-val k-val-sm">{{ $g->alamat ?? '—' }}</div>

      {{-- RIWAYAT PENDIDIKAN --}}
      <div class="k-sct">Riwayat Pendidikan</div>

      <div class="k-row2">
        <div class="k-c2a">
          <div class="k-lbl">Jenjang / Jurusan</div>
          <div class="k-val k-val-sm">{{ $g->pendidikan ?? '—' }} / {{ $g->jurusan ?? '—' }}</div>
        </div>
        <div class="k-c2b">
          <div class="k-lbl">Kampus</div>
          <div class="k-val k-val-sm">{{ $g->kampus ?? '—' }}</div>
        </div>
      </div>
    </div>
  </div>

  {{-- BANNER KEPEGAWAIAN --}}
  <div class="k-akad">
    <div class="k-akad-col">
      <div class="k-akad-lbl">Status</div>
      <div class="k-akad-val">{{ $g->status_kepegawaian ?? '—' }} {{ $g->golongan ? '('.$g->golongan.')' : '' }}</div>
    </div>
    <div class="k-akad-col">
      <div class="k-akad-lbl">Jabatan</div>
      <div class="k-akad-val">
        @if($g->kelasWali)
            Wali Kelas {{ $g->kelasWali->tingkat }}{{ $g->kelasWali->nama_kelas }}
        @else
            {{ $g->jabatan ?? '—' }}
        @endif
      </div>
    </div>
    <div class="k-akad-col">
      <div class="k-akad-lbl">Mata Pelajaran</div>
      <div class="k-akad-val">{{ $g->mapel ?? '—' }}</div>
    </div>
  </div>

  {{-- FOOTER --}}
  <div class="k-footer">
    <div class="k-foot-left">
      <div class="k-foot-v">&#10003; VERIFIED TEACHER IDENTITY</div>
      <div class="k-foot-id">
        ID: ID-MI3-G-{{ now()->format('ym') }}-{{ str_pad($g->id, 4, '0', STR_PAD_LEFT) }}<br>
        Issued: {{ now()->translatedFormat('d M Y') }}
      </div>
    </div>
    <div class="k-foot-right">
      <div class="k-qr">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode('GURU:' . $g->nama . '|NUPTK:' . $g->nuptk) }}" style="width: 100%; height: 100%;">
      </div>
    </div>
  </div>

</div>
