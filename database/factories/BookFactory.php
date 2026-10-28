<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected array $judulPerKategori = [
        'Novel' => ['Laskar Pelangi', 'Bumi Manusia', 'Negeri 5 Menara', 'Ronggeng Dukuh Paruk', 'Ayat-Ayat Cinta', 'Pulang', 'Cantik Itu Luka', 'Sang Pemimpi', 'Perahu Kertas', 'Gadis Kretek'],
        'Komik' => ['Si Juki: Kuliah Kerja Nyata', 'Garudayana', 'Wonder Wayang', 'Tuti and Friends', 'Nusantaranger'],
        'Sains' => ['Pengantar Fisika Dasar', 'Kimia Organik untuk Pemula', 'Biologi Sel dan Molekuler', 'Astronomi: Menjelajah Alam Semesta'],
        'Teknologi' => ['Dasar Pemrograman dengan PHP', 'Algoritma dan Struktur Data', 'Jaringan Komputer Modern', 'Kecerdasan Buatan untuk Pemula', 'Pengantar Basis Data'],
        'Sejarah' => ['Sejarah Indonesia Modern', 'Proklamasi dan Perjuangan Bangsa', 'Jejak Kerajaan Nusantara', 'Revolusi Indonesia 1945-1949'],
    ];

    protected array $penerbit = ['Gramedia Pustaka Utama', 'Mizan', 'Bentang Pustaka', 'Balai Pustaka', 'Erlangga', 'Andi Publisher', 'Informatika Bandung'];

    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $pool = $this->judulPerKategori[$category?->nama_kategori] ?? $this->judulPerKategori['Novel'];

        return [
            'judul' => fake()->randomElement($pool),
            'penulis' => fake()->name(),
            'penerbit' => fake()->randomElement($this->penerbit),
            'tahun_terbit' => fake()->numberBetween(1990, (int) date('Y')),
            'isbn' => fake()->unique()->isbn13(),
            'stok' => fake()->numberBetween(1, 10),
            'category_id' => $category?->id,
        ];
    }
}