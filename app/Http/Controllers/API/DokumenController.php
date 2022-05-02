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
                'nama_dokumen' => 'required',
                'detail' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], '201');
        }

        $Dokumen = new Dokumen();
        $Dokumen->nama_dokumen = $request->nama_dokumen;
        $Dokumen->detail = $request->detail;
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

        $Dokumen = Dokumen::find($Dokumen->id)->update([
            'nama_dokumen' => $request->nama_dokumen,
            'detail' => $request->detail,

        ]);

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
