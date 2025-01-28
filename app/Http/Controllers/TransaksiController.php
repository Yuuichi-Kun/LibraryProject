<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pustaka;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function create($id_pustaka)
    {
        $pustaka = Pustaka::with(['pengarang', 'penerbit'])->findOrFail($id_pustaka);
        return view('users.transaksi.create', compact('pustaka'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pustaka' => 'required|exists:tbl_pustaka,id_pustaka',
            'tgl_pinjam' => 'required|date|after_or_equal:today',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
        ]);

        try {
            $user = auth()->user();
            if (!$user->isAnggota()) {
                return redirect()->back()->with('error', 'Anda harus terdaftar sebagai anggota untuk meminjam buku.');
            }
            
            if (!$user->isActiveAnggota()) {
                return redirect()->back()->with('error', 'Akun anggota Anda belum diaktivasi oleh admin.');
            }

            $anggota = $user->anggota;
            
            // Cek jumlah peminjaman aktif
            $active_loans = Transaksi::where('id_anggota', $anggota->id_anggota)
                ->whereNull('tgl_pengembalian')
                ->count();

            if ($active_loans >= $anggota->jenisAnggota->max_pinjam) {
                return redirect()->back()->with('error', 'Anda telah mencapai batas maksimum peminjaman.');
            }

            // Buat transaksi baru
            Transaksi::create([
                'id_pustaka' => $request->id_pustaka,
                'id_anggota' => $anggota->id_anggota,
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali' => $request->tgl_kembali,
                'fp' => '0',
                'status_approval' => 'pending'
            ]);

            return redirect()->route('transaksi.history')
                ->with('success', 'Permintaan peminjaman berhasil diajukan. Silakan tunggu persetujuan admin.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengajukan peminjaman.')
                ->withInput();
        }
    }

    public function history()
    {
        $anggota = Anggota::where('email', Auth::user()->email)->first();
        if (!$anggota) {
            return redirect()->route('home')->with('error', 'Anda harus terdaftar sebagai anggota.');
        }

        $transaksi = Transaksi::with(['pustaka', 'anggota'])
            ->where('id_anggota', $anggota->id_anggota)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.transaksi.history', compact('transaksi'));
    }

    public function index()
    {
        $transaksi = Transaksi::with(['pustaka', 'anggota'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('users.transaksi.index', compact('transaksi'));
    }

    public function returnBook($id)
    {
        try {
            $transaksi = Transaksi::findOrFail($id);
            
            // Pastikan user yang login adalah peminjam buku
            if ($transaksi->id_anggota != auth()->user()->anggota->id_anggota) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengembalikan buku ini.');
            }

            // Update tanggal pengembalian
            $transaksi->update([
                'tgl_pengembalian' => now()
            ]);

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengembalikan buku.');
        }
    }
} 