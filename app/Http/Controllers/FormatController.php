<?php

namespace App\Http\Controllers;

use App\Models\Format;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    public function index()
    {
        $formats = Format::all();
        return view('admin.format.index', compact('formats'));
    }

    public function create()
    {
        return view('admin.format.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_format' => 'required|unique:tbl_format|max:10',
            'format' => 'required|unique:tbl_format|max:25',
            'keterangan' => 'nullable|max:50'
        ]);

        Format::create($request->all());
        return redirect()->route('format.index')->with('success', 'Format berhasil ditambahkan');
    }

    public function edit($id)
    {
        $format = Format::findOrFail($id);
        return view('admin.format.edit', compact('format'));
    }

    public function update(Request $request, $id)
    {
        $format = Format::findOrFail($id);
        
        $request->validate([
            'kode_format' => 'required|max:10|unique:tbl_format,kode_format,'.$id.',id_format',
            'format' => 'required|max:25|unique:tbl_format,format,'.$id.',id_format',
            'keterangan' => 'nullable|max:50'
        ]);

        $format->update($request->all());
        return redirect()->route('format.index')->with('success', 'Format berhasil diperbarui');
    }

    public function destroy($id)
    {
        $format = Format::findOrFail($id);
        $format->delete();
        return redirect()->route('format.index')->with('success', 'Format berhasil dihapus');
    }
} 