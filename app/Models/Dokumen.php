<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'akses_kelas';
    protected $fillable = [
        'user_id',
        'mata_kuliah_id',
    ];

    protected $primaryKey = 'id';

    protected $casts = [ 
        'user_id' => 'integer', 
        'mata_kuliah_id' => 'integer', ];

    public function matkul()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id', 'id');
    }
}
