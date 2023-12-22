<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataMakanExport implements WithMultipleSheets
{
    private $awal;
    private $akhir;
    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    public function sheets(): array
    {
        $sheets = [];
        $sheets[0] = new PrasmananExport($this->awal, $this->akhir, 'Prasmanan');
        $sheets[1] = new PackmealExport($this->awal, $this->akhir, 'Packmeal');
        return $sheets;
    } //


}
