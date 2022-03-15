<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index()
    {
        $Kategori = Kategori::all();
        return view('admin.Kategori.index', compact('Kategori'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $Kategori = Kategori::all();
        return view('admin.Kategori.tambah', compact('Kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'detail' => 'required',
            'stok' => 'required',
            'Kategori_id' => 'required',
            'gambar1' => 'required', 
        ]);

        $date = date("his");
        $extension = $request->file('gambar1')->extension();
        $file_name = "Kategori_$date.$extension";
        $path = $request->file('gambar1')->storeAs('public/Kategori', $file_name);

        Kategori::create([
            'nama' => $request->nama,
            'detail' => $request->detail,
            'gambar' => $file_name,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'Kategori_id' => $request->Kategori_id,
        ]);
        return redirect()->route('Kategori.index')
            ->with('success', 'Kategori Berhasil Ditambahkan');
    }
    public function show($id)
    {
        $Kategori = Kategori::where('id', $id)->first();
        return view('admin.Kategori.show', compact('Kategori'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function edit($id)
    {
        $Kategori = Kategori::find($id);
        $Kategori = Kategori::all();
        return view('admin.Kategori.edit',compact('Kategori','Kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'detail' => 'required',
            'gambar1' => 'file|mimes:jpg,png,jpeg,gif,svg,jfif|max:2048',
            'harga' => 'required',
            'Kategori_id' => 'required',
            'stok' => 'required',
        ]);

        $Kategori = Kategori::findOrFail($id);

        if ($request->has("gambar1")) {

            Storage::delete("public/Kategori/$Kategori->gambar");

            $date = date("his");
            $extension = $request->file('gambar1')->extension();
            $file_name = "Kategori_$date.$extension";
            $path = $request->file('gambar1')->storeAs('public/Kategori', $file_name);
            
            $Kategori->gambar = $file_name;
        }

        $Kategori->nama = $request->nama;
        $Kategori->detail = $request->detail;
        $Kategori->harga = $request->harga;
        $Kategori->Kategori_id = $request->Kategori_id;
        $Kategori->stok = $request->stok;
        $Kategori->save();

        return redirect()->route('Kategori.index')
        ->with('edit', 'Kategori Berhasil Diedit');
    }

    public function destroy($id)
    {
        $Kategori = Kategori::findOrFail($id);
        Storage::delete("public/Kategori/$Kategori->gambar");
        $Kategori->delete();
        return redirect()->route('Kategori.index')
            ->with('delete', 'Kategori Berhasil Dihapus');
    }

    public function grid()
    {
        $Kategori = Kategori::all();
        $Kategori = Kategori::all();
        return view('admin.Kategori.grid', compact('Kategori','Kategori'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
