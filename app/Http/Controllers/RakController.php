<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index()
    {
        $raks = Rak::all();
        return view('admin.rak.index', compact('raks'));
    }

    public function create()
    {
        return view('admin.rak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_rak' => 'required|unique:tbl_rak|max:10',
            'rak' => 'required|unique:tbl_rak|max:25',
            'keterangan' => 'nullable|max:50'
        ]);

        Rak::create($request->all());
        return redirect()->route('rak.index')->with('success', 'Rak berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rak = Rak::findOrFail($id);
        return view('admin.rak.edit', compact('rak'));
    }

    public function update(Request $request, $id)
    {
        $rak = Rak::findOrFail($id);
        
        $request->validate([
            'kode_rak' => 'required|max:10|unique:tbl_rak,kode_rak,'.$id.',id_rak',
            'rak' => 'required|max:25|unique:tbl_rak,rak,'.$id.',id_rak',
            'keterangan' => 'nullable|max:50'
        ]);

        $rak->update($request->all());
        return redirect()->route('rak.index')->with('success', 'Rak berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rak = Rak::findOrFail($id);
        try {
            $rak->delete();
            return redirect()->route('rak.index')->with('success', 'Rak berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('rak.index')->with('error', 'Rak tidak dapat dihapus karena masih memiliki data DDC');
        }
    }
} 