@extends('layouts.app')

@section('content')
<div class="card shadow">
  <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Data Pembayaran</h5>
    <a href="{{ route('jenispembayaran') }}" class="btn btn-warning btn-sm">
      <i class="bi bi-gear"></i> Kelola Jenis Pembayaran
    </a>
  </div>

  <div class="card-body">
    {{-- Filter kelas (opsional) --}}
    <div class="row g-2 mb-3">
      <div class="col-md-3">
        <label class="form-label">Filter Kelas</label>
        <select id="filter_kelas" class="form-control">
          <option value="">-- Semua Kelas --</option>
          <option value="X">X</option>
          <option value="XI">XI</option>
          <option value="XII">XII</option>
          <option value="alumni">Alumni</option>
        </select>
      </div>
    </div>

    <table class="table table-bordered table-hover align-middle">
      <thead class="table-primary text-center">
        <tr>
          <th style="width:60px;">No</th>
          <th>NIS</th>
          <th>Nama</th>
          <th style="width:120px;">Kelas</th>
          <th style="width:220px;">Aksi</th>
        </tr>
      </thead>
      <tbody id="tbody_siswa">
        @foreach($data as $i => $row)
          <tr data-kelas="{{ $row->kelas }}">
            <td class="text-center">{{ $i+1 }}</td>
            <td>{{ $row->nis }}</td>
            <td>{{ $row->nama }}</td>
            <td class="text-center">{{ $row->kelas ?? 'Alumni' }}</td>
            <td class="text-center">
              <button
                class="btn btn-info btn-sm me-1 btn-detail"
                data-nis="{{ $row->nis }}"
                data-nama="{{ $row->nama }}"
                data-kelas="{{ $row->kelas }}"
                data-jurusan="{{ $row->jurusan }}"
                data-bs-toggle="modal"
                data-bs-target="#detailModal">
                <i class="bi bi-eye"></i> Detail
              </button>

              <button
                class="btn btn-success btn-sm btn-bayar"
                data-id="{{ $row->id }}"
                data-nis="{{ $row->nis }}"
                data-nama="{{ $row->nama }}"
                data-kelas="{{ $row->kelas }}"
                data-bs-toggle="modal"
                data-bs-target="#modalBayar">
                <i class="bi bi-cash"></i> Bayar
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- MODAL DETAIL --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title"><i class="bi bi-card-list me-2"></i>Detail Pembayaran Siswa</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-2 mb-3">
          <div class="col-md-3"><small class="text-muted d-block">NIS</small><strong id="detailNis">-</strong></div>
          <div class="col-md-5"><small class="text-muted d-block">Nama</small><strong id="detailNama">-</strong></div>
          <div class="col-md-2"><small class="text-muted d-block">Kelas</small><strong id="detailKelas">-</strong></div>
          <div class="col-md-2"><small class="text-muted d-block">Jurusan</small><strong id="detailJurusan">-</strong></div>
        </div>

        <div class="table-responsive">
          <table class="table table-sm table-bordered">
            <thead class="table-light">
              <tr>
                <th style="width:140px;">Tanggal</th>
                <th>Jenis Pembayaran</th>
                <th style="width:160px;" class="text-end">Jumlah</th>
                <th style="width:120px;" class="text-center">Status</th>
              </tr>
            </thead>
            <tbody id="detailRiwayat">
              <tr><td colspan="4" class="text-center">Memuat...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- MODAL BAYAR --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Modal Form Pembayaran -->
<div class="modal fade" id="modalBayar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title"><i class="bi bi-cash-stack me-2"></i>Form Pembayaran</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="formBayar" method="POST" action="{{ route('pembayaran.store') }}">
          @csrf
          <input type="hidden" name="siswa_id" id="siswa_id">

          <div class="mb-3">
            <label class="form-label">NIS</label>
            <input type="text" class="form-control" id="nis" readonly>
          </div>

          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" readonly>
          </div>

          <div class="mb-3">
            <label class="form-label">Jenis Pembayaran</label>
            <select class="form-control" id="jenis_pembayaran" name="jenis_pembayaran_id" required>
              <option value="">-- Pilih Jenis --</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Total Tagihan</label>
            <input type="text" class="form-control" id="total_tagihan" readonly>
          </div>

          <div class="mb-3">
            <label class="form-label">Sudah Dibayar</label>
            <input type="text" class="form-control" id="sudah_dibayar" readonly>
          </div>

          <div class="mb-3">
            <label class="form-label">Sisa Tagihan</label>
            <input type="text" class="form-control" id="sisa_tagihan" readonly>
          </div>

          <div class="mb-3">
            <label class="form-label">Jumlah Bayar Saat Ini</label>
            <input type="number" class="form-control" name="jumlah" id="jumlah_bayar"
                   placeholder="Masukkan nominal pembayaran" min="0" step="1" required>
          </div>

          <div class="form-group">
            <label for="keterangan">Keterangan / Status</label>
            <select name="keterangan" id="keterangan" class="form-control">
                <option value="">-- Pilih Status --</option>
                <option value="Lunas">Lunas</option>
                <option value="Cicil">Cicil</option>
                <option value="Belum Lunas">Belum Lunas</option>
            </select>
          </div>

          <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-success flex-fill">
              <i class="bi bi-save me-2"></i>Simpan Pembayaran
            </button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
// --- helper format rupiah ---
function rupiah(n) {
  if (n === null || n === undefined) return 'Rp 0';
  const num = Number(n) || 0;
  return 'Rp ' + num.toLocaleString('id-ID');
}

// --- filter kelas (client-side berdasar atribut data-kelas di <tr>) ---
    document.getElementById('filter_kelas').addEventListener('change', function(){
  const val = this.value;
  document.querySelectorAll('#tbody_siswa tr').forEach(tr => {
    let kelas = tr.getAttribute('data-kelas') || '';
    if (!val) {
      tr.style.display = '';
    } else if (val === 'alumni') {
      tr.style.display = (!kelas || kelas.toLowerCase() === 'alumni') ? '' : 'none';
    } else {
      tr.style.display = (kelas === val) ? '' : 'none';
    }
  });
});


// --- EVENT: tombol Detail & Bayar (delegation) ---
document.addEventListener('click', function(e){
  const btn = e.target.closest('.btn-detail, .btn-bayar');
  if (!btn) return;

  const nis     = btn.dataset.nis;
  const nama    = btn.dataset.nama;
  const kelas   = btn.dataset.kelas || '';
  const jurusan = btn.dataset.jurusan || '';
  const siswaId = btn.dataset.id;

  // DETAIL
  if (btn.classList.contains('btn-detail')) {
    document.getElementById('detailNis').textContent = nis || '-';
    document.getElementById('detailNama').textContent = nama || '-';
    document.getElementById('detailKelas').textContent = kelas || '-';
    document.getElementById('detailJurusan').textContent = jurusan || '-';

    const tbody = document.getElementById('detailRiwayat');
    tbody.innerHTML = '<tr><td colspan="4" class="text-center">Memuat...</td></tr>';

    fetch('/pembayaran/history/' + encodeURIComponent(nis))
      .then(r => r.json())
      .then(list => {
        if (!Array.isArray(list) || !list.length) {
          tbody.innerHTML = '<tr><td colspan="4" class="text-center">Belum ada pembayaran</td></tr>';
          return;
        }
        tbody.innerHTML = list.map(it => `
          <tr>
            <td>${it.tanggal ?? '-'}</td>
            <td>${it.jenis_pembayaran ?? '-'}</td>
            <td class="text-end">${rupiah(it.jumlah)}</td>
            <td class="text-center">${it.keterangan ?? '-'}</td>
          </tr>
        `).join('');
      })
      .catch(() => tbody.innerHTML = '<tr><td colspan="4" class="text-center text-danger">Gagal memuat riwayat</td></tr>');
  }

  // BAYAR
  if (btn.classList.contains('btn-bayar')) {
    // kosongkan dulu
    document.getElementById('siswa_id').value = '';
    document.getElementById('nis').value = '';
    document.getElementById('nama').value = '';
    document.getElementById('jenis_pembayaran').innerHTML = '<option value="">-- Pilih Jenis --</option>';
    document.getElementById('total_tagihan').value = '';
    document.getElementById('sudah_dibayar').value = '';
    document.getElementById('sisa_tagihan').value = '';
    document.getElementById('jumlah_bayar').value = '';

    fetch('/pembayaran/get-siswa/' + encodeURIComponent(siswaId))
      .then(r => r.json())
      .then(res => {
        // isi NIS & Nama
        document.getElementById('siswa_id').value = res.id ?? '';
        document.getElementById('nis').value = res.nis ?? '';
        document.getElementById('nama').value = res.nama ?? '';

        // isi dropdown jenis
        const sel = document.getElementById('jenis_pembayaran');
        (res.jenis || []).forEach(j => {
          const opt = document.createElement('option');
          opt.value = j.id;
          opt.textContent = j.nama_jenis; // pastikan controller kirim 'nama_jenis'
          sel.appendChild(opt);
        });
      })
      .catch(() => alert('Gagal mengambil data siswa.'));
  }
});

// fungsi untuk refresh riwayat setelah simpan
function loadRiwayat(nis) {
    const tbody = document.getElementById('detailRiwayat');
    tbody.innerHTML = '<tr><td colspan="4" class="text-center">Memuat...</td></tr>';

    fetch('/pembayaran/history/' + encodeURIComponent(nis))
      .then(r => r.json())
      .then(list => {
        if (!Array.isArray(list) || !list.length) {
          tbody.innerHTML = '<tr><td colspan="4" class="text-center">Belum ada pembayaran</td></tr>';
          return;
        }
        tbody.innerHTML = list.map(it => `
          <tr>
            <td>${it.tanggal ?? '-'}</td>
            <td>${it.jenis ?? '-'}</td>
            <td class="text-end">${rupiah(it.jumlah)}</td>
            <td class="text-center">${it.keterangan ?? '-'}</td>
          </tr>
        `).join('');
      })
      .catch(() => {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center text-danger">Gagal memuat riwayat</td></tr>';
      });
}

// handle submit form pembayaran
document.getElementById('formBayar').addEventListener('submit', function(e) {
    e.preventDefault(); // cegah reload

    const form = this;
    const url = form.action;
    const formData = new FormData(form);

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            alert(res.message);
            bootstrap.Modal.getInstance(document.getElementById('modalBayar')).hide();
            loadRiwayat(document.getElementById('nis').value);
        } else {
            alert('Gagal menyimpan pembayaran');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Terjadi kesalahan koneksi.');
    });
});


// --- EVENT: pilih jenis pembayaran -> hitung tagihan ---
document.getElementById('jenis_pembayaran').addEventListener('change', function(){
  const jenisId = this.value;
  const siswaId = document.getElementById('siswa_id').value;
  if (!jenisId || !siswaId) return;

  fetch(`/pembayaran/get-tagihan/${encodeURIComponent(siswaId)}/${encodeURIComponent(jenisId)}`)
    .then(r => r.json())
    .then(res => {
      document.getElementById('total_tagihan').value = rupiah(res.total);
      document.getElementById('sudah_dibayar').value = rupiah(res.sudah_dibayar);
      document.getElementById('sisa_tagihan').value = rupiah(res.sisa);
    })
    .catch(() => {
      document.getElementById('total_tagihan').value = '';
      document.getElementById('sudah_dibayar').value = '';
      document.getElementById('sisa_tagihan').value = '';
      alert('Gagal mengambil data tagihan.');
    });
});

document.getElementById('formPembayaran').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('/pembayaran/save', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            alert(res.message);
            // reset form
            this.reset();
            // refresh riwayat otomatis
            const nis = document.getElementById('nis').value;
            loadRiwayatPembayaran(nis);
        } else {
            alert('Gagal menyimpan pembayaran');
        }
    })
    .catch(() => alert('Terjadi kesalahan saat menyimpan.'));
});

function loadRiwayatPembayaran(nis) {
    const tbody = document.getElementById('detailRiwayat');
    tbody.innerHTML = '<tr><td colspan="4" class="text-center">Memuat...</td></tr>';

    fetch('/pembayaran/history/' + encodeURIComponent(nis))
      .then(r => r.json())
      .then(list => {
        if (!Array.isArray(list) || !list.length) {
          tbody.innerHTML = '<tr><td colspan="4" class="text-center">Belum ada pembayaran</td></tr>';
          return;
        }
        tbody.innerHTML = list.map(it => `
          <tr>
            <td>${it.tanggal ?? '-'}</td>
            <td>${it.jenis ?? '-'}</td>
            <td class="text-end">${rupiah(it.jumlah)}</td>
            <td class="text-center">${it.status ?? '-'}</td>
          </tr>
        `).join('');
      })
      .catch(() => tbody.innerHTML = '<tr><td colspan="4" class="text-center text-danger">Gagal memuat riwayat</td></tr>');
}

</script>
@endsection
