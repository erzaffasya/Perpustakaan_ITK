<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DokumenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'kategori_id' => $this->kategori->nama_kategori,
            'tahun_terbit' => $this->tahun_terbit,
            'nama_pengarang' => $this->judul,
            'penerbit' => $this->penerbit,
            'user_id' => $this->users->name,
            'cover' => $this->cover,
            'lembar_pengesahan' => $this->lembar_pengesahan,
            'kata_pengantar' => $this->kata_pengantar,
            'ringkasan' => $this->ringkasan,
            'daftar_isi' => $this->daftar_isi,
            'daftar_gambar' => $this->daftar_gambar,
            'daftar_tabel' => $this->daftar_tabel,
            'daftar_notasi' => $this->daftar_notasi,
            'lampiran' => $this->lampiran,
            'bab1' => $this->bab1,
            'bab2' => $this->bab2,
            'bab3' => $this->bab3,
            'bab4' => $this->bab4,
            'full_dokumen' => $this->full_dokumen,
            'status' => $this->status,
            'data_tambahan' => $this->data_tambahan,
            'jurusan' => $this->users->jurusan,
            'tanggal_dibuat' => date('d M Y', strtotime($this->created_at))
        ];
    }
}
