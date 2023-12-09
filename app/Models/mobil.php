<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobil extends Model
{
    use HasFactory;
    protected $fillable = [
        'model', 'merek', 'nomor_plat', 'sewa_perhari','status'
    ];
    protected $table = 'mobil';

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class);
    }

    
}
