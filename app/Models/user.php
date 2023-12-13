<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Auth\MustVerifyEmail ;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    
    protected $fillable = [
        'email', 'password', 'fullname', 'alamat', 'nomor_sim', 'nomor_hp'
    ];
    protected $table = 'users';

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class);
    }
}
