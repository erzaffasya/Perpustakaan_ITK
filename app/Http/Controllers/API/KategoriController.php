<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Api
{
    public function index()
    {
        $Kategori = Kategori::all();
        return $this->successResponse($Kategori);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_kategori' => 'required',
                'detail' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], '201');
        }

        $Kategori = new Kategori();
        $Kategori->nama_kategori = $request->nama_kategori;
        $Kategori->detail = $request->detail;
        $Kategori->save();

        return $this->successResponse(['status' => true, 'message' => 'Kategori Berhasil Ditambahkan']);
    }

    public function show($id)
    {
        $Kategori = Kategori::find($id);
        if (!$Kategori) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }
        
        return $this->successResponse($Kategori);
    }

    public function update(Request $request, $id)
    {

        $Kategori = Kategori::find($id);
        if (!$Kategori) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        $Kategori = Kategori::find($Kategori->id)->update([
            'nama_kategori' => $request->nama_kategori,
            'detail' => $request->detail,

        ]);

        return $this->successResponse(['status' => true, 'message' => 'Kategori Berhasil Diubah']);
    }

    public function destroy($id)
    {
        $Kategori = Kategori::find($id);
        if (!$Kategori) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        $Kategori->delete();
        return $this->successResponse(['status' => true, 'message' => 'Kategori Berhasil Dihapus']);
    }
}
