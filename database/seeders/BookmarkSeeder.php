<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bookmark::create([
            'id' => 1,
            'dokumen_id' => 1,
            'user_id' => 1,
        ]);
        Bookmark::create([
            'id' => 2,
            'dokumen_id' => 1,
            'user_id' => 2,
        ]);
        Bookmark::create([
            'id' => 3,
            'dokumen_id' => 2,
            'user_id' => 2,
        ]);
        Bookmark::create([
            'id' => 4,
            'dokumen_id' => 3,
            'user_id' => 1,
        ]);
        Bookmark::create([
            'id' => 5,
            'dokumen_id' => 1,
            'user_id' => 3,
        ]);
    }
}
