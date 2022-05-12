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
            'dokumen_id' => '1',
            'user_id' => 1,
        ]);
    }
}
