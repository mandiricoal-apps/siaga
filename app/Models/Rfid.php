<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    protected $table = "rfid";

    public function datamakan()
    {
        return $this->hasMany(Datamakan::class);
    }
}
