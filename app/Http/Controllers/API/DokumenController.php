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

        $Dokumen = new Dokumen($request->all());
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
        if($request->kategori_id != null){
            $Dokumen->kategori_id = $request->kategori_id;
        }
        if($request->user_id != null){
        $Dokumen->user_id = $request->user_id;
        }
        $Dokumen->tahun_terbit = $request->tahun_terbit;
        $Dokumen->nama_pengarang = $request->nama_pengarang;
        $Dokumen->penerbit = $request->penerbit;
        $Dokumen->cover = $request->cover;
        $Dokumen->abstract_en = $request->abstract_en;
        $Dokumen->abstract_id = $request->abstract_id;
        $Dokumen->bab1 = $request->bab1;
        $Dokumen->bab2 = $request->bab2;
        $Dokumen->bab3 = $request->bab3;
        $Dokumen->bab4 = $request->bab4;
        $Dokumen->kesimpulan = $request->kesimpulan;
        $Dokumen->daftar_pustaka = $request->daftar_pustaka;
        $Dokumen->paper = $request->paper;
        $Dokumen->lembar_persetujuan = $request->lembar_persetujuan;
        $Dokumen->full_dokumen = $request->full_dokumen;
        $Dokumen->data_tambahan = $request->data_tambahan;
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
