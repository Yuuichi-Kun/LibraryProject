<?php

namespace App\Http\Controllers;

use App\Models\DDC;
use App\Models\Rak;
use Illuminate\Http\Request;

class DDCController extends Controller
{
    public function index()
    {
        $ddcs = DDC::with('rak')->get();
        return view('admin.ddc.index', compact('ddcs'));
    }

    public function create()
    {
        $raks = Rak::all();
        return view('admin.ddc.create', compact('raks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_rak' => 'required|exists:tbl_rak,id_rak',
            'kode_ddc' => 'required|unique:tbl_ddc|max:10',
            'ddc' => 'required|unique:tbl_ddc|max:100',
            'keterangan' => 'nullable|max:100'
        ]);

        DDC::create($request->all());
        return redirect()->route('ddc.index')->with('success', 'DDC berhasil ditambahkan');
    }

    public function edit($id)
    {
        $ddc = DDC::findOrFail($id);
        $raks = Rak::all();
        return view('admin.ddc.edit', compact('ddc', 'raks'));
    }

    public function update(Request $request, $id)
    {
        $ddc = DDC::findOrFail($id);
        
        $request->validate([
            'id_rak' => 'required|exists:tbl_rak,id_rak',
            'kode_ddc' => 'required|max:10|unique:tbl_ddc,kode_ddc,'.$id.',id_ddc',
            'ddc' => 'required|max:100|unique:tbl_ddc,ddc,'.$id.',id_ddc',
            'keterangan' => 'nullable|max:100'
        ]);

        $ddc->update($request->all());
        return redirect()->route('ddc.index')->with('success', 'DDC berhasil diperbarui');
    }

    public function destroy($id)
    {
        $ddc = DDC::findOrFail($id);
        $ddc->delete();
        return redirect()->route('ddc.index')->with('success', 'DDC berhasil dihapus');
    }
} 