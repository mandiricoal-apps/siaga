<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datainout extends Model
{
    protected $table = "datainouts";

    public function karyawans()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
