<?php

namespace App\Http\Controllers;

use App\Models\Pustaka;
use App\Models\DDC;
use App\Models\Format;
use App\Models\Penerbit;
use App\Models\Pengarang;
use Illuminate\Http\Request;

class PustakaController extends Controller
{
    public function index()
    {
        $pustaka = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang'])->get();
        return view('admin.pustaka.index', compact('pustaka'));
    }

    public function create()
    {
        $ddcs = DDC::all();
        $formats = Format::all();
        $penerbits = Penerbit::all();
        $pengarangs = Pengarang::all();
        return view('admin.pustaka.create', compact('ddcs', 'formats', 'penerbits', 'pengarangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ddc' => 'required|exists:tbl_ddc,id_ddc',
            'id_format' => 'required|exists:tbl_format,id_format',
            'id_penerbit' => 'required|exists:tbl_penerbit,id_penerbit',
            'id_pengarang' => 'required|exists:tbl_pengarang,id_pengarang',
            'isbn' => 'required|max:20|unique:tbl_pustaka',
            'judul_pustaka' => 'required|max:100',
            'tahun_terbit' => 'required|max:4',
            'keyword' => 'required|max:50',
            'keterangan_fisik' => 'nullable|max:100',
            'keterangan_tambahan' => 'nullable|max:100',
            'abstraksi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga_buku' => 'required|integer',
            'kondisi_buku' => 'required|max:15',
            'fp' => 'required|in:0,1',
            'jml_pinjam' => 'required|integer',
            'denda_terlambat' => 'required|integer',
            'denda_hilang' => 'required|integer'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('images/pustaka'), $nama_gambar);
            $data['gambar'] = 'images/pustaka/' . $nama_gambar;
        }

        Pustaka::create($data);
        return redirect()->route('pustaka.index')->with('success', 'Pustaka berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pustaka = Pustaka::findOrFail($id);
        $ddcs = DDC::all();
        $formats = Format::all();
        $penerbits = Penerbit::all();
        $pengarangs = Pengarang::all();
        return view('admin.pustaka.edit', compact('pustaka', 'ddcs', 'formats', 'penerbits', 'pengarangs'));
    }

    public function update(Request $request, $id)
    {
        $pustaka = Pustaka::findOrFail($id);
        
        $request->validate([
            'id_ddc' => 'required|exists:tbl_ddc,id_ddc',
            'id_format' => 'required|exists:tbl_format,id_format',
            'id_penerbit' => 'required|exists:tbl_penerbit,id_penerbit',
            'id_pengarang' => 'required|exists:tbl_pengarang,id_pengarang',
            'isbn' => 'required|max:20|unique:tbl_pustaka,isbn,'.$id.',id_pustaka',
            'judul_pustaka' => 'required|max:100',
            'tahun_terbit' => 'required|max:4',
            'keyword' => 'required|max:50',
            'keterangan_fisik' => 'nullable|max:100',
            'keterangan_tambahan' => 'nullable|max:100',
            'abstraksi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga_buku' => 'required|integer',
            'kondisi_buku' => 'required|max:15',
            'fp' => 'required|in:0,1',
            'jml_pinjam' => 'required|integer',
            'denda_terlambat' => 'required|integer',
            'denda_hilang' => 'required|integer'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pustaka->gambar && file_exists(public_path($pustaka->gambar))) {
                unlink(public_path($pustaka->gambar));
            }
            
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('images/pustaka'), $nama_gambar);
            $data['gambar'] = 'images/pustaka/' . $nama_gambar;
        }

        $pustaka->update($data);
        return redirect()->route('pustaka.index')->with('success', 'Pustaka berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pustaka = Pustaka::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($pustaka->gambar && file_exists(public_path($pustaka->gambar))) {
            unlink(public_path($pustaka->gambar));
        }
        
        $pustaka->delete();
        return redirect()->route('pustaka.index')->with('success', 'Pustaka berhasil dihapus');
    }

    public function userIndex(Request $request)
    {
        $query = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang']);
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_pustaka', 'LIKE', "%{$search}%")
                  ->orWhere('isbn', 'LIKE', "%{$search}%")
                  ->orWhere('keyword', 'LIKE', "%{$search}%")
                  ->orWhereHas('pengarang', function($q) use ($search) {
                      $q->where('nama_pengarang', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('penerbit', function($q) use ($search) {
                      $q->where('nama_penerbit', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        $books = $query->paginate(12);
        return view('users.books.index', compact('books'));
    }
} 