<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin - Keuangan Sekolah')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark border-end text-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold">S-Keuangan</div>
        <div class="list-group list-group-flush my-3">
            <a href="{{ route('halutama') }}" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="{{ route('siswa') }}" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="bi bi-person-lines-fill me-2"></i> Data Siswa
            </a>

            <!-- Transaksi -->
            <a class="list-group-item list-group-item-action bg-dark text-white" data-bs-toggle="collapse" href="#submenuTransaksi">
                <i class="bi bi-cash-coin me-2"></i> Transaksi <i class="bi bi-chevron-down float-end"></i>
            </a>
            <div class="collapse ms-3" id="submenuTransaksi">
                <a href="{{ route('pembayaran')}}" class="list-group-item list-group-item-action bg-dark text-white border-0">Pembayaran</a>
                <a href="{{ route('pengeluaran.index')}}" class="list-group-item list-group-item-action bg-dark text-white border-0">Pengeluaran</a>
                <a href="{{ route('transaksi.kas')}}" class="list-group-item list-group-item-action bg-dark text-white border-0">KAS</a>
                <a href="{{ route('tabungan')}}" class="list-group-item list-group-item-action bg-dark text-white border-0">Tabungan Siswa</a>
            </div>

            <!-- Laporan -->
            <a class="list-group-item list-group-item-action bg-dark text-white" data-bs-toggle="collapse" href="#submenuLaporan">
                <i class="bi bi-journal-text me-2"></i> Laporan <i class="bi bi-chevron-down float-end"></i>
            </a>
            <div class="collapse ms-3" id="submenuLaporan">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0">Laporan Harian</a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0">Laporan Bulanan</a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0">Rekap Tabungan</a>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="list-group-item list-group-item-action bg-dark text-white border-0">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
            
        </div>
    </div>

    <!-- Konten -->
    <div id="page-content-wrapper" class="w-100">
        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')

</body>
</html>
