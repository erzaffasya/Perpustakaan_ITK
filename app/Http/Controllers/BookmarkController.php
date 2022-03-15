<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookmarkController extends Controller
{
    public function index()
    {
        $Bookmark = Bookmark::all();
        return view('admin.Bookmark.index', compact('Bookmark'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $Bookmark = Bookmark::all();
        return view('admin.Bookmark.tambah', compact('Bookmark'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'detail' => 'required',
            'stok' => 'required',
            'Bookmark_id' => 'required',
            'gambar1' => 'required', 
        ]);

        $date = date("his");
        $extension = $request->file('gambar1')->extension();
        $file_name = "Bookmark_$date.$extension";
        $path = $request->file('gambar1')->storeAs('public/Bookmark', $file_name);

        Bookmark::create([
            'nama' => $request->nama,
            'detail' => $request->detail,
            'gambar' => $file_name,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'Bookmark_id' => $request->Bookmark_id,
        ]);
        return redirect()->route('Bookmark.index')
            ->with('success', 'Bookmark Berhasil Ditambahkan');
    }
    public function show($id)
    {
        $Bookmark = Bookmark::where('id', $id)->first();
        return view('admin.Bookmark.show', compact('Bookmark'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function edit($id)
    {
        $Bookmark = Bookmark::find($id);
        $Bookmark = Bookmark::all();
        return view('admin.Bookmark.edit',compact('Bookmark','Bookmark'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'detail' => 'required',
            'gambar1' => 'file|mimes:jpg,png,jpeg,gif,svg,jfif|max:2048',
            'harga' => 'required',
            'Bookmark_id' => 'required',
            'stok' => 'required',
        ]);

        $Bookmark = Bookmark::findOrFail($id);

        if ($request->has("gambar1")) {

            Storage::delete("public/Bookmark/$Bookmark->gambar");

            $date = date("his");
            $extension = $request->file('gambar1')->extension();
            $file_name = "Bookmark_$date.$extension";
            $path = $request->file('gambar1')->storeAs('public/Bookmark', $file_name);
            
            $Bookmark->gambar = $file_name;
        }

        $Bookmark->nama = $request->nama;
        $Bookmark->detail = $request->detail;
        $Bookmark->harga = $request->harga;
        $Bookmark->Bookmark_id = $request->Bookmark_id;
        $Bookmark->stok = $request->stok;
        $Bookmark->save();

        return redirect()->route('Bookmark.index')
        ->with('edit', 'Bookmark Berhasil Diedit');
    }

    public function destroy($id)
    {
        $Bookmark = Bookmark::findOrFail($id);
        Storage::delete("public/Bookmark/$Bookmark->gambar");
        $Bookmark->delete();
        return redirect()->route('Bookmark.index')
            ->with('delete', 'Bookmark Berhasil Dihapus');
    }

    public function grid()
    {
        $Bookmark = Bookmark::all();
        $Bookmark = Bookmark::all();
        return view('admin.Bookmark.grid', compact('Bookmark','Bookmark'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
