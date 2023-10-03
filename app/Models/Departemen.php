<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = "departemens";

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
