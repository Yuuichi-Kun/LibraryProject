<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    public function index()
    {
        $pengarangs = Pengarang::all();
        return view('admin.pengarang.index', compact('pengarangs'));
    }

    public function create()
    {
        return view('admin.pengarang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pengarang' => 'required|unique:tbl_pengarang|max:10',
            'gelar_depan' => 'nullable|max:10',
            'nama_pengarang' => 'required|unique:tbl_pengarang|max:50',
            'gelar_belakang' => 'nullable|max:10',
            'no_telp' => 'required|max:15',
            'email' => 'nullable|email|max:30',
            'website' => 'nullable|max:50',
            'biografi' => 'nullable',
            'keterangan' => 'nullable|max:50'
        ]);

        Pengarang::create($request->all());
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return view('admin.pengarang.edit', compact('pengarang'));
    }

    public function update(Request $request, $id)
    {
        $pengarang = Pengarang::findOrFail($id);
        
        $request->validate([
            'kode_pengarang' => 'required|max:10|unique:tbl_pengarang,kode_pengarang,'.$id.',id_pengarang',
            'gelar_depan' => 'nullable|max:10',
            'nama_pengarang' => 'required|max:50|unique:tbl_pengarang,nama_pengarang,'.$id.',id_pengarang',
            'gelar_belakang' => 'nullable|max:10',
            'no_telp' => 'required|max:15',
            'email' => 'nullable|email|max:30',
            'website' => 'nullable|max:50',
            'biografi' => 'nullable',
            'keterangan' => 'nullable|max:50'
        ]);

        $pengarang->update($request->all());
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        $pengarang->delete();
        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil dihapus');
    }
} 