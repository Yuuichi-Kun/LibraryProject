<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    protected $table = 'tgl_transaksi';
    protected $primaryKey = 'id_transaksi';
    
    protected $fillable = [
        'id_pustaka',
        'id_anggota',
        'tgl_pinjam',
        'tgl_kembali',
        'tgl_pengembalian',
        'fp',
        'keterangan',
        'status_approval',
        'reject_reason'
    ];

    // Menentukan kolom yang harus diperlakukan sebagai tanggal
    protected $dates = [
        'created_at',
        'updated_at',
        'tgl_pinjam',
        'tgl_kembali',
        'tgl_pengembalian'
    ];

    // Mengubah format input tanggal
    protected $casts = [
        'tgl_pinjam' => 'datetime:Y-m-d',
        'tgl_kembali' => 'datetime:Y-m-d',
        'tgl_pengembalian' => 'datetime:Y-m-d'
    ];

    public function pustaka()
    {
        return $this->belongsTo(Pustaka::class, 'id_pustaka');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    // Mutator untuk mengubah format tanggal saat disimpan
    public function setTglPinjamAttribute($value)
    {
        $this->attributes['tgl_pinjam'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function setTglKembaliAttribute($value)
    {
        $this->attributes['tgl_kembali'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function setTglPengembalianAttribute($value)
    {
        if ($value) {
            $this->attributes['tgl_pengembalian'] = Carbon::parse($value)->format('Y-m-d');
        }
    }

    // Accessor untuk mendapatkan format tanggal yang diinginkan
    public function getTglPinjamFormattedAttribute()
    {
        return $this->tgl_pinjam ? Carbon::parse($this->tgl_pinjam)->format('d/m/Y') : '-';
    }

    public function getTglKembaliFormattedAttribute()
    {
        return $this->tgl_kembali ? Carbon::parse($this->tgl_kembali)->format('d/m/Y') : '-';
    }

    public function getTglPengembalianFormattedAttribute()
    {
        return $this->tgl_pengembalian ? Carbon::parse($this->tgl_pengembalian)->format('d/m/Y') : '-';
    }

    public function isOverdue()
    {
        if (!$this->tgl_pengembalian && now()->gt($this->tgl_kembali)) {
            return true;
        }
        return false;
    }

    public function getDurasiPinjam()
    {
        return Carbon::parse($this->tgl_pinjam)->diffInDays(Carbon::parse($this->tgl_kembali));
    }

    public function getStatus()
    {
        if ($this->tgl_pengembalian) {
            return 'Dikembalikan';
        }
        
        if ($this->status_approval == 'pending') {
            return 'Menunggu Persetujuan';
        }
        
        if ($this->status_approval == 'rejected') {
            return 'Ditolak';
        }
        
        if ($this->isOverdue()) {
            return 'Terlambat';
        }
        
        return 'Dipinjam';
    }

    /**
     * Menghitung denda keterlambatan
     * @return int|null
     */
    public function getDenda()
    {
        // Jika belum dikembalikan dan sudah melewati batas waktu
        if (!$this->tgl_pengembalian && $this->isOverdue()) {
            // Hitung selisih hari dari batas waktu kembali sampai hari ini
            $hariTerlambat = floor(max(0, Carbon::parse($this->tgl_kembali)->floatDiffInDays(now())));
            
            // Ambil denda per hari dari data pustaka
            $dendaPerHari = $this->pustaka->denda_terlambat;
            
            // Hitung total denda
            return (int)($hariTerlambat * $dendaPerHari);
        }
        
        // Jika sudah dikembalikan dan terlambat
        if ($this->tgl_pengembalian && Carbon::parse($this->tgl_pengembalian)->gt($this->tgl_kembali)) {
            // Hitung selisih hari dari batas waktu kembali sampai tanggal pengembalian
            $hariTerlambat = floor(max(0, Carbon::parse($this->tgl_kembali)->floatDiffInDays(Carbon::parse($this->tgl_pengembalian))));
            
            // Ambil denda per hari dari data pustaka
            $dendaPerHari = $this->pustaka->denda_terlambat;
            
            // Hitung total denda
            return (int)($hariTerlambat * $dendaPerHari);
        }
        
        return null;
    }

    /**
     * Mendapatkan jumlah hari keterlambatan
     * @return int
     */
    public function getHariTerlambat()
    {
        if (!$this->tgl_pengembalian) {
            return (int)floor(max(0, Carbon::parse($this->tgl_kembali)->floatDiffInDays(now())));
        }
        
        return (int)floor(max(0, Carbon::parse($this->tgl_kembali)->floatDiffInDays(Carbon::parse($this->tgl_pengembalian))));
    }

    /**
     * Format denda ke dalam format rupiah
     * @return string|null
     */
    public function getDendaFormatted()
    {
        $denda = $this->getDenda();
        if ($denda !== null) {
            return 'Rp ' . number_format($denda, 0, ',', '.');
        }
        return null;
    }
}