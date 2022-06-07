<?php

namespace App\Http\Helpers;

use App\Models\Peminjaman;

class Helper
{
    public static function test()
    {
        return 'test';
    }

    public static function cek_batasan_dokumen($id)
    {
        $peminjaman = Peminjaman::where('dokumen_id', $id)->where('status', 0)->get();
        if ($peminjaman->count() > 0) {
            return False;
        } else{
            return True;
        }
    }
}
