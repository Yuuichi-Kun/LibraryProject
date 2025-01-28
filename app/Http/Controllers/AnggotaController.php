<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\JenisAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function create()
    {
        $jenisAnggota = JenisAnggota::all();
        return view('users.anggota.register', compact('jenisAnggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_anggota' => 'required|exists:tbl_jenis_anggota,id_jenis_anggota',
            'nama_anggota' => 'required|string|max:50|unique:tbl_anggota',
            'tempat' => 'required|string|max:20',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string|max:50',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|max:30|unique:tbl_anggota',
            'username' => 'required|string|max:50|unique:tbl_anggota',
            'password' => 'required|string|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240'
        ]);

        try {
            $lastAnggota = Anggota::orderBy('id_anggota', 'desc')->first();
            $lastNumber = $lastAnggota ? intval(substr($lastAnggota->kode_anggota, -3)) : 0;
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            $kodeAnggota = 'AGT' . date('Y') . $newNumber;

            $data = $request->all();
            $data['kode_anggota'] = $kodeAnggota;
            $data['tgl_daftar'] = Carbon::now();
            $data['masa_aktif'] = Carbon::now()->addYear();
            $data['fa'] = 'T';
            $data['password'] = Hash::make($request->password);
            $data['user_id'] = auth()->id();

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $filename = time() . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('public/images/anggota', $filename);
                $data['foto'] = 'images/anggota/' . $filename;
            }

            Anggota::create($data);

            return redirect()->route('home')
                ->with('success', 'Pendaftaran berhasil! Silahkan menunggu aktivasi dari admin.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.')
                        ->withInput();
        }
    }
} 