<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DokumenResource;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DokumenController extends Api
{
    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            $Dokumen = DokumenResource::collection(Dokumen::all());
        } else {
            $Dokumen = DokumenResource::collection(Dokumen::where('user_id', Auth::user()->id)->get());
        }
        return $this->successResponse($Dokumen);
    }

    public function showfile()
    {
        // $dokumen = Dokumen::find($id);
        // switch ($data) {
        //     case 'cover':
        //         $file = $dokumen->cover;
                
        //     case 'abstract_en':
        //         $file = $dokumen->abstract_en;
                
        //     case 'abstract_id':
        //         $file = $dokumen->abstract_id;
                
        //     case 'bab1':
        //         $file = $dokumen->bab1;
                
        //     case 'bab2':
        //         $file = $dokumen->bab2;
                
        //     case 'bab3':
        //         $file = $dokumen->bab3;
                
        //     case 'bab4':
        //         $file = $dokumen->bab4;
                
        //     case 'kesimpulan':
        //         $file = $dokumen->kesimpulan;
                
        //     case 'daftar_pustaka':
        //         $file = $dokumen->daftar_pustaka;
                
        //     case 'paper':
        //         $file = $dokumen->paper;
                
        //     case 'lembar_persetujuan':
        //         $file = $dokumen->lembar_persetujuan;
                
        //     case 'full_dokumen':
        //         $file = $dokumen->full_dokumen;
                
        //     default:
        // }(storage_path('documents/1/cover_1_1658128910.pdf')
        $file = File::get(public_path('storage/documents/1/cover_1_1658128910.pdf'));
        $response = Response::make($file, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }
    public function view($id, $data)
    {
        $dokumen = Dokumen::find($id);
        switch ($data) {
            case 'cover':
                return redirect($dokumen->cover);
                break;
            case 'abstract_en':
                return redirect($dokumen->abstract_en);
                break;
            case 'abstract_id':
                return redirect($dokumen->abstract_id);
                break;
            case 'bab1':
                return redirect($dokumen->bab1);
                break;
            case 'bab2':
                return redirect($dokumen->bab2);
                break;
            case 'bab3':
                return redirect($dokumen->bab3);
                break;
            case 'bab4':
                return redirect($dokumen->bab4);
                break;
            case 'kesimpulan':
                return redirect($dokumen->kesimpulan);
                break;
            case 'daftar_pustaka':
                return redirect($dokumen->daftar_pustaka);
                break;
            case 'paper':
                return redirect($dokumen->paper);
                break;
            case 'lembar_persetujuan':
                return redirect($dokumen->lembar_persetujuan);
                break;
            case 'full_dokumen':
                return redirect($dokumen->full_dokumen);
                break;
            default:
        }
        // $lst = explode('/', $dokumen->cover);

        // $txt = '/api/' . $dokumen->user_id . '/view/' . $lst[3];
        // dd($txt);
        // return redirect('/api/dokumen/' . $dokumen->user_id . '/view/' . $lst[3]);

    }

    public function view_dokumen($id, $file_name)
    {
        // Check if file exists in app/storage/file folder
        // return $id;
        $file_path = Storage::url("documents/" . $id . "/" . $file_name);
        // dd($file_path, $id, $file_name);
        // return $file_path;
        // if (file_exists($file_path)) {
        return Dokumen::make(file_get_contents($file_path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $file_name . '"'
        ]);
        // } else {
        //     // Error
        //     exit('Requested file does not exist on our server!');
        // }
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'kategori_id' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }


        $Dokumen = new Dokumen();
        $Dokumen->judul = $request->judul;
        $Dokumen->kategori_id = $request->kategori_id;
        $Dokumen->tahun_terbit = $request->tahun_terbit;
        $Dokumen->nama_pengarang = $request->nama_pengarang;
        $Dokumen->penerbit = $request->penerbit;
        $Dokumen->user_id = Auth::user()->id;

        // Cover 
        if ($request->cover != null) {
            $file_ext = $request->cover->extension();
            $file_name = 'cover_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $cover = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('cover')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->cover = $cover;
        }
        if ($request->lembar_pengesahan != null) {
            $file_ext = $request->lembar_pengesahan->extension();
            $file_name = 'lembar_pengesahan_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $lembar_pengesahan = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('lembar_pengesahan')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->lembar_pengesahan = $lembar_pengesahan;
        }
        if ($request->kata_pengantar != null) {
            $file_ext = $request->kata_pengantar->extension();
            $file_name = 'kata_pengantar_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $kata_pengantar = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('kata_pengantar')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->kata_pengantar = $kata_pengantar;
        }
        if ($request->ringkasan != null) {
            $file_ext = $request->ringkasan->extension();
            $file_name = 'ringkasan_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $ringkasan = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('ringkasan')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->ringkasan = $ringkasan;
        }
        if ($request->daftar_isi != null) {
            $file_ext = $request->daftar_isi->extension();
            $file_name = 'daftar_isi_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $daftar_isi = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('daftar_isi')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->daftar_isi = $daftar_isi;
        }
        if ($request->daftar_gambar != null) {
            $file_ext = $request->daftar_gambar->extension();
            $file_name = 'daftar_gambar_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $daftar_gambar = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('daftar_gambar')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->daftar_gambar = $daftar_gambar;
        }
        if ($request->daftar_tabel != null) {
            $file_ext = $request->daftar_tabel->extension();
            $file_name = 'daftar_tabel_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $daftar_tabel = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('daftar_tabel')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->daftar_tabel = $daftar_tabel;
        }
        if ($request->daftar_notasi != null) {
            $file_ext = $request->daftar_notasi->extension();
            $file_name = 'daftar_notasi_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $daftar_notasi = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('daftar_notasi')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->daftar_notasi = $daftar_notasi;
        }
        // // abstract_en 
        // if ($request->abstract_en != null) {
        //     $file_ext = $request->abstract_en->extension();
        //     $file_name = 'abstract_en_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
        //     $abstract_en = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
        //     $request->abstract_en->storeAs("public/documents/$Dokumen->user_id",  $file_name);
        //     $Dokumen->abstract_en = $abstract_en;
        // }

        // // abstract_id 
        // if ($request->abstract_id != null) {
        //     $file_ext = $request->abstract_id->extension();
        //     $file_name = 'abstract_id_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
        //     $abstract_id = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
        //     $request->abstract_id->storeAs("public/documents/$Dokumen->user_id", $file_name);
        //     $Dokumen->abstract_id = $abstract_id;
        // }

        // bab1 
        if ($request->bab1 != null) {
            $file_ext = $request->bab1->extension();
            $file_name = 'bab1_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $bab1 = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('bab1')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->bab1 = $bab1;
        }

        // bab2 
        if ($request->bab2 != null) {
            $file_ext = $request->bab2->extension();
            $file_name = 'bab2_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $bab2 = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('bab2')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->bab2 = $bab2;
        }

        // bab3 
        if ($request->bab3 != null) {
            $file_ext = $request->bab3->extension();
            $file_name = 'bab3_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $bab3 = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('bab3')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->bab3 = $bab3;
        }

        // bab4 
        if ($request->bab4 != null) {
            $file_ext = $request->bab4->extension();
            $file_name = 'bab4_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $bab4 = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('bab4')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->bab4 = $bab4;
        }
        if ($request->lampiran != null) {
            $file_ext = $request->lampiran->extension();
            $file_name = 'lampiran_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $lampiran = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('lampiran')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->lampiran = $lampiran;
        }
        // // kesimpulan 
        // if ($request->kesimpulan != null) {
        //     $file_ext = $request->kesimpulan->extension();
        //     $file_name = 'kesimpulan_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
        //     $kesimpulan = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
        //     $request->kesimpulan->storeAs("public/documents/$Dokumen->user_id", $file_name);
        //     $Dokumen->kesimpulan = $kesimpulan;
        // }

        // // daftar_pustaka 
        // if ($request->daftar_pustaka != null) {
        //     $file_ext = $request->daftar_pustaka->extension();
        //     $file_name = 'daftar_pustaka_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
        //     $daftar_pustaka = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
        //     $request->daftar_pustaka->storeAs("public/documents/$Dokumen->user_id", $file_name);
        //     $Dokumen->daftar_pustaka = $daftar_pustaka;
        // }

        // // paper 
        // if ($request->paper != null) {
        //     $file_ext = $request->paper->extension();
        //     $file_name = 'paper_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
        //     $paper = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
        //     $request->paper->storeAs("public/documents/$Dokumen->user_id", $file_name);
        //     $Dokumen->paper = $paper;
        // }

        // // lembar_persetujuan 
        // if ($request->lembar_persetujuan != null) {
        //     $file_ext = $request->lembar_persetujuan->extension();
        //     $file_name = 'lembar_persetujuan_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
        //     $lembar_persetujuan = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
        //     $request->lembar_persetujuan->storeAs("public/documents/$Dokumen->user_id", $file_name);
        //     $Dokumen->lembar_persetujuan = $lembar_persetujuan;
        // }

        // full_dokumen 
        if ($request->full_dokumen != null) {
            $file_ext = $request->full_dokumen->extension();
            $file_name = 'full_dokumen_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $full_dokumen = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('full_dokumen')->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->full_dokumen = $full_dokumen;
        }

        $Dokumen->save();

        return $this->successResponse(['status' => true, 'message' => 'Dokumen Berhasil Ditambahkan']);
    }

    public function show($id)
    {
        // $Dokumen = DokumenResource::collection(Dokumen::find($id));        
        $Dokumen = new DokumenResource(Dokumen::findOrFail($id));
        // $Dokumen = Dokumen::find($id);
        if (!$Dokumen) {
            return $this->errorResponse('Data tidak ditemukan', 422);
        }

        return $this->successResponse($Dokumen);
    }

    public function update(Request $request, $id)
    {

        $Dokumen = Dokumen::find($id);
        if (!$Dokumen) {
            return $this->errorResponse('Data tidak ditemukan', 422);
        }

        $Dokumen = Dokumen::find($Dokumen->id);

        $Dokumen->judul = $request->judul;
        if ($request->kategori_id != null) {
            $Dokumen->kategori_id = $request->kategori_id;
        }
        if ($Dokumen->user_id != null) {
            $Dokumen->user_id = $Dokumen->user_id;
        }
        $Dokumen->tahun_terbit = $request->tahun_terbit;
        $Dokumen->nama_pengarang = $request->nama_pengarang;
        $Dokumen->penerbit = $request->penerbit;
        $Dokumen->data_tambahan = $request->data_tambahan;

        // Cover 
        if ($request->cover != null) {
            $file_ext = $request->cover->extension();
            $file_name = 'cover_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $cover = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->file('cover')->storeAs("public/documents/$Dokumen->user_id", $cover);
            $Dokumen->cover = $cover;
        }

        // abstract_en 
        if ($request->abstract_en != null) {
            $file_ext = $request->abstract_en->extension();
            $file_name = 'abstract_en_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $abstract_en = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->abstract_en->storeAs("public/documents/$Dokumen->user_id",  $abstract_en);
            $Dokumen->abstract_en = $abstract_en;
        }

        // abstract_id 
        if ($request->abstract_id != null) {
            $file_ext = $request->abstract_id->extension();
            $file_name = 'abstract_id_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $abstract_id = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->abstract_id->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->abstract_id = $abstract_id;
        }

        // bab1 
        if ($request->bab1 != null) {
            $file_ext = $request->bab1->extension();
            $file_name = 'bab1_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $bab1 = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->bab1->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->bab1 = $bab1;
        }

        // bab2 
        if ($request->bab2 != null) {
            $file_ext = $request->bab2->extension();
            $file_name = 'bab2_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $bab2 = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->bab2->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->bab2 = $bab2;
        }

        // bab3 
        if ($request->bab3 != null) {
            $file_ext = $request->bab3->extension();
            $file_name = 'bab3_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $bab3 = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->bab2->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->bab3 = $bab3;
        }

        // bab4 
        if ($request->bab4 != null) {
            $file_ext = $request->bab4->extension();
            $file_name = 'bab4_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $bab4 = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->bab4->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->bab4 = $bab4;
        }

        // kesimpulan 
        if ($request->kesimpulan != null) {
            $file_ext = $request->kesimpulan->extension();
            $file_name = 'kesimpulan_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $kesimpulan = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->kesimpulan->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->kesimpulan = $kesimpulan;
        }

        // daftar_pustaka 
        if ($request->daftar_pustaka != null) {
            $file_ext = $request->daftar_pustaka->extension();
            $file_name = 'daftar_pustaka_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $daftar_pustaka = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->daftar_pustaka->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->daftar_pustaka = $daftar_pustaka;
        }

        // paper 
        if ($request->paper != null) {
            $file_ext = $request->paper->extension();
            $file_name = 'paper_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $paper = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->paper->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->paper = $paper;
        }

        // lembar_persetujuan 
        if ($request->lembar_persetujuan != null) {
            $file_ext = $request->lembar_persetujuan->extension();
            $file_name = 'lembar_persetujuan_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $lembar_persetujuan = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->lembar_persetujuan->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->lembar_persetujuan = $lembar_persetujuan;
        }

        // full_dokumen 
        if ($request->full_dokumen != null) {
            $file_ext = $request->full_dokumen->extension();
            $file_name = 'full_dokumen_' . $Dokumen->user_id . '_' . time() . '.' . $file_ext;
            $full_dokumen = 'storage/documents/' . $Dokumen->user_id . '/' . $file_name;
            $request->lembar_persetujuan->storeAs("public/documents/$Dokumen->user_id", $file_name);
            $Dokumen->full_dokumen = $full_dokumen;
        }

        $Dokumen->save();

        return $this->successResponse(['status' => true, 'message' => 'Dokumen Berhasil Diubah']);
    }

    public function destroy($id)
    {
        $Dokumen = Dokumen::find($id);
        if (!$Dokumen) {
            return $this->errorResponse('Data tidak ditemukan', 422);
        }

        $Dokumen->delete();
        return $this->successResponse(['status' => true, 'message' => 'Dokumen Berhasil Dihapus']);
    }
}
