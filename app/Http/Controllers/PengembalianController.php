<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengembalianController extends Controller
{
    public function index()
    {
        $Pengembalian = Pengembalian::all();
        return view('admin.Pengembalian.index', compact('Pengembalian'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $Pengembalian = Pengembalian::all();
        return view('admin.Pengembalian.tambah', compact('Pengembalian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'detail' => 'required',
            'stok' => 'required',
            'Pengembalian_id' => 'required',
            'gambar1' => 'required', 
        ]);

        $date = date("his");
        $extension = $request->file('gambar1')->extension();
        $file_name = "Pengembalian_$date.$extension";
        $path = $request->file('gambar1')->storeAs('public/Pengembalian', $file_name);

        Pengembalian::create([
            'nama' => $request->nama,
            'detail' => $request->detail,
            'gambar' => $file_name,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'Pengembalian_id' => $request->Pengembalian_id,
        ]);
        return redirect()->route('Pengembalian.index')
            ->with('success', 'Pengembalian Berhasil Ditambahkan');
    }
    public function show($id)
    {
        $Pengembalian = Pengembalian::where('id', $id)->first();
        return view('admin.Pengembalian.show', compact('Pengembalian'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function edit($id)
    {
        $Pengembalian = Pengembalian::find($id);
        $Pengembalian = Pengembalian::all();
        return view('admin.Pengembalian.edit',compact('Pengembalian','Pengembalian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'detail' => 'required',
            'gambar1' => 'file|mimes:jpg,png,jpeg,gif,svg,jfif|max:2048',
            'harga' => 'required',
            'Pengembalian_id' => 'required',
            'stok' => 'required',
        ]);

        $Pengembalian = Pengembalian::findOrFail($id);

        if ($request->has("gambar1")) {

            Storage::delete("public/Pengembalian/$Pengembalian->gambar");

            $date = date("his");
            $extension = $request->file('gambar1')->extension();
            $file_name = "Pengembalian_$date.$extension";
            $path = $request->file('gambar1')->storeAs('public/Pengembalian', $file_name);
            
            $Pengembalian->gambar = $file_name;
        }

        $Pengembalian->nama = $request->nama;
        $Pengembalian->detail = $request->detail;
        $Pengembalian->harga = $request->harga;
        $Pengembalian->Pengembalian_id = $request->Pengembalian_id;
        $Pengembalian->stok = $request->stok;
        $Pengembalian->save();

        return redirect()->route('Pengembalian.index')
        ->with('edit', 'Pengembalian Berhasil Diedit');
    }

    public function destroy($id)
    {
        $Pengembalian = Pengembalian::findOrFail($id);
        Storage::delete("public/Pengembalian/$Pengembalian->gambar");
        $Pengembalian->delete();
        return redirect()->route('Pengembalian.index')
            ->with('delete', 'Pengembalian Berhasil Dihapus');
    }

    public function grid()
    {
        $Pengembalian = Pengembalian::all();
        $Pengembalian = Pengembalian::all();
        return view('admin.Pengembalian.grid', compact('Pengembalian','Pengembalian'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
