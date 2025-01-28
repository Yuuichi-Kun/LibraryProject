<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    protected $table = 'tbl_rak';
    protected $primaryKey = 'id_rak';
    protected $fillable = ['kode_rak', 'rak', 'keterangan'];

    public function ddcs()
    {
        return $this->hasMany(DDC::class, 'id_rak');
    }
} 