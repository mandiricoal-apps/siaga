<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithTitle;

class PackmealExport implements FromView, WithTitle
{
    private $awal;
    private $akhir;
    private $sheetName;
    public function __construct($awal, $akhir, $sheetName)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
        $this->sheetName = $sheetName;
    }

    public function title(): string
    {
        return $this->sheetName;
    }

    public function view(): View
    {
        $karyawan = json_decode(file_get_contents(public_path('data/karyawan.json')), true);
        $data = array_filter($karyawan, function ($value) {
            return $value['departement'] === Auth::user()->departemen;
        });

        $result = array_column($data, 'nik');
        $latestIds = DB::table('datamakan')
            ->where('kategori', 'Packmeal')
            ->select(DB::raw('MIN(id) as id'))
            ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));

        if (Auth::user()->id_role == 1) {
            return view('export.datamakan', [
                'datamakan' => DB::table('datamakan as dm')->joinSub($latestIds, 'latest_ids', function ($join) {
                    $join->on('dm.id', '=', 'latest_ids.id');
                })->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')->whereIn('dm.shift', ['Pagi', 'Siang', 'Malam'])
                    ->whereIn('dm.nik', $result)->whereBetween('tanggalwaktu', [$this->awal, $this->akhir])->get()
            ]);
        } else {
            return view('export.datamakan', [
                'datamakan' => DB::table('datamakan as dm')
                    ->joinSub($latestIds, 'latest_ids', function ($join) {
                        $join->on('dm.id', '=', 'latest_ids.id');
                    })
                    ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                    ->where('dm.shift', 'Pagi')
                    ->orwhere('dm.shift', 'Siang')
                    ->orwhere('dm.shift', 'Malam')
                    ->whereBetween('tanggalwaktu', [$this->awal, $this->akhir])->get()
            ]);
        }
    }
}
