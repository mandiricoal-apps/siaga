<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = ['status','alasan','makanan','tanggal_pesanan', 'shift', 'jumlah_pesanan', 'detail_karyawan', 'catatan','lokasi_pengantaran','alasan_pemesanan'];

    public function menu()
    {
        return $this->belongsToMany(Menu::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
