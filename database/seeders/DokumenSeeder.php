<?php

namespace Database\Seeders;

use App\Models\Dokumen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dokumen::create([
            'id' => 1,
            'kategori_id' => 1,
            'user_id' => 1,
        ]);
        Dokumen::create([
            'id' => 2,
            'kategori_id' => 1,
            'user_id' => 2,
        ]);
        Dokumen::create([
            'id' => 3,
            'kategori_id' => 2,
            'user_id' => 1,
        ]);
        Dokumen::create([
            'id' => 4,
            'kategori_id' => 3,
            'user_id' => 1,
        ]);
        Dokumen::create([
            'id' => 5,
            'kategori_id' => 1,
            'user_id' => 3,
        ]);
        Dokumen::create([
            'id' => 6,
            'kategori_id' => 4,
            'user_id' => 3,
        ]);
    }
}
