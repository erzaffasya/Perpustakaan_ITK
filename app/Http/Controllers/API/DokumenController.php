<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokumenController extends Api
{
    public function index()
    {
        $Dokumen = Dokumen::all();
        return $this->successResponse($Dokumen);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required',
                'kategori_id' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], '201');
        }



        $Dokumen = new Dokumen();
        $Dokumen->judul = $request->judul;
        $Dokumen->kategori_id = $request->kategori_id;
        $Dokumen->tahun_terbit = $request->tahun_terbit;
        $Dokumen->nama_pengarang = $request->nama_pengarang;
        $Dokumen->penerbit = $request->penerbit;
        $Dokumen->user_id = $request->user_id;

        // Cover 
        if ($request->cover != null) {
            $file_ext = $request->cover->extension();
            $file_name = 'cover_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $cover = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->cover->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->cover = $cover;
        }

        // abstract_en 
        if ($request->abstract_en != null) {
            $file_ext = $request->abstract_en->extension();
            $file_name = 'abstract_en_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $abstract_en = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->abstract_en->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->abstract_en = $abstract_en;
        }

        // abstract_id 
        if ($request->abstract_id != null) {
            $file_ext = $request->abstract_id->extension();
            $file_name = 'abstract_id_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $abstract_id = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->abstract_id->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->abstract_id = $abstract_id;
        }

        // bab1 
        if ($request->bab1 != null) {
            $file_ext = $request->bab1->extension();
            $file_name = 'bab1_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $bab1 = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->bab1->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->bab1 = $bab1;
        }

        // bab2 
        if ($request->bab2 != null) {
            $file_ext = $request->bab2->extension();
            $file_name = 'bab2_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $bab2 = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->bab2->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->bab2 = $bab2;
        }

        // bab3 
        if ($request->bab3 != null) {
            $file_ext = $request->bab3->extension();
            $file_name = 'bab3_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $bab3 = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->bab2->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->bab3 = $bab3;
        }

        // bab4 
        if ($request->bab4 != null) {
            $file_ext = $request->bab4->extension();
            $file_name = 'bab4_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $bab4 = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->bab4->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->bab4 = $bab4;
        }

        // kesimpulan 
        if ($request->kesimpulan != null) {
            $file_ext = $request->kesimpulan->extension();
            $file_name = 'kesimpulan_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $kesimpulan = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->kesimpulan->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->kesimpulan = $kesimpulan;
        }

        // daftar_pustaka 
        if ($request->daftar_pustaka != null) {
            $file_ext = $request->daftar_pustaka->extension();
            $file_name = 'daftar_pustaka_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $daftar_pustaka = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->daftar_pustaka->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->daftar_pustaka = $daftar_pustaka;
        }

        // paper 
        if ($request->paper != null) {
            $file_ext = $request->paper->extension();
            $file_name = 'paper_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $paper = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->paper->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->paper = $paper;
        }

        // lembar_persetujuan 
        if ($request->lembar_persetujuan != null) {
            $file_ext = $request->lembar_persetujuan->extension();
            $file_name = 'lembar_persetujuan_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $lembar_persetujuan = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->lembar_persetujuan->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->lembar_persetujuan = $lembar_persetujuan;
        }

        // full_dokumen 
        if ($request->full_dokumen != null) {
            $file_ext = $request->full_dokumen->extension();
            $file_name = 'full_dokumen_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $full_dokumen = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->full_dokumen->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->full_dokumen = $full_dokumen;
        }

        $Dokumen->save();

        return $this->successResponse(['status' => true, 'message' => 'Dokumen Berhasil Ditambahkan']);
    }

    public function show($id)
    {
        $Dokumen = Dokumen::find($id);
        if (!$Dokumen) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        return $this->successResponse($Dokumen);
    }

    public function update(Request $request, $id)
    {

        $Dokumen = Dokumen::find($id);
        if (!$Dokumen) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        $Dokumen = Dokumen::find($Dokumen->id);

        $Dokumen->judul = $request->judul;
        if ($request->kategori_id != null) {
            $Dokumen->kategori_id = $request->kategori_id;
        }
        if ($request->user_id != null) {
            $Dokumen->user_id = $request->user_id;
        }
        $Dokumen->tahun_terbit = $request->tahun_terbit;
        $Dokumen->nama_pengarang = $request->nama_pengarang;
        $Dokumen->penerbit = $request->penerbit;
        $Dokumen->data_tambahan = $request->data_tambahan;

           // Cover 
           if ($request->cover != null) {
            $file_ext = $request->cover->extension();
            $file_name = 'cover_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $cover = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->cover->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->cover = $cover;
        }

        // abstract_en 
        if ($request->abstract_en != null) {
            $file_ext = $request->abstract_en->extension();
            $file_name = 'abstract_en_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $abstract_en = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->abstract_en->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->abstract_en = $abstract_en;
        }

        // abstract_id 
        if ($request->abstract_id != null) {
            $file_ext = $request->abstract_id->extension();
            $file_name = 'abstract_id_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $abstract_id = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->abstract_id->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->abstract_id = $abstract_id;
        }

        // bab1 
        if ($request->bab1 != null) {
            $file_ext = $request->bab1->extension();
            $file_name = 'bab1_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $bab1 = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->bab1->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->bab1 = $bab1;
        }

        // bab2 
        if ($request->bab2 != null) {
            $file_ext = $request->bab2->extension();
            $file_name = 'bab2_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $bab2 = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->bab2->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->bab2 = $bab2;
        }

        // bab3 
        if ($request->bab3 != null) {
            $file_ext = $request->bab3->extension();
            $file_name = 'bab3_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $bab3 = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->bab2->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->bab3 = $bab3;
        }

        // bab4 
        if ($request->bab4 != null) {
            $file_ext = $request->bab4->extension();
            $file_name = 'bab4_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $bab4 = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->bab4->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->bab4 = $bab4;
        }

        // kesimpulan 
        if ($request->kesimpulan != null) {
            $file_ext = $request->kesimpulan->extension();
            $file_name = 'kesimpulan_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $kesimpulan = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->kesimpulan->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->kesimpulan = $kesimpulan;
        }

        // daftar_pustaka 
        if ($request->daftar_pustaka != null) {
            $file_ext = $request->daftar_pustaka->extension();
            $file_name = 'daftar_pustaka_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $daftar_pustaka = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->daftar_pustaka->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->daftar_pustaka = $daftar_pustaka;
        }

        // paper 
        if ($request->paper != null) {
            $file_ext = $request->paper->extension();
            $file_name = 'paper_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $paper = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->paper->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->paper = $paper;
        }

        // lembar_persetujuan 
        if ($request->lembar_persetujuan != null) {
            $file_ext = $request->lembar_persetujuan->extension();
            $file_name = 'lembar_persetujuan_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $lembar_persetujuan = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->lembar_persetujuan->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->lembar_persetujuan = $lembar_persetujuan;
        }

        // full_dokumen 
        if ($request->full_dokumen != null) {
            $file_ext = $request->full_dokumen->extension();
            $file_name = 'full_dokumen_' . $request->user_id . '_' . time() . '.' . $file_ext;
            $full_dokumen = 'storage/documents/' . $request->user_id . '/' . $file_name;
            $request->full_dokumen->storeAs('public/documents/' . $request->user_id . '/' . $file_name);
            $Dokumen->full_dokumen = $full_dokumen;
        }
        $Dokumen->save();

        return $this->successResponse(['status' => true, 'message' => 'Dokumen Berhasil Diubah']);
    }

    public function destroy($id)
    {
        $Dokumen = Dokumen::find($id);
        if (!$Dokumen) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        $Dokumen->delete();
        return $this->successResponse(['status' => true, 'message' => 'Dokumen Berhasil Dihapus']);
    }
}
