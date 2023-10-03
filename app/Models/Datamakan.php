<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datamakan extends Model
{
    protected $table = "datamakan";

    public function karyawans()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
