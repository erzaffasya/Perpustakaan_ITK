<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeminjamanController extends Controller
{
    public function index()
    {
        $Peminjaman = Peminjaman::all();
        return view('admin.Peminjaman.index', compact('Peminjaman'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $Peminjaman = Peminjaman::all();
        return view('admin.Peminjaman.tambah', compact('Peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'detail' => 'required',
            'stok' => 'required',
            'Peminjaman_id' => 'required',
            'gambar1' => 'required', 
        ]);

        $date = date("his");
        $extension = $request->file('gambar1')->extension();
        $file_name = "Peminjaman_$date.$extension";
        $path = $request->file('gambar1')->storeAs('public/Peminjaman', $file_name);

        Peminjaman::create([
            'nama' => $request->nama,
            'detail' => $request->detail,
            'gambar' => $file_name,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'Peminjaman_id' => $request->Peminjaman_id,
        ]);
        return redirect()->route('Peminjaman.index')
            ->with('success', 'Peminjaman Berhasil Ditambahkan');
    }
    public function show($id)
    {
        $Peminjaman = Peminjaman::where('id', $id)->first();
        return view('admin.Peminjaman.show', compact('Peminjaman'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function edit($id)
    {
        $Peminjaman = Peminjaman::find($id);
        $Peminjaman = Peminjaman::all();
        return view('admin.Peminjaman.edit',compact('Peminjaman','Peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'detail' => 'required',
            'gambar1' => 'file|mimes:jpg,png,jpeg,gif,svg,jfif|max:2048',
            'harga' => 'required',
            'Peminjaman_id' => 'required',
            'stok' => 'required',
        ]);

        $Peminjaman = Peminjaman::findOrFail($id);

        if ($request->has("gambar1")) {

            Storage::delete("public/Peminjaman/$Peminjaman->gambar");

            $date = date("his");
            $extension = $request->file('gambar1')->extension();
            $file_name = "Peminjaman_$date.$extension";
            $path = $request->file('gambar1')->storeAs('public/Peminjaman', $file_name);
            
            $Peminjaman->gambar = $file_name;
        }

        $Peminjaman->nama = $request->nama;
        $Peminjaman->detail = $request->detail;
        $Peminjaman->harga = $request->harga;
        $Peminjaman->Peminjaman_id = $request->Peminjaman_id;
        $Peminjaman->stok = $request->stok;
        $Peminjaman->save();

        return redirect()->route('Peminjaman.index')
        ->with('edit', 'Peminjaman Berhasil Diedit');
    }

    public function destroy($id)
    {
        $Peminjaman = Peminjaman::findOrFail($id);
        Storage::delete("public/Peminjaman/$Peminjaman->gambar");
        $Peminjaman->delete();
        return redirect()->route('Peminjaman.index')
            ->with('delete', 'Peminjaman Berhasil Dihapus');
    }

    public function grid()
    {
        $Peminjaman = Peminjaman::all();
        $Peminjaman = Peminjaman::all();
        return view('admin.Peminjaman.grid', compact('Peminjaman','Peminjaman'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
