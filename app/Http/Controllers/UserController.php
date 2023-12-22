<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Menu;

class UserController extends Controller
{

    public function dashboard()
    {
        $date = Carbon::now();
        $time = Carbon::createFromDate($date);

        $lastYear = Carbon::now()->subYear();
        $others_exp = Order::where('jenis_pesanan', 'Others')->whereIn('status',['Diproses', 'Menunggu'])->get();
        $filteredOthers = $others_exp->filter(function ($expOt) use ($date) {
            $otDate = json_decode($expOt->tanggal_pesanan, true);
            $otherDate = $otDate[1];
            return ($date >= $otherDate);
        });

        foreach($filteredOthers as $fo){
            $fo->update([
                'status'=> 'Kadaluwarsa'
            ]);
        }

        $pes_exp = Order::whereIN('jenis_pesanan', ['Snack', 'Menu Spesial'])->whereIn('status',['Diproses', 'Menunggu'])->get();
        $filteredPes = $pes_exp->filter(function ($expPes) use ($date) {
            $pDate = json_decode($expPes->tanggal_pesanan, true);
            $pesDate = $pDate[1];
            return ($date >= $pesDate);
        });

        foreach($filteredPes as $fo){
            $fo->update([
                'status'=> 'Kadaluwarsa'
            ]);
        }

        $menus_dip = Order::where('jenis_pesanan', 'Menu Spesial')->where('status','Menunggu')->get();
        $filteredPesDip = $menus_dip->filter(function ($pesDip) use ($date) {
            $pdDate = json_decode($pesDip->tanggal_pesanan, true);
            $pDipDate = $pdDate[0];
            return ($date >= $pDipDate);
        });

        foreach($filteredPesDip as $fo){
            $fo->update([
                'status'=> 'Diproses'
            ]);
        }

        $snack_dip = Order::where('jenis_pesanan', 'Snack')->where('status','Menunggu')->get();
        $filteredSnackDip = $snack_dip->filter(function ($snackDip) use ($time, $date) {
            $snTime = Carbon::parse($snackDip->waktu_pesanan);
            $snTime->modify('-3 hours');
            $snDate = json_decode($snackDip->tanggal_pesanan, true);
            $sDipDate = $snDate[0];
            return (Carbon::createFromDate($time)->format('H:i:s') >= Carbon::createFromDate($snTime)->format('H:i:s') && Carbon::createFromDate($date)->format('Y-m-d') >= $sDipDate);
        });



        foreach($filteredSnackDip as $fo){
            $fo->update([
                'status'=> 'Diproses'
            ]);
        }

        $jmenus = Menu::where('jenis_makanan', 'Menu Spesial')->whereDate('tanggal_berlaku', $date)->whereMonth('tanggal_berlaku', $date)->whereYear('tanggal_berlaku', $date)->orderByRaw('
        CASE
            WHEN shift = "pagi" THEN 1
            WHEN shift = "siang" THEN 2
            WHEN shift = "malam" THEN 3
            ELSE 4
        END')->get();
        $countMenus = $jmenus->count();
        $groupedMenus = $jmenus->groupBy('shift');

        $jsnacks = Menu::where('jenis_makanan', 'Snack')->whereDate('tanggal_berlaku', $date)->whereMonth('tanggal_berlaku', $date)->whereYear('tanggal_berlaku', $date)->orderByRaw('
        CASE
            WHEN shift = "pagi" THEN 1
            WHEN shift = "siang" THEN 2
            WHEN shift = "malam" THEN 3
            ELSE 4
        END')->get();

        $countSnack = $jsnacks->count();
        $groupedSnacks = $jsnacks->groupBy('shift');

        $jmenur = Menu::where('jenis_makanan', 'Reguler')->whereDate('tanggal_berlaku', $date)->whereMonth('tanggal_berlaku', $date)->whereYear('tanggal_berlaku', $date)->orderByRaw('
        CASE
            WHEN shift = "pagi" THEN 1
            WHEN shift = "siang" THEN 2
            WHEN shift = "malam" THEN 3
            ELSE 4
        END')->get();
        $countMenur = $jmenur->count();
        $groupedMenur = $jmenur->groupBy('shift');


        if (Auth::user()->id_role == 1) {
            $menus = Order::join('users', 'users.id', '=', 'orders.id_user')->where('users.departemen', Auth::user()->departemen)->where('orders.jenis_pesanan', 'Menu Spesial')->whereYear('orders.created_at', $date)->where('orders.status', "Selesai")->count();
            $lmenus = Order::join('users', 'users.id', '=', 'orders.id_user')->where('users.departemen', Auth::user()->departemen)->where('orders.jenis_pesanan', 'Menu Spesial')->whereYear('orders.created_at', $lastYear)->where('orders.status', "Selesai")->count();
            if ($lmenus == 0) {
                $perMenus = 100;
            } else {
                $perMenus = ($menus - $lmenus) / $lmenus * 100;
            }
            $snack = Order::join('users', 'users.id', '=', 'orders.id_user')->where('users.departemen', Auth::user()->departemen)->where('orders.jenis_pesanan', 'Snack')->whereYear('orders.created_at', $date)->where('orders.status', "Selesai")->count();
            $lsnack = Order::join('users', 'users.id', '=', 'orders.id_user')->where('users.departemen', Auth::user()->departemen)->where('orders.jenis_pesanan', 'Snack')->whereYear('orders.created_at', $lastYear)->where('orders.status', "Selesai")->count();
            if ($lsnack == 0) {
                $perSnack = 100;
            } else {
                $perSnack = ($snack - $lsnack) / $lsnack * 100;
            }
            $others = Order::join('users', 'users.id', '=', 'orders.id_user')->where('users.departemen', Auth::user()->departemen)->where('orders.jenis_pesanan', 'Others')->whereYear('orders.created_at', $date)->where('orders.status', "Selesai")->count();
            $lothers = Order::join('users', 'users.id', '=', 'orders.id_user')->where('users.departemen', Auth::user()->departemen)->where('orders.jenis_pesanan', 'Others')->whereYear('orders.created_at', $lastYear)->where('orders.status', "Selesai")->count();
            if ($lothers == 0) {
                $perOthers = 100;
            } else {
                $perOthers = ($others - $lothers) / $lothers * 100;
            }

            $karyawan = json_decode(file_get_contents(public_path('data/karyawan.json')), true);
            $data = array_filter($karyawan, function ($value) {
                return $value['departement'] === Auth::user()->departemen;
            });

            $result = array_column($data, 'nik');
            $IdlastMonth = DB::table('datamakan')
                ->select(DB::raw('MIN(id) as id'))
                ->whereYear('created_at', $lastYear)
                ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));
            $Idnow = DB::table('datamakan')
                ->select(DB::raw('MIN(id) as id'))
                ->whereYear('created_at', $date)
                ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));
            $taping = DB::table('datamakan as dm')
                ->joinSub($Idnow, 'latest_ids', function ($join) {
                    $join->on('dm.id', '=', 'latest_ids.id');
                })
                ->whereMonth('dm.tanggalwaktu', $date)
                ->whereYear('dm.tanggalwaktu', $date)
                ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                ->where('dm.shift', 'Pagi')
                ->orwhere('dm.shift', 'Siang')
                ->orwhere('dm.shift', 'Malam')
                ->whereIn('dm.nik', $result)
                ->count();
            $ltaping = DB::table('datamakan as dm')
                ->joinSub($IdlastMonth, 'latest_ids', function ($join) {
                    $join->on('dm.id', '=', 'latest_ids.id');
                })
                ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                ->where('dm.shift', 'Pagi')
                ->orwhere('dm.shift', 'Siang')
                ->orwhere('dm.shift', 'Malam')
                ->whereIn('dm.nik', $result)
                ->count();
            if ($ltaping == 0) {
                $perTaping = 100;
            } else {
                $perTaping = ($taping - $ltaping) / $ltaping * 100;
            }

            for ($bulan = 1; $bulan <= 12; $bulan++) {
                // Ambil data dari database berdasarkan bulan pesanan
                $orders = Order::join('users', 'users.id', '=', 'orders.id_user')->where('users.departemen', Auth::user()->departemen)->whereMonth('orders.created_at', $bulan)->whereYear('orders.created_at', $date)->where('orders.status', "Selesai")->get();

                $gmenus = 0;
                $gsnack = 0;
                $gothers = 0;

                // Hitung jumlah pesanan berdasarkan jenis pesanan
                foreach ($orders as $order) {
                    if ($order->jenis_pesanan === 'Menu Spesial') {
                        $gmenus++;
                    } elseif ($order->jenis_pesanan === 'Snack') {
                        $gsnack++;
                    } elseif ($order->jenis_pesanan === 'Others') {
                        $gothers++;
                    }
                }

                $Idtaping = DB::table('datamakan')
                    ->select(DB::raw('MIN(id) as id'))
                    ->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $date)
                    ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));

                $gtaping = DB::table('datamakan as dm')
                    ->joinSub($Idtaping, 'latest_ids', function ($join) {
                        $join->on('dm.id', '=', 'latest_ids.id');
                    })
                    ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                    ->where('dm.shift', 'Pagi')
                    ->orwhere('dm.shift', 'Siang')
                    ->orwhere('dm.shift', 'Malam')
                    ->whereIn('dm.nik', $result)
                    ->get();

                $gprasmanan = 0;
                $gpackmeal = 0;

                // Hitung jumlah pesanan berdasarkan jenis pesanan
                foreach ($gtaping as $tap) {
                    if ($tap->kategori === 'Prasmanan') {
                        $gprasmanan++;
                    } elseif ($tap->kategori === 'Packmeal') {
                        $gpackmeal++;
                    }
                }

                // Tambahkan jumlah pesanan ke dalam array $jumlahPesanan
                $jumlahPesanan[] = [$gmenus, $gsnack, $gothers];

                $jumlahTaping[] = [$gprasmanan, $gpackmeal];
            }

            $pesananOthers = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->where('users.departemen', Auth::user()->departemen)
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->take(5)
                ->get();
        }
        if (Auth::user()->id_role == 2) {
            $menus = Order::where('jenis_pesanan', 'Menu Spesial')->whereYear('created_at', $date)->where('status', "Selesai")->count();
            $lmenus = Order::where('jenis_pesanan', 'Menu Spesial')->whereYear('created_at', $lastYear)->where('status', "Selesai")->count();
            if ($lmenus == 0) {
                $perMenus = 100;
            } else {
                $perMenus = ($menus - $lmenus) / $lmenus * 100;
            }
            $snack = Order::where('jenis_pesanan', 'Snack')->whereYear('created_at', $date)->where('status', "Selesai")->count();
            $lsnack = Order::where('jenis_pesanan', 'Snack')->whereYear('created_at', $lastYear)->where('status', "Selesai")->count();
            if ($lsnack == 0) {
                $perSnack = 100;
            } else {
                $perSnack = ($snack - $lsnack) / $lsnack * 100;
            }
            $others = Order::where('jenis_pesanan', 'Others')->whereYear('created_at', $date)->where('status', "Selesai")->count();
            $lothers = Order::where('jenis_pesanan', 'Others')->whereYear('created_at', $lastYear)->where('status', "Selesai")->count();
            if ($lothers == 0) {
                $perOthers = 100;
            } else {
                $perOthers = ($others - $lothers) / $lothers * 100;
            }
            $IdlastMonth = DB::table('datamakan')
                ->select(DB::raw('MIN(id) as id'))
                ->whereYear('created_at', $lastYear)
                ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));
            $Idnow = DB::table('datamakan')
                ->select(DB::raw('MIN(id) as id'))
                ->whereYear('created_at', $date)
                ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));
            $taping = DB::table('datamakan as dm')
                ->joinSub($Idnow, 'latest_ids', function ($join) {
                    $join->on('dm.id', '=', 'latest_ids.id');
                })
                ->whereYear('dm.tanggalwaktu', $date)
                ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                ->where('dm.shift', 'Pagi')
                ->orwhere('dm.shift', 'Siang')
                ->orwhere('dm.shift', 'Malam')
                ->count();
            $ltaping = DB::table('datamakan as dm')
                ->joinSub($IdlastMonth, 'latest_ids', function ($join) {
                    $join->on('dm.id', '=', 'latest_ids.id');
                })
                ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                ->where('dm.shift', 'Pagi')
                ->orwhere('dm.shift', 'Siang')
                ->orwhere('dm.shift', 'Malam')
                ->count();
            if ($ltaping == 0) {
                $perTaping = 100;
            } else {
                $perTaping = ($taping - $ltaping) / $ltaping * 100;
            }
            for ($bulan = 1; $bulan <= 12; $bulan++) {
                // Ambil data dari database berdasarkan bulan pesanan
                $orders = Order::whereMonth('created_at', $bulan)->whereYear('created_at', $date)->where('status', "Selesai")->get();

                $gmenus = 0;
                $gsnack = 0;
                $gothers = 0;

                // Hitung jumlah pesanan berdasarkan jenis pesanan
                foreach ($orders as $order) {
                    if ($order->jenis_pesanan === 'Menu Spesial') {
                        $gmenus++;
                    } elseif ($order->jenis_pesanan === 'Snack') {
                        $gsnack++;
                    } elseif ($order->jenis_pesanan === 'Others') {
                        $gothers++;
                    }
                }

                $Idtaping = DB::table('datamakan')
                    ->select(DB::raw('MIN(id) as id'))
                    ->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $date)
                    ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));

                $gtaping = DB::table('datamakan as dm')
                    ->joinSub($Idtaping, 'latest_ids', function ($join) {
                        $join->on('dm.id', '=', 'latest_ids.id');
                    })
                    ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                    ->where('dm.shift', 'Pagi')
                    ->orwhere('dm.shift', 'Siang')
                    ->orwhere('dm.shift', 'Malam')
                    ->get();

                $gprasmanan = 0;
                $gpackmeal = 0;

                // Hitung jumlah pesanan berdasarkan jenis pesanan
                foreach ($gtaping as $tap) {
                    if ($tap->kategori === 'Prasmanan') {
                        $gprasmanan++;
                    } elseif ($tap->kategori === 'Packmeal') {
                        $gpackmeal++;
                    }
                }

                // Tambahkan jumlah pesanan ke dalam array $jumlahPesanan
                $jumlahPesanan[] = [$gmenus, $gsnack, $gothers];

                $jumlahTaping[] = [$gprasmanan, $gpackmeal];
            }

            $pesananOthers = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->where('orders.status', 'Diproses')
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->get();
        }
        if (Auth::user()->id_role == 3) {
            $menus = Order::where('jenis_pesanan', 'Menu Spesial')->whereYear('created_at', $date)->where('status', "Selesai")->count();
            $lmenus = Order::where('jenis_pesanan', 'Menu Spesial')->whereYear('created_at', $lastYear)->where('status', "Selesai")->count();
            if ($lmenus == 0) {
                $perMenus = 100;
            } else {
                $perMenus = ($menus - $lmenus) / $lmenus * 100;
            }
            $snack = Order::where('jenis_pesanan', 'Snack')->whereYear('created_at', $date)->where('status', "Selesai")->count();
            $lsnack = Order::where('jenis_pesanan', 'Snack')->whereYear('created_at', $lastYear)->where('status', "Selesai")->count();
            if ($lsnack == 0) {
                $perSnack = 100;
            } else {
                $perSnack = ($snack - $lsnack) / $lsnack * 100;
            }
            $others = Order::where('jenis_pesanan', 'Others')->whereYear('created_at', $date)->where('status', "Selesai")->count();
            $lothers = Order::where('jenis_pesanan', 'Others')->whereYear('created_at', $lastYear)->where('status', "Selesai")->count();
            if ($lothers == 0) {
                $perOthers = 100;
            } else {
                $perOthers = ($others - $lothers) / $lothers * 100;
            }

            $IdlastMonth = DB::table('datamakan')
                ->select(DB::raw('MIN(id) as id'))
                ->whereYear('created_at', $lastYear)
                ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));
            $Idnow = DB::table('datamakan')
                ->select(DB::raw('MIN(id) as id'))
                ->whereYear('created_at', $date)
                ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));
            $taping = DB::table('datamakan as dm')
                ->joinSub($Idnow, 'latest_ids', function ($join) {
                    $join->on('dm.id', '=', 'latest_ids.id');
                })
                ->whereMonth('dm.tanggalwaktu', $date)
                ->whereYear('dm.tanggalwaktu', $date)
                ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                ->where('dm.shift', 'Pagi')
                ->orwhere('dm.shift', 'Siang')
                ->orwhere('dm.shift', 'Malam')
                ->count();
            $ltaping = DB::table('datamakan as dm')
                ->joinSub($IdlastMonth, 'latest_ids', function ($join) {
                    $join->on('dm.id', '=', 'latest_ids.id');
                })
                ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                ->where('dm.shift', 'Pagi')
                ->orwhere('dm.shift', 'Siang')
                ->orwhere('dm.shift', 'Malam')
                ->count();
            if ($ltaping == 0) {
                $perTaping = 100;
            } else {
                $perTaping = ($taping - $ltaping) / $ltaping * 100;
            }

            for ($bulan = 1; $bulan <= 12; $bulan++) {
                // Ambil data dari database berdasarkan bulan pesanan
                $orders = Order::whereMonth('created_at', $bulan)->whereYear('created_at', $date)->where('status', "Selesai")->get();

                $gmenus = 0;
                $gsnack = 0;
                $gothers = 0;

                // Hitung jumlah pesanan berdasarkan jenis pesanan
                foreach ($orders as $order) {
                    if ($order->jenis_pesanan === 'Menu Spesial') {
                        $gmenus++;
                    } elseif ($order->jenis_pesanan === 'Snack') {
                        $gsnack++;
                    } elseif ($order->jenis_pesanan === 'Others') {
                        $gothers++;
                    }
                }

                $Idtaping = DB::table('datamakan')
                    ->select(DB::raw('MIN(id) as id'))
                    ->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $date)
                    ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));

                $gtaping = DB::table('datamakan as dm')
                    ->joinSub($Idtaping, 'latest_ids', function ($join) {
                        $join->on('dm.id', '=', 'latest_ids.id');
                    })
                    ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                    ->where('dm.shift', 'Pagi')
                    ->orwhere('dm.shift', 'Siang')
                    ->orwhere('dm.shift', 'Malam')
                    ->get();

                $gprasmanan = 0;
                $gpackmeal = 0;

                // Hitung jumlah pesanan berdasarkan jenis pesanan
                foreach ($gtaping as $tap) {
                    if ($tap->kategori === 'Prasmanan') {
                        $gprasmanan++;
                    } elseif ($tap->kategori === 'Packmeal') {
                        $gpackmeal++;
                    }
                }

                // Tambahkan jumlah pesanan ke dalam array $jumlahPesanan
                $jumlahPesanan[] = [$gmenus, $gsnack, $gothers];

                $jumlahTaping[] = [$gprasmanan, $gpackmeal];
            }

            $pesananOthers = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->where('users.id', Auth::user()->id)
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->take(5)
                ->get();
        }
        if (Auth::user()->id_role == 4) {
            $menus = Order::where('jenis_pesanan', 'Menu Spesial')->whereYear('created_at', $date)->where('status', "Selesai")->count();
            $lmenus = Order::where('jenis_pesanan', 'Menu Spesial')->whereYear('created_at', $lastYear)->where('status', "Selesai")->count();
            if ($lmenus == 0) {
                $perMenus = 100;
            } else {
                $perMenus = ($menus - $lmenus) / $lmenus * 100;
            }
            $snack = Order::where('jenis_pesanan', 'Snack')->whereYear('created_at', $date)->where('status', "Selesai")->count();
            $lsnack = Order::where('jenis_pesanan', 'Snack')->whereYear('created_at', $lastYear)->where('status', "Selesai")->count();
            if ($lsnack == 0) {
                $perSnack = 100;
            } else {
                $perSnack = ($snack - $lsnack) / $lsnack * 100;
            }
            $others = Order::where('jenis_pesanan', 'Others')->whereYear('created_at', $date)->where('status', "Selesai")->count();
            $lothers = Order::where('jenis_pesanan', 'Others')->whereYear('created_at', $lastYear)->where('status', "Selesai")->count();
            if ($lothers == 0) {
                $perOthers = 100;
            } else {
                $perOthers = ($others - $lothers) / $lothers * 100;
            }

            $IdlastMonth = DB::table('datamakan')
                ->select(DB::raw('MIN(id) as id'))
                ->whereYear('created_at', $lastYear)
                ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));
            $Idnow = DB::table('datamakan')
                ->select(DB::raw('MIN(id) as id'))
                ->whereYear('created_at', $date)
                ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));
            $taping = DB::table('datamakan as dm')
                ->joinSub($Idnow, 'latest_ids', function ($join) {
                    $join->on('dm.id', '=', 'latest_ids.id');
                })
                ->whereMonth('dm.tanggalwaktu', $date)
                ->whereYear('dm.tanggalwaktu', $date)
                ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                ->where('dm.shift', 'Pagi')
                ->orwhere('dm.shift', 'Siang')
                ->orwhere('dm.shift', 'Malam')
                ->count();
            $ltaping = DB::table('datamakan as dm')
                ->joinSub($IdlastMonth, 'latest_ids', function ($join) {
                    $join->on('dm.id', '=', 'latest_ids.id');
                })
                ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                ->where('dm.shift', 'Pagi')
                ->orwhere('dm.shift', 'Siang')
                ->orwhere('dm.shift', 'Malam')
                ->count();
            if ($ltaping == 0) {
                $perTaping = 100;
            } else {
                $perTaping = ($taping - $ltaping) / $ltaping * 100;
            }

            for ($bulan = 1; $bulan <= 12; $bulan++) {
                // Ambil data dari database berdasarkan bulan pesanan
                $orders = Order::whereMonth('created_at', $bulan)->whereYear('created_at', $date)->where('status', "Selesai")->get();

                $gmenus = 0;
                $gsnack = 0;
                $gothers = 0;

                // Hitung jumlah pesanan berdasarkan jenis pesanan
                foreach ($orders as $order) {
                    if ($order->jenis_pesanan === 'Menu Spesial') {
                        $gmenus++;
                    } elseif ($order->jenis_pesanan === 'Snack') {
                        $gsnack++;
                    } elseif ($order->jenis_pesanan === 'Others') {
                        $gothers++;
                    }
                }

                $Idtaping = DB::table('datamakan')
                    ->select(DB::raw('MIN(id) as id'))
                    ->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $date)
                    ->groupBy('shift', 'nik', DB::raw('DATE(tanggalwaktu)'));

                $gtaping = DB::table('datamakan as dm')
                    ->joinSub($Idtaping, 'latest_ids', function ($join) {
                        $join->on('dm.id', '=', 'latest_ids.id');
                    })
                    ->select('dm.id', 'dm.shift', DB::raw('DATE(dm.tanggalwaktu) as tanggal'), 'dm.*')
                    ->where('dm.shift', 'Pagi')
                    ->orwhere('dm.shift', 'Siang')
                    ->orwhere('dm.shift', 'Malam')
                    ->get();

                $gprasmanan = 0;
                $gpackmeal = 0;

                // Hitung jumlah pesanan berdasarkan jenis pesanan
                foreach ($gtaping as $tap) {
                    if ($tap->kategori === 'Prasmanan') {
                        $gprasmanan++;
                    } elseif ($tap->kategori === 'Packmeal') {
                        $gpackmeal++;
                    }
                }

                // Tambahkan jumlah pesanan ke dalam array $jumlahPesanan
                $jumlahPesanan[] = [$gmenus, $gsnack, $gothers];

                $jumlahTaping[] = [$gprasmanan, $gpackmeal];
            }

            $pesananOthers = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->where('orders.jenis_pesanan', "Others")
                ->where('orders.status', 'Menunggu')
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->get();
        }

        return view('home.dashboard', [
            'menus' => $menus,
            'snack' => $snack,
            'others' => $others,
            'taping' => $taping,
            'perMenus' => $perMenus,
            'perSnack' => $perSnack,
            'perOthers' => $perOthers,
            'perTaping' => $perTaping,
            'jumlahPesanan'  => $jumlahPesanan,
            'jumlahTaping'  => $jumlahTaping,
            'pesananOthers' => $pesananOthers,
            'countMenus' => $countMenus,
            'groupedMenus' => $groupedMenus,
            'jsnacks' => $jsnacks,
            'countSnack' => $countSnack,
            'groupedSnacks' => $groupedSnacks,
            'countMenur' => $countMenur,
            'groupedMenur' => $groupedMenur
        ]);
    }

    public function kelolapengguna()
    {
        $karyawan = json_decode(file_get_contents(public_path('data/karyawan.json')), true);
        $roles = Role::all();
        $pengguna = User::all();
        return view('ga.kelolapengguna', [
            'karyawan' => $karyawan,
            'pengguna' => $pengguna,
            'roles' => $roles
        ]);
    }

    public function add_user(Request $request)
    {
        $user = new User;
        $user->name = $request->input('namal');
        $user->nik = $request->input('nik');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->level = $request->input('level');
        $user->departemen = $request->input('departemen');
        $user->divisi = $request->input('divisi');
        $user->perusahaan = $request->input('perusahaan');
        $user->no_telp = $request->input('no_telp');
        $user->id_role = $request->input('role');
        $user->save();

        Session::flash('success', 'Menu berhasil disimpan.');

        return redirect()->route("kelolapengguna");
    }

    public function update_user(Request $request, $id)
    {
        $role = 'urole' . $id;
        $status = 'status' . $id;
        $pengguna = User::find($id);
        if ($request->$role != null) {
            $pengguna->update([
                'id_role' => $request->$role
            ]);
        }
        if ($request->$status != null) {
            $pengguna->update([
                'status' => $request->$status
            ]);
        }

        return redirect()->route("kelolapengguna");
    }

    public function vprofile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (Auth::user()->id_role == 1) {
            return view('departemen.profile', [
                'user' => $user
            ]);
        }
        if (Auth::user()->id_role == 2) {
            return view('catering.profile', [
                'user' => $user
            ]);
        }
        if (Auth::user()->id_role == 3) {
            return view('hrd.profile', [
                'user' => $user
            ]);
        }
        if (Auth::user()->id_role == 4) {
            return view('ga.profile', [
                'user' => $user
            ]);
        }
    }

    public function upPassword(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $errorMessages = [];

        $password = $request->password;
        $password_knf = $request->password_konfirmasi;

        if ($password == $password_knf) {
            $user->update([
                'password' => Hash::make($password)
            ]);
        } else {
            $errorMessages[] = "Password dan Konfirmasi Password Tidak Sesuai! Silahkan Coba Lagi";
        }

        if (!empty($errorMessages)) {
            Session::flash('error', implode('<br>', $errorMessages));
            return back();
        } else {
            Auth::logout();
            $request->session()->invalidate();
            return redirect()->route('login')->with('success', 'Password Berhasil Diubah. Silahkan Masuk Kembali!');
        }
    }

    public function markAsRead($id)
    {
        Auth::user()->notifications()->find($id)->markAsRead();
        $notif = Auth::user()->notifications()->find($id);
        $pesanan = $notif->data['pesananId'];
        if ($notif->data['tujuan'] != 'permintaan') {
            if (Auth::user()->id_role == 2) {
                return redirect("/data-pesanan?pesanan=" . $pesanan);
            } else {
                return redirect("/riwayat-pesanan?pesanan=" . $pesanan);
            }
        } else {
            return redirect("/permintaan-pesanan?pesanan=" . $pesanan);
        }
    }
}











