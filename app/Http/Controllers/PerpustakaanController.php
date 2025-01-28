<?php

namespace App\Http\Controllers;

use App\Models\Perpustakaan;
use Illuminate\Http\Request;

class PerpustakaanController extends Controller
{
    public function edit()
    {
        $perpustakaan = Perpustakaan::first();
        return view('admin.perpustakaan.edit', compact('perpustakaan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_perpustakaan' => 'required|max:50',
            'nama_pustakawan' => 'required|max:50',
            'alamat' => 'required|max:50',
            'email' => 'required|email|max:50',
            'website' => 'nullable|max:50',
            'no_telp' => 'required|max:15',
            'keterangan' => 'nullable|max:50'
        ]);

        $perpustakaan = Perpustakaan::first();
        if (!$perpustakaan) {
            Perpustakaan::create($request->all());
        } else {
            $perpustakaan->update($request->all());
        }

        return redirect()->route('perpustakaan.edit')->with('success', 'Profil perpustakaan berhasil diperbarui');
    }
} 