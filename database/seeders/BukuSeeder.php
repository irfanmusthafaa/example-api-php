<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buku::create([
            'judul' => 'Laravel untuk Pemula',
            'penulis' => 'Andi Wijaya',
            'tahun_terbit' => 2023,
            'penerbit' => 'Informatika',
            'isbn' => '9786021234567'
        ]);

        Buku::create([
            'judul' => 'Belajar PHP Modern',
            'penulis' => 'Budi Santoso',
            'tahun_terbit' => 2022,
            'penerbit' => 'Gramedia',
            'isbn' => '9786027654321'
        ]);
    }
}
