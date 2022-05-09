<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookmarkController extends Api
{
    public function index()
    {
        $Bookmark = Bookmark::all();
        return $this->successResponse($Bookmark);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_bookmark' => 'required',
                'detail' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], '201');
        }

        $Bookmark = new Bookmark();
        $Bookmark->nama_bookmark = $request->nama_bookmark;
        $Bookmark->detail = $request->detail;
        $Bookmark->save();

        return $this->successResponse(['status' => true, 'message' => 'Bookmark Berhasil Ditambahkan']);
    }

    public function show($id)
    {
        $Bookmark = Bookmark::find($id);
        if (!$Bookmark) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        return $this->successResponse($Bookmark);
    }

    public function update(Request $request, $id)
    {

        $Bookmark = Bookmark::find($id);
        if (!$Bookmark) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        $Bookmark = Bookmark::find($Bookmark->id)->update([
            'nama_bookmark' => $request->nama_bookmark,
            'detail' => $request->detail,

        ]);

        return $this->successResponse(['status' => true, 'message' => 'Bookmark Berhasil Diubah']);
    }

    public function destroy($id)
    {
        $Bookmark = Bookmark::find($id);
        if (!$Bookmark) {
            return $this->errorResponse('Data tidak ditemukan', 201);
        }

        $Bookmark->delete();
        return $this->successResponse(['status' => true, 'message' => 'Bookmark Berhasil Dihapus']);
    }
}
