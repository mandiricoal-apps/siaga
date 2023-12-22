<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananExport implements WithMultipleSheets
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
        $sheets[0] = new SnackOrderExport($this->awal, $this->akhir, 'Snack');
        $sheets[1] = new MenusOrderExport($this->awal, $this->akhir, 'Menu Spesial');
        $sheets[2] = new OtherOrderExport($this->awal, $this->akhir, 'Others');
        return $sheets;
    } //


}
