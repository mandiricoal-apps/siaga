<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menu";

    protected $fillable = ['id', 'nama_makanan','tanggal_berlaku', 'shift','deskripsi','jenis_makanan'];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
