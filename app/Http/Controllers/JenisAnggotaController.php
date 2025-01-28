<?php

namespace App\Http\Controllers;

use App\Models\JenisAnggota;
use Illuminate\Http\Request;

class JenisAnggotaController extends Controller
{
    public function index()
    {
        $jenisAnggota = JenisAnggota::all();
        return view('admin.jenis-anggota.index', compact('jenisAnggota'));
    }

    public function create()
    {
        return view('admin.jenis-anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jenis_anggota' => 'required|max:20|unique:tbl_jenis_anggota',
            'jenis_anggota' => 'required|max:15',
            'max_pinjam' => 'required|max:5',
            'keterangan' => 'nullable|max:50'
        ]);

        JenisAnggota::create($request->all());
        return redirect()->route('jenis-anggota.index')->with('success', 'Jenis Anggota berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jenisAnggota = JenisAnggota::findOrFail($id);
        return view('admin.jenis-anggota.edit', compact('jenisAnggota'));
    }

    public function update(Request $request, $id)
    {
        $jenisAnggota = JenisAnggota::findOrFail($id);
        
        $request->validate([
            'kode_jenis_anggota' => 'required|max:20|unique:tbl_jenis_anggota,kode_jenis_anggota,'.$id.',id_jenis_anggota',
            'jenis_anggota' => 'required|max:15',
            'max_pinjam' => 'required|max:5',
            'keterangan' => 'nullable|max:50'
        ]);

        $jenisAnggota->update($request->all());
        return redirect()->route('jenis-anggota.index')->with('success', 'Jenis Anggota berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jenisAnggota = JenisAnggota::findOrFail($id);
        $jenisAnggota->delete();
        return redirect()->route('jenis-anggota.index')->with('success', 'Jenis Anggota berhasil dihapus');
    }
} 