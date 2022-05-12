<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'id' => 1,
            'nama_kategori' => 'Kategori 1',
            'detail' => 'Detail Kategori 1',
        ]);
        Kategori::create([
            'id' => 2,
            'nama_kategori' => 'Kategori 2',
            'detail' => 'Detail Kategori 2',
        ]);
        Kategori::create([
            'id' => 3,
            'nama_kategori' => 'Kategori 3',
            'detail' => 'Detail Kategori 3',
        ]);
        Kategori::create([
            'id' => 4,
            'nama_kategori' => 'Kategori 4',
            'detail' => 'Detail Kategori 4',
        ]);
    }
}
