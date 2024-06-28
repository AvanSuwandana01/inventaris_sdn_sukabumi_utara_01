<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';
    protected $fillable = [
        'user_id',
        'barang_id',
        'jumlah',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        // tambahkan field lainnya sesuai kebutuhan
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pengembalians()
    {
        return $this->hasMany(Pengembalian::class);
    }
}
