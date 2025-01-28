<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pustaka extends Model
{
    protected $table = 'tbl_pustaka';
    protected $primaryKey = 'id_pustaka';
    protected $fillable = [
        'id_ddc',
        'id_format',
        'id_penerbit',
        'id_pengarang',
        'isbn',
        'judul_pustaka',
        'tahun_terbit',
        'keyword',
        'keterangan_fisik',
        'keterangan_tambahan',
        'abstraksi',
        'gambar',
        'harga_buku',
        'kondisi_buku',
        'fp',
        'jml_pinjam',
        'denda_terlambat',
        'denda_hilang'
    ];

    public function ddc()
    {
        return $this->belongsTo(DDC::class, 'id_ddc');
    }

    public function format()
    {
        return $this->belongsTo(Format::class, 'id_format');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit');
    }

    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class, 'id_pengarang');
    }
} 