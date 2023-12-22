<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Datamakan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataMakanController extends Controller
{
    public function prasmanan(Request $request)
    {
        $lokasi = $request->input('loc');
        $today = Carbon::now();
        $day = $today->translatedFormat('l, d F Y ', 'id');
        return view('component.taping', [
            'day' => $day,
            'lokasi' => $lokasi
        ]);
    }

    public function packmeal(Request $request)
    {
        $lokasi = $request->input('loc');
        $today = Carbon::now();
        $day = $today->translatedFormat('l, d F Y ', 'id');
        return view('component.tapingpackmeal', [
            'day' => $day,
            'lokasi' => $lokasi
        ]);
    }

    public function datataping()
    {
        $karyawan = json_decode(file_get_contents(public_path('data/karyawan.json')), true);
        $data = array_filter($karyawan, function ($value) {
            return $value['departement'] === Auth::user()->departemen;
        });

        $result = array_column($data, 'nik');
        $latestIds = DB::table('datamakan')
            ->select(DB::raw('MIN(id) as id'))
            ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));
        if (Auth::user()->id_role == 1) {
            $taping = DB::table('datamakan as dm')
                ->joinSub($latestIds, 'latest_ids', function ($join) {
                    $join->on('dm.id', '=', 'latest_ids.id');
                })
                ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                ->whereIn('dm.shift', ['Pagi','Siang','Malam'])
                ->whereIn('dm.nik', $result)
                ->get();
        } else {
            $taping = DB::table('datamakan as dm')
                ->joinSub($latestIds, 'latest_ids', function ($join) {
                    $join->on('dm.id', '=', 'latest_ids.id');
                })
                ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                ->where('dm.shift', 'Pagi')
                ->orwhere('dm.shift', 'Siang')
                ->orwhere('dm.shift', 'Malam')
                ->get();
        }

        if (Auth::user()->id_role == 1) {
            return view('departemen.datataping', [
                'taping' => $taping
            ]);
        }
        if (Auth::user()->id_role == 2) {
            return view('catering.datataping', [
                'taping' => $taping
            ]);
        }
        if (Auth::user()->id_role == 3) {
            return view('hrd.datataping', [
                'taping' => $taping
            ]);
        }
        if (Auth::user()->id_role == 4) {
            return view('ga.datataping', [
                'taping' => $taping
            ]);
        }
    }

    public function simpanTaping(Request $request)
    {

        $now = Carbon::now()->format("Y-m-d H:i:s");

        $taping = new Datamakan();
        $taping->nik = $request->nik;
        $taping->nama = $request->nama;
        $taping->shift = $request->shift;
        $taping->tanggalwaktu = $now;
        $taping->kategori = "Prasmanan";
        $taping->lokasi = $request->lokasi;
        $taping->save();

        return back();
    }

    public function simpanPackmeal(Request $request)
    {

        $now = Carbon::now()->format("Y-m-d H:i:s");

        $taping = new Datamakan();
        $taping->nik = $request->nik;
        $taping->nama = $request->nama;
        $taping->shift = $request->shift;
        $taping->tanggalwaktu = $now;
        $taping->kategori = "Packmeal";
        $taping->lokasi = $request->lokasi;
        $taping->save();

        return back();
    }
}
