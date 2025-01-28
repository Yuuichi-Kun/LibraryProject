<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbits = Penerbit::all();
        return view('admin.penerbit.index', compact('penerbits'));
    }

    public function create()
    {
        return view('admin.penerbit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_penerbit' => 'required|unique:tbl_penerbit|max:10',
            'nama_penerbit' => 'required|unique:tbl_penerbit|max:50',
            'alamat_penerbit' => 'required|max:50',
            'no_telp' => 'required|max:15',
            'email' => 'required|email|max:30',
            'fax' => 'nullable|max:15',
            'website' => 'nullable|max:50',
            'kontak' => 'required|max:50'
        ]);

        Penerbit::create($request->all());
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil ditambahkan');
    }

    public function edit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('admin.penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, $id)
    {
        $penerbit = Penerbit::findOrFail($id);
        
        $request->validate([
            'kode_penerbit' => 'required|max:10|unique:tbl_penerbit,kode_penerbit,'.$id.',id_penerbit',
            'nama_penerbit' => 'required|max:50|unique:tbl_penerbit,nama_penerbit,'.$id.',id_penerbit',
            'alamat_penerbit' => 'required|max:50',
            'no_telp' => 'required|max:15',
            'email' => 'required|email|max:30',
            'fax' => 'nullable|max:15',
            'website' => 'nullable|max:50',
            'kontak' => 'required|max:50'
        ]);

        $penerbit->update($request->all());
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil dihapus');
    }
} 