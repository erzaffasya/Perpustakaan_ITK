<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KursiBaca;
use App\Models\PeminjamanRuangan;
use App\Models\RuanganBaca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeminjamanRuanganController extends Api
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

        $cekRuangan = PeminjamanRuangan::where('kursi_baca_id', $request->kursi_baca_id)
            ->where('tanggal_peminjaman', $request->tanggal_peminjaman)
            ->first();

        if ($cekRuangan == null) {
            $PeminjamanRuangan = new PeminjamanRuangan();
            $PeminjamanRuangan->user_id = $request->user_id;
            $PeminjamanRuangan->kursi_baca_id = $request->kursi_baca_id;
            $PeminjamanRuangan->tanggal_peminjaman = $request->tanggal_peminjaman;
            $PeminjamanRuangan->save();
            return $this->successResponse(['status' => true, 'message' => 'PeminjamanRuangan Berhasil Ditambahkan']);
        } else {
            return $this->errorResponse(['status' => false, 'message' => 'Kursi Sudah Dibooking'], 403);
        }
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
    public function RuanganKosong($ruangan, $tanggal)
    {
        $Ruangan1 = KursiBaca::where('ruangan_baca_id', '=', $ruangan)->get();       //kursi where ruangan
        // ruangan kosong = error
        foreach ($Ruangan1 as $item) {
            $cekKursi = PeminjamanRuangan::where('kursi_baca_id', '=', $item->id)->where('tanggal_peminjaman', '=', $tanggal)->first();

            if ($cekKursi == null) {
                $data = 'Tersedia';
            } else {
                $data = 'Tidak Tersedia';
            }

            $Ruangan[] = array_merge([
                'id' => $item->id,
                'nama_kursi' => $item->kursi,
                'status_kursi' => $item->status_kursi
            ], ['status_kursi' => $data]);
        }
        return $Ruangan;
    }
}
