<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['pustaka', 'anggota'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function approve($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_approval = 'approved';
        $transaksi->save();

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Peminjaman berhasil disetujui');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:255'
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_approval = 'rejected';
        $transaksi->reject_reason = $request->reject_reason;
        $transaksi->save();

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Peminjaman berhasil ditolak');
    }
} 