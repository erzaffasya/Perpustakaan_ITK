<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PeminjamanRuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeminjamanRuanganController extends Controller
{
    public function index()
    {
        $PeminjamanRuangan = PeminjamanRuangan::all();
        return $this->successResponse($PeminjamanRuangan);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required',
                'kursi_baca_id' => 'required',
                'tanggal_peminjaman' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $PeminjamanRuangan = new PeminjamanRuangan();
        $PeminjamanRuangan->user_id = $request->user_id;
        $PeminjamanRuangan->kursi_baca_id = $request->kursi_baca_id;
        $PeminjamanRuangan->tanggal_peminjaman = $request->tanggal_peminjaman;
        $PeminjamanRuangan->save();

        return $this->successResponse(['status' => true, 'message' => 'PeminjamanRuangan Berhasil Ditambahkan']);
    }

    public function show($id)
    {
        $PeminjamanRuangan = PeminjamanRuangan::find($id);
        if (!$PeminjamanRuangan) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        return $this->successResponse($PeminjamanRuangan);
    }

    public function update(Request $request, $id)
    {

        $PeminjamanRuangan = PeminjamanRuangan::find($id);
        if (!$PeminjamanRuangan) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        $PeminjamanRuangan = PeminjamanRuangan::find($PeminjamanRuangan->id)->update([
            'user_id' => $request->user_id,
            'kursi_baca_id' => $request->kursi_baca_id,
            'kursi_baca_id_baca_id' => $request->tanggal_peminjaman,

        ]);

        return $this->successResponse(['status' => true, 'message' => 'PeminjamanRuangan Berhasil Diubah']);
    }

    public function destroy($id)
    {
        $PeminjamanRuangan = PeminjamanRuangan::find($id);
        if (!$PeminjamanRuangan) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        $PeminjamanRuangan->delete();
        return $this->successResponse(['status' => true, 'message' => 'PeminjamanRuangan Berhasil Dihapus']);
    }
}
