<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $Dokumen = Dokumen::all();
        return view('admin.Dokumen.index', compact('Dokumen'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $Dokumen = Dokumen::all();
        return view('admin.Dokumen.tambah', compact('Dokumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'detail' => 'required',
            'stok' => 'required',
            'Dokumen_id' => 'required',
            'gambar1' => 'required', 
        ]);

        $date = date("his");
        $extension = $request->file('gambar1')->extension();
        $file_name = "Dokumen_$date.$extension";
        $path = $request->file('gambar1')->storeAs('public/Dokumen', $file_name);

        Dokumen::create([
            'nama' => $request->nama,
            'detail' => $request->detail,
            'gambar' => $file_name,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'Dokumen_id' => $request->Dokumen_id,
        ]);
        return redirect()->route('Dokumen.index')
            ->with('success', 'Dokumen Berhasil Ditambahkan');
    }
    public function show($id)
    {
        $Dokumen = Dokumen::where('id', $id)->first();
        return view('admin.Dokumen.show', compact('Dokumen'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function edit($id)
    {
        $Dokumen = Dokumen::find($id);
        $Dokumen = Dokumen::all();
        return view('admin.Dokumen.edit',compact('Dokumen','Dokumen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'detail' => 'required',
            'gambar1' => 'file|mimes:jpg,png,jpeg,gif,svg,jfif|max:2048',
            'harga' => 'required',
            'Dokumen_id' => 'required',
            'stok' => 'required',
        ]);

        $Dokumen = Dokumen::findOrFail($id);

        if ($request->has("gambar1")) {

            Storage::delete("public/Dokumen/$Dokumen->gambar");

            $date = date("his");
            $extension = $request->file('gambar1')->extension();
            $file_name = "Dokumen_$date.$extension";
            $path = $request->file('gambar1')->storeAs('public/Dokumen', $file_name);
            
            $Dokumen->gambar = $file_name;
        }

        $Dokumen->nama = $request->nama;
        $Dokumen->detail = $request->detail;
        $Dokumen->harga = $request->harga;
        $Dokumen->Dokumen_id = $request->Dokumen_id;
        $Dokumen->stok = $request->stok;
        $Dokumen->save();

        return redirect()->route('Dokumen.index')
        ->with('edit', 'Dokumen Berhasil Diedit');
    }

    public function destroy($id)
    {
        $Dokumen = Dokumen::findOrFail($id);
        Storage::delete("public/Dokumen/$Dokumen->gambar");
        $Dokumen->delete();
        return redirect()->route('Dokumen.index')
            ->with('delete', 'Dokumen Berhasil Dihapus');
    }

    public function grid()
    {
        $Dokumen = Dokumen::all();
        $Dokumen = Dokumen::all();
        return view('admin.Dokumen.grid', compact('Dokumen','Dokumen'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
