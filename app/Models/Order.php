<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    public function menu()
    {
        return $this->belongsToMany(Menu::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
