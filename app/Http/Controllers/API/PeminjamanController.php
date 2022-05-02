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
                'nama_peminjaman' => 'required',
                'detail' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], '201');
        }

        $Peminjaman = new Peminjaman();
        $Peminjaman->nama_peminjaman = $request->nama_peminjaman;
        $Peminjaman->detail = $request->detail;
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
            'nama_peminjaman' => $request->nama_peminjaman,
            'detail' => $request->detail,

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
