<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AdminAnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('jenisAnggota', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.anggota.index', compact('anggota'));
    }

    public function activate(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->fa = 'Y';
        $anggota->save();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil diaktivasi');
    }
} 