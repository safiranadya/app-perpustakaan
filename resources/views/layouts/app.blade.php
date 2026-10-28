<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan')</title>

    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #f3f4f6; }
        .btn { padding: 6px 12px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; display: inline-block; }
        .btn-sm { padding: 4px 8px; font-size: 12px; }
        .btn-success { background: #16a34a; }
        .stats-grid { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px; }
        .stat-card { flex: 1; min-width: 160px; background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; text-align: center; }
        .stat-card .value { font-size: 32px; font-weight: bold; color: #1e3a8a; }
        .stat-card .label { margin-top: 6px; color: #6b7280; font-size: 14px; }
        .pagination { margin-top: 16px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
        .pagination a { color: #2563eb; text-decoration: none; }
        .pagination a:hover { text-decoration: underline; }
        .pagination .pagination-current { font-weight: bold; color: #1e3a8a; }
        .pagination .pagination-disabled { color: #9ca3af; }
        .btn-danger { background: #dc2626; }
        .inline { display: inline; }
        
        /* TUGAS 2: CSS Badge Status Berwarna */
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; color: white; display: inline-block; }
        .badge-dipinjam { background-color: #d97706; }    /* Warna Oranye */
        .badge-dikembalikan { background-color: #16a34a; }/* Warna Hijau */
        .badge-terlambat { background-color: #dc2626; }   /* Warna Merah */
    </style>
</head>
<body>
    <nav style="margin-bottom: 20px;">
        <a href="{{ route('books.index') }}">Buku</a> |
        <a href="{{ route('categories.index') }}">Kategori</a> |
        <a href="{{ route('members.index') }}">Anggota</a> |
        <a href="{{ route('loans.index') }}">Peminjaman</a>
    </nav>

    @if(session('success'))
        <div style="background: #dcfce7; color: #15803d; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</body>
</html>