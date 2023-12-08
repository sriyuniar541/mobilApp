<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id', 'mobil_id', 'tgl_awal_sewa', 'tgl_akhir_sewa', 'lama_sewa', 'total'
    ];
    protected $table = 'sewa_mobil';
}
