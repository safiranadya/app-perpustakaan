<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;  // <-- Wajib ditambahkan
use App\Models\Book;    // <-- Wajib ditambahkan
use App\Models\User;    // <-- Wajib ditambahkan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoanController extends Controller
{
    // ...
    // ...
    public function index()
    {
        $loans = Loan::with(['member', 'user', 'loanItems.book'])->paginate(10);
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::all();
        $books = Book::all();
        $users = User::all();

        return view('loans.create', compact('members', 'books', 'users'));
    }

    public function store(Request $request)
    {
        // 1. Buat user default jika tabel users masih kosong (pencegahan foreign key error)
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name'     => 'Admin Perpustakaan',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }

        // 2. Validasi input
        $validated = $request->validate([
            'member_id'       => 'required|exists:members,id',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'book_ids'        => 'required|array|min:1',
            'book_ids.*'      => 'exists:books,id',
        ]);

        // 3. Simpan transaksi utama peminjaman
        $loan = Loan::create([
            'member_id'       => $validated['member_id'],
            'user_id'         => $request->user_id ?? Auth::id() ?? $user->id,
            'tanggal_pinjam'  => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status'          => 'dipinjam',
        ]);

        // 4. Simpan setiap buku yang dipilih ke tabel loan_items
        foreach ($validated['book_ids'] as $bookId) {
            $loan->loanItems()->create([
                'book_id' => $bookId,
            ]);
        }

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil dibuat.');
    }

    public function show(string $id)
    {
        $loan = Loan::with(['member', 'user', 'loanItems.book'])->findOrFail($id);
        return view('loans.show', compact('loan'));
    }

    public function edit(string $id)
    {
        $loan = Loan::with(['member', 'user', 'loanItems.book'])->findOrFail($id);
        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

        $validated = $request->validate([
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'status'          => 'required|in:dipinjam,dikembalikan,terlambat',
        ]);

        $loan->update($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->loanItems()->delete();
        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil dihapus.');
    }

    // TUGAS 1: Fitur Kembalikan Buku
    public function kembalikan(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update([
            'status'               => 'dikembalikan',
            'tanggal_dikembalikan' => now()->toDateString(),
        ]);

        return redirect()->route('loans.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }
}