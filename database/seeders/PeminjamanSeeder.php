<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Peminjaman::create([
            'id' => 1,
            'tgl_peminjaman' => '2022-05-12',
            'tgl_pengembalian' => '2022-05-14',
            'status' => 1,
            'dokumen_id' => 1,
            'user_id' => 1,
        ]);
        Peminjaman::create([
            'id' => 2,
            'tgl_peminjaman' => '2022-04-12',
            'tgl_pengembalian' => '2023-05-14',
            'status' => 0,
            'dokumen_id' => 1,
            'user_id' => 1,
        ]);
        Peminjaman::create([
            'id' => 3,
            'tgl_peminjaman' => '2022-05-12',
            'tgl_pengembalian' => '2022-05-14',
            'status' => 1,
            'dokumen_id' => 1,
            'user_id' => 2,
        ]);
        Peminjaman::create([
            'id' => 4,
            'tgl_peminjaman' => '2022-05-12',
            'tgl_pengembalian' => '2022-05-13',
            'status' => 1,
            'dokumen_id' => 2,
            'user_id' => 3,
        ]);
        Peminjaman::create([
            'id' => 5,
            'tgl_peminjaman' => '2022-05-12',
            'tgl_pengembalian' => '2022-12-14',
            'status' => 0,
            'dokumen_id' => 2,
            'user_id' => 3,
        ]);
        Peminjaman::create([
            'id' => 6,
            'tgl_peminjaman' => '2022-05-12',
            'tgl_pengembalian' => '2022-05-14',
            'status' => 1,
            'dokumen_id' => 3,
            'user_id' => 3,
        ]);
        Peminjaman::create([
            'id' => 7,
            'tgl_peminjaman' => '2022-05-12',
            'tgl_pengembalian' => '2023-05-14',
            'status' => 0,
            'dokumen_id' => 3,
            'user_id' => 2,
        ]);
    }
}
