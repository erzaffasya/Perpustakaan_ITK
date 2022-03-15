<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $fillable = [
        'dokumen_id',
        'user_id',
        'tgl_pengembalian',
        'tgl_kembali',
        'denda',
    ];

    protected $primaryKey = 'id';

    protected $casts = [ 
        'user_id' => 'integer', 
        'dokumen_id' => 'integer', ];

    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class, 'dokumen_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
