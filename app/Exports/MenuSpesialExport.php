<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class MenuSpesialExport implements FromView
{
    private $awal;
    private $akhir;
    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    public function view(): View
    {

        return view('export.menuspesial', [
            'menus' => DB::table('menu')->where('jenis_makanan', 'Menu Spesial')->whereBetween('tanggal_berlaku',[$this->awal, $this->akhir])->get()
        ]);
    }
}


