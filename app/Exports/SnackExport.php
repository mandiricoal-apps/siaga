<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class SnackExport implements FromView
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

        return view('export.snack', [
            'snack' => DB::table('menu')->where('jenis_makanan', 'Snack')->whereBetween('tanggal_berlaku',[$this->awal, $this->akhir])->get()
        ]);
    }
}
