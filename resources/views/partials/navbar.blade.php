{{-- File: resources/views/partials/navbar.blade.php --}}
<nav>
    <div class="brand">📚 Perpustakaan Digital Kampus</div>
    <ul>
    <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
    <li><a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'active' : '' }}">Buku</a></li>
    @if (auth()->user()->role === 'admin')
        <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Kategori</a></li>
    @endif
    <li><a href="{{ route('members.index') }}" class="{{ request()->routeIs('members.*') ? 'active' : '' }}">Anggota</a></li>
    <li><a href="{{ route('loans.index') }}" class="{{ request()->routeIs('loans.index') || request()->routeIs('loans.create') || request()->routeIs('loans.show') || request()->routeIs('loans.edit') ? 'active' : '' }}">Peminjaman</a></li>
    <li><a href="{{ route('loans.report') }}" class="{{ request()->routeIs('loans.report') ? 'active' : '' }}">Laporan</a></li>
</ul>