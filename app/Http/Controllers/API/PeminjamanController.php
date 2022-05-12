<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Api
{
    public function index()
    {
        $Peminjaman = Peminjaman::all();
        return $this->successResponse($Peminjaman);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tgl_peminjaman' => 'required',
                'tgl_pengembalian' => 'required',
                'status' => 'required',
                'dokumen_id' => 'required',
                'user_id' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], '201');
        }

        $Peminjaman = new Peminjaman($request->all());
        $Peminjaman->save();

        return $this->successResponse(['status' => true, 'message' => 'Peminjaman Berhasil Ditambahkan']);
    }

    public function show($id)
    {
        $Peminjaman = Peminjaman::find($id);
        if (!$Peminjaman) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        return $this->successResponse($Peminjaman);
    }

    public function update(Request $request, $id)
    {

        $Peminjaman = Peminjaman::find($id);
        if (!$Peminjaman) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        $Peminjaman = Peminjaman::find($Peminjaman->id)->update([
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'status' => $request->status,
            'dokumen_id' => $request->dokumen_id,
            'user_id' => $request->user_id,
        ]);

        return $this->successResponse(['status' => true, 'message' => 'Peminjaman Berhasil Diubah']);
    }

    public function destroy($id)
    {
        $Peminjaman = Peminjaman::find($id);
        if (!$Peminjaman) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        $Peminjaman->delete();
        return $this->successResponse(['status' => true, 'message' => 'Peminjaman Berhasil Dihapus']);
    }
}
