<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = "karyawans";

    public function datainouts()
    {
        return $this->hasMany(Datainout::class);
    }

    public function datamakan()
    {
        return $this->hasMany(Datamakan::class);
    }

    public function rfid()
    {
        return $this->belongsTo(Rfid::class);
    }
}
