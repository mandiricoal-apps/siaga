<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use App\Notifications\UserOrder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //Perbaikan
    public function data_pesanan(Request $request)
    {  //data pesanan catering
        if ($request->input('pesanan') != null) {
            $orders = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->where('orders.id', $request->input('pesanan'))
                ->where(function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('orders.jenis_pesanan', ['Menu Spesial', 'Snack'])
                            ->whereIn('orders.status', ['Menunggu', 'Diproses', 'Selesai', 'Dibatalkan']);
                    })->orWhere(function ($query) {
                        $query->where('orders.jenis_pesanan', 'Others')
                            ->whereIn('orders.status', ['Diproses', 'Selesai']);
                    });
                })
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->get();
        } else {
            $orders = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->where(function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('orders.jenis_pesanan', ['Menu Spesial', 'Snack'])
                            ->whereIn('orders.status', ['Menunggu', 'Diproses', 'Selesai', 'Dibatalkan']);
                    })->orWhere(function ($query) {
                        $query->where('orders.jenis_pesanan', 'Others')
                            ->whereIn('orders.status', ['Diproses', 'Selesai']);
                    });
                })
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->get();
        }

        return view('catering.datapesanan', [
            'orders' => $orders
        ]);
    }

    public function selesai($id)
    {
        $order = Order::find($id);
        $order->update([
            'status' => 'Selesai'
        ]);

        $tgl_dikirim = json_decode($order->tanggal_pesanan, true);

        $notif_user = 'Pesanan ' . $order->jenis_menu . ' untuk ' . Carbon::createFromDate($tgl_dikirim[0])->format('d M Y') . ' - ' . Carbon::createFromDate($tgl_dikirim[1])->format('d M Y') . ' pukul ' . Carbon::createFromDate($order->waktu_pesanan)->format('H.i') . ' Sudah Selesai';
        $users = User::where('id', $order->id_user)->first();
        $users->notify(new UserOrder('riwayat', $notif_user, $id));

        return redirect()->route('datapesanan')->with('success', "Data berhasil diubah");
    }

    public function riwayat_pesanan(Request $request)
    {  //riwayat pesanan
        if ($request->input('pesanan') != null) {
            $karyawan = json_decode(file_get_contents(public_path('data/karyawan.json')), true);
            $orders = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->where('orders.id', $request->input('pesanan'))
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->get();
            $orders = $orders->sortByDesc('created_at');
        } else {
            $karyawan = json_decode(file_get_contents(public_path('data/karyawan.json')), true);
            $orders = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->where('orders.id_user', Auth::user()->id)
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->get();

            $orders = $orders->sortByDesc('created_at');
        }


        if (Auth::user()->id_role == 1) {
            return view('departemen.riwayatpesanan', [
                'karyawan' => $karyawan,
                'orders' => $orders,
            ]);
        }
        if (Auth::user()->id_role == 2) {
            return view('home.dashboard');
        }
        if (Auth::user()->id_role == 3) {
            return view('hrd.riwayatpesanan', [
                'karyawan' => $karyawan,
                'orders' => $orders,
            ]);
        }
        if (Auth::user()->id_role == 4) {
            return view('ga.riwayatpesanan', [
                'karyawan' => $karyawan,
                'orders' => $orders,
            ]);
        }
    }

    public function ubah_pesanan($id)
    {  //ubah pesanan
        $karyawan = json_decode(file_get_contents(public_path('data/karyawan.json')), true);
        $orders = Order::find($id);

        if (Auth::user()->id_role == 1) {
            return view('departemen.ubahpesanan', [
                'karyawan' => $karyawan,
                'orders' => $orders
            ]);
        }
        if (Auth::user()->id_role == 2) {
            return view('home.dashboard');
        }
        if (Auth::user()->id_role == 3) {
            return view('hrd.ubahpesanan', [
                'karyawan' => $karyawan,
                'orders' => $orders
            ]);
        }
        if (Auth::user()->id_role == 4) {
            return view('ga.ubahpesanan', [
                'karyawan' => $karyawan,
                'orders' => $orders
            ]);
        }
    }

    public function getMenu(Request $request)
    { //mengambil data menu yang tersedia
        $jenisMenu = $request->input('jenisMenu');
        $tanggalPesanan1 = $request->input('tanggalPesanan1');
        $tanggalPesanan2 = $request->input('tanggalPesanan2');
        $waktuPesanan = $request->input('waktuPesanan');

        // Query database untuk mendapatkan menu berdasarkan jenis dan tanggal
        if (Carbon::parse($waktuPesanan)->greaterThanOrEqualTo(Carbon::parse('07:00')) && Carbon::parse($waktuPesanan)->lessThan(Carbon::parse('12:00'))) {
            $menu = Menu::where('jenis_makanan', $jenisMenu)
                ->whereBetween('tanggal_berlaku', [$tanggalPesanan1, $tanggalPesanan2])
                ->where('shift', 'Pagi')
                ->orderBy('tanggal_berlaku', 'asc')
                ->get();
        }
        if (Carbon::parse($waktuPesanan)->greaterThanOrEqualTo(Carbon::parse('12:00')) && Carbon::parse($waktuPesanan)->lessThan(Carbon::parse('15:00'))) {
            $menu = Menu::where('jenis_makanan', $jenisMenu)
                ->whereBetween('tanggal_berlaku', [$tanggalPesanan1, $tanggalPesanan2])
                ->where('shift', 'Siang')
                ->orderBy('tanggal_berlaku', 'asc')
                ->get();
        }
        if (Carbon::parse($waktuPesanan)->greaterThanOrEqualTo(Carbon::parse('15:00')) && Carbon::parse($waktuPesanan)->lessThan(Carbon::parse('18:00'))) {
            $menu = Menu::where('jenis_makanan', $jenisMenu)
                ->whereBetween('tanggal_berlaku', [$tanggalPesanan1, $tanggalPesanan2])
                ->where('shift', 'Malam')
                ->orderBy('tanggal_berlaku', 'asc')
                ->get();
        }

        if (count($menu) != 0) {
            foreach ($menu as $item) {
                $makanan[] = json_decode($item->nama_makanan, true);
                $tglMakan[] = $item->tanggal_berlaku;
            }
            $data[] = [
                'makanan' => $makanan,
                'tglMakan' => $tglMakan
            ];

            return $data;
        } else {
            return "Makanan Tidak Tersedia"; // Tindakan yang sesuai jika menu tidak ditemukan
        }
    }

    // public function pesanan(Request $request)
    // {
    //     $tPes = explode(' to ', $request->tanggal_pesanan);
    //     dd($tPes);
    //     $now = Carbon::now()->format("Y-m-d");
    //     $sekarang = Carbon::createFromDate($now);
    //     $tanggal = Carbon::createFromDate($request->tanggal_pesanan)->format("d F Y");
    //     $tgl_pesanan = Carbon::createFromDate($request->tanggal_pesanan)->format("Y-m-d");
    //     $time = Carbon::now()->format("H:i:s");
    //     $waktu = Carbon::createFromDate($request->tanggal_pesanan)->format("H:i:s");
    //     $waktu_sekarang = Carbon::createFromDate($time);
    //     $waktu_pesanan = Carbon::createFromDate($waktu);
    //     $tgl = Carbon::now()->format("Y-m-d");
    //     $tglPes = Carbon::createFromDate($request->tanggal_pesanan)->format("Y-m-d");

    //     $tgl_dikirim = Carbon::create($request->tanggal_pesanan)->format("Y-m-d H:i:s");

    //     $errorMessages = [];


    //     if ($sekarang->greaterThanOrEqualTo($tgl_pesanan) && $request->jenis_menu == "Menu Spesial") {
    //         $errorMessages[] = "Kamu tidak dapat lagi memesan menu pada " . $tanggal;
    //     }
    //     if ($waktu_sekarang->greaterThanOrEqualTo($waktu_pesanan) && $request->jenis_menu == "Snack" && $tgl == $tglPes) {
    //         $errorMessages[] = "Kamu tidak dapat lagi memesan snack sekarang. Pesan snack 3 jam sebelum tanggal pengiriman";
    //     } else {
    //         $order = new Order();
    //         if ($waktu_pesanan->greaterThanOrEqualTo(Carbon::createFromDate('07:00:00')) && $waktu_pesanan->lessThan(Carbon::createFromDate('11:00:00'))) {
    //             $order->shift = "Pagi";
    //         }
    //         if ($waktu_pesanan->greaterThanOrEqualTo(Carbon::createFromDate('11:00:00')) && $waktu_pesanan->lessThan(Carbon::createFromDate('17:00:00'))) {
    //             $order->shift = "Siang";
    //         }
    //         if ($waktu_pesanan->greaterThanOrEqualTo(Carbon::createFromDate('17:00:00')) && $waktu_pesanan->lessThan(Carbon::createFromDate('20:00:00'))) {
    //             $order->shift = "Malam";
    //         }
    //         $order->jenis_pesanan = $request->jenis_menu;
    //         $order->tanggal_pesanan = $tgl_dikirim;
    //         $order->jumlah_pesanan = json_encode($request->input('jumlah_pesanan'));
    //         $order->detail_karyawan = implode(',', $request->input('detail_karyawan'));
    //         $order->makanan = json_encode($request->input('makanan'));
    //         $order->catatan = $request->catatan;
    //         $order->lokasi_pengantaran = $request->lokasi;
    //         $order->alasan_pemesanan = $request->alasan_pemesanan;
    //         $order->id_user = Auth::user()->id;
    //         if ($request->jenis_menu != "Others") {
    //             $order->status = "Diproses";
    //         }
    //         $order->save();
    //     }

    //     if ($request->jenis_menu == "Others") {
    //         $status = "Menunggu Persetujuan";
    //     } else {
    //         $status = " Sedang Diproses";
    //     }

    //     $latestOrder = Order::where('id_user', Auth::user()->id)->latest()->first();

    //     if ($request->jenis_menu == "Others") {
    //         $notif_user = 'Pesanan ' . $request->jenis_menu . ' untuk ' . Carbon::createFromDate($tgl_dikirim)->format('d M Y') . ' pukul ' . Carbon::createFromDate($tgl_dikirim)->format('H.i') . ' ' . $status;
    //         $notif_others = 'Pesanan ' . $request->jenis_menu . ' dari Departemen ' . Auth::user()->departemen . ' untuk ' . Carbon::createFromDate($tgl_dikirim)->format('d M Y') . ' Memerlukan Konfirmasi';
    //         $users = User::where('id_role', 4)->get();
    //         foreach ($users as $user) {
    //             $user->notify(new UserOrder('permintaan', $notif_others, $latestOrder->id));
    //         }
    //         User::find(Auth::user()->id)->notify(new UserOrder('riwayat', $notif_user, $latestOrder->id));
    //     } else {
    //         $notif_user = 'Pesanan ' . $request->jenis_menu . ' untuk ' . Carbon::createFromDate($tgl_dikirim)->format('d M Y') . ' pukul ' . Carbon::createFromDate($tgl_dikirim)->format('H.i') . ' ' . $status;
    //         $notif_others = 'Pesanan ' . $request->jenis_menu . ' dari Departemen ' . Auth::user()->departemen . ' untuk ' . Carbon::createFromDate($tgl_dikirim)->format('d M Y') . ' pukul ' . Carbon::createFromDate($tgl_dikirim)->format('H.i');
    //         $users = User::where('id_role', 2)->get();
    //         foreach ($users as $user) {
    //             $user->notify(new UserOrder('data', $notif_others, $latestOrder->id));
    //         }
    //         User::find(Auth::user()->id)->notify(new UserOrder('riwayat', $notif_user, $latestOrder->id));
    //     }

    //     if (!empty($errorMessages)) {
    //         // Simpan pesan error ke dalam Session
    //         Session::flash('error', implode('<br>', $errorMessages));
    //     } else {
    //         // Jika berhasil, tampilkan pesan sukses
    //         Session::flash('success', 'Pesanan berhasil dibuat.');
    //     }
    //     return redirect()->route('riwayatpesanan');
    // }

    public function pesanan(Request $request)
    {
        $tPes = explode(' to ', $request->tanggal_pesanan);
        $now = Carbon::now()->format("Y-m-d");
        $sekarang = Carbon::createFromDate($now);
        $tanggal = Carbon::createFromDate($tPes[0])->format("d F Y");
        $tgl_pesanan = Carbon::createFromDate($tPes[0])->format("Y-m-d");
        $time = Carbon::now()->format("H:i:s");
        $waktu = Carbon::createFromDate($request->waktu_pesanan)->format("H:i:s");
        $waktu_sekarang = Carbon::createFromDate($time);
        $waktu_pesanan = Carbon::createFromDate($waktu);
        $waktu_pesanan->modify('-3 hours');
        $tgl = Carbon::now()->format("Y-m-d");
        $tglPes = Carbon::createFromDate($tPes[0])->format("Y-m-d");

        $tgl_dikirim = Carbon::create($tPes[0])->format("Y-m-d H:i:s");
        $tgl_Adikirim = Carbon::create($tPes[1])->format("Y-m-d H:i:s");

        $errorMessages = [];


        if ($sekarang->greaterThanOrEqualTo($tgl_pesanan) && $request->jenis_menu == "Menu Spesial") {
            $errorMessages[] = "Kamu tidak dapat lagi memesan menu pada " . $tanggal;
        }
        if ($waktu_sekarang->greaterThanOrEqualTo($waktu_pesanan) && $request->jenis_menu == "Snack" && $tgl == $tglPes) {
            $errorMessages[] = "Kamu tidak dapat lagi memesan snack sekarang. Pesan snack 3 jam sebelum tanggal pengiriman";
        } else {
            $order = new Order();
            if ($waktu_pesanan->greaterThanOrEqualTo(Carbon::createFromDate('07:00:00')) && $waktu_pesanan->lessThan(Carbon::createFromDate('11:00:00'))) {
                $order->shift = "Pagi";
            }
            if ($waktu_pesanan->greaterThanOrEqualTo(Carbon::createFromDate('11:00:00')) && $waktu_pesanan->lessThan(Carbon::createFromDate('17:00:00'))) {
                $order->shift = "Siang";
            }
            if ($waktu_pesanan->greaterThanOrEqualTo(Carbon::createFromDate('17:00:00')) && $waktu_pesanan->lessThan(Carbon::createFromDate('20:00:00'))) {
                $order->shift = "Malam";
            }
            $menu = Menu::where('jenis_makanan', $request->jenis_menu)
                ->whereBetween('tanggal_berlaku', [$tPes[0], $tPes[1]])
                ->where('shift', $order->shift)
                ->orderBy('tanggal_berlaku', 'asc')
                ->get();
            foreach ($menu as $idMenu) {
                $menuId[] = $idMenu->id;
            }
            $order->jenis_pesanan = $request->jenis_menu;
            $order->tanggal_pesanan = json_encode($tPes);
            $order->waktu_pesanan = $waktu;
            $order->jumlah_pesanan = json_encode($request->input('jumlah_pesanan'));
            $order->detail_karyawan = implode(',', $request->input('detail_karyawan'));
            $order->makanan = json_encode($request->input('makanan'));
            $order->catatan = $request->catatan;
            $order->lokasi_pengantaran = $request->lokasi;
            $order->alasan_pemesanan = $request->alasan_pemesanan;
            $order->id_user = Auth::user()->id;
            if (count($menu) != 0) {
                $order->id_menu = json_encode($menuId);
            }
            $order->save();
        }

        if ($request->jenis_menu == "Others") {
            $status = "Menunggu Persetujuan";
        } else {
            $status = " Sedang Diproses";
        }

        $latestOrder = Order::where('id_user', Auth::user()->id)->latest()->first();

        if ($request->jenis_menu == "Others") {
            $notif_user = 'Pesanan ' . $request->jenis_menu . ' untuk ' . Carbon::createFromDate($tgl_dikirim)->format('d M Y') . ' - ' . Carbon::createFromDate($tgl_Adikirim)->format('d M Y') . ' pukul ' . Carbon::createFromDate($waktu_pesanan)->format('H.i') . ' ' . $status;
            $notif_others = 'Pesanan ' . $request->jenis_menu . ' dari Departemen ' . Auth::user()->departemen . ' untuk ' . Carbon::createFromDate($tgl_dikirim)->format('d M Y') . ' - ' . Carbon::createFromDate($tgl_Adikirim)->format('d M Y') . ' Memerlukan Konfirmasi';
            $users = User::where('id_role', 4)->get();
            foreach ($users as $user) {
                $user->notify(new UserOrder('permintaan', $notif_others, $latestOrder->id));
            }
            User::find(Auth::user()->id)->notify(new UserOrder('riwayat', $notif_user, $latestOrder->id));
        } else {
            $notif_user = 'Pesanan ' . $request->jenis_menu . ' untuk ' . Carbon::createFromDate($tgl_dikirim)->format('d M Y') . ' - ' . Carbon::createFromDate($tgl_Adikirim)->format('d M Y') . ' pukul ' . Carbon::createFromDate($waktu_pesanan)->format('H.i') . ' ' . $status;
            $notif_others = 'Pesanan ' . $request->jenis_menu . ' dari Departemen ' . Auth::user()->departemen . ' untuk ' . Carbon::createFromDate($tgl_dikirim)->format('d M Y') . ' - ' . Carbon::createFromDate($tgl_Adikirim)->format('d M Y') . ' pukul ' . Carbon::createFromDate($waktu_pesanan)->format('H.i');
            $users = User::where('id_role', 2)->get();
            foreach ($users as $user) {
                $user->notify(new UserOrder('data', $notif_others, $latestOrder->id));
            }
            User::find(Auth::user()->id)->notify(new UserOrder('riwayat', $notif_user, $latestOrder->id));
        }

        if (!empty($errorMessages)) {
            // Simpan pesan error ke dalam Session
            Session::flash('error', implode('<br>', $errorMessages));
            return back();
        } else {
            // Jika berhasil, tampilkan pesan sukses
            Session::flash('success', 'Pesanan berhasil dibuat.');
            return redirect()->route('riwayatpesanan');
        }
    }

    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function cancelpesanan(Request $request, $id)
    {
        $orders = Order::find($id);
        $orders->update([
            'status' => 'Dibatalkan',
            'alasan' => $request->alasan,
        ]);
        $tglPes = json_decode($orders->tanggal_pesanan, true);

        $users = User::where('id', $orders->id_user)->first();
        $notif_user = 'Pesanan ' . $request->jenis_menu . ' untuk ' . Carbon::createFromDate($tglPes[0])->format('d M Y') . ' - ' . Carbon::createFromDate($tglPes[1])->format('d M Y') . ' pukul ' . Carbon::createFromDate($orders->waktu_pesanan)->format('H.i') . ' Dibatalkan ';
        $users->notify(new UserOrder('riwayat', $notif_user, $id));

        if (!empty($errorMessages)) {
            // Simpan pesan error ke dalam Session
            $errorString = implode('<br>', array_unique($errorMessages));
            Session::flash('error', $errorString);
            return back();
        } else {
            if (Auth::user()->id_role == 1) {
                return redirect()->route('riwayatpesanan')->with('success', 'Data Berhasil Diubah.');
            }
            if (Auth::user()->id_role == 2) {
                return redirect()->route('datapesanan')->with('success', 'Data Berhasil Diubah.');
            }
            if (Auth::user()->id_role == 3) {
                return redirect()->route('riwayatpesanan')->with('success', 'Data Berhasil Diubah.');
            }
            if (Auth::user()->id_role == 4) {
                return redirect()->route('riwayatpesanan')->with('success', 'Data Berhasil Diubah.');
            }
        }
    }

    public function updatePesanan(Request $request, $id) //Belum Siap
    {
        $pes = Order::find($id);
        $tPes = json_decode($pes->tanggal_pesanan, true);
        $now = Carbon::now()->format("Y-m-d");
        $sekarang = Carbon::createFromDate($now);
        $tanggal = Carbon::createFromDate($tPes[0])->format("d F Y");
        $tgl_pesanan = Carbon::createFromDate($tPes[0])->format("Y-m-d");
        $time = Carbon::now()->format("H:i:s");
        $waktu = Carbon::createFromDate($request->waktu_pesanan)->format("H:i:s");
        $waktu_sekarang = Carbon::createFromDate($time);
        $waktu_pesanan = Carbon::createFromDate($waktu);
        $tgl = Carbon::now()->format("Y-m-d");
        $tglPes = Carbon::createFromDate($tPes[0])->format("Y-m-d");
        $tglAPes = Carbon::createFromDate($tPes[1])->format("Y-m-d");
        $orders = Order::find($id);
        $errorMessages = [];


        if ($sekarang->greaterThanOrEqualTo($tgl_pesanan) && $request->jenis_menu == "Menu Spesial") {
            $errorMessages[] = "Kamu tidak dapat lagi memesan menu pada " . $tanggal;
        }
        if ($waktu_pesanan->greaterThanOrEqualTo($waktu_sekarang) && $request->jenis_menu == "Snack" && $tgl == $tglPes) {
            $errorMessages[] = "Kamu tidak dapat lagi memesan snack sekarang. Pesan snack 3 jam sebelum tanggal pengiriman";
        } else {
            if ($orders->jenis_pesanan == 'Others') {
                $orders->update([
                    'status' => "Menunggu"
                ]);
                $notif_user = 'Pesanan ' . $request->jenis_menu . ' untuk ' . Carbon::createFromDate($tglPes)->format('d M Y') . ' - ' . Carbon::createFromDate($tglAPes)->format('d M Y') . ' pukul ' . Carbon::createFromDate($orders->waktu_pesanan)->format('H.i') . ' Diperbaharui';
                $notif_others = 'Pesanan ' . $request->jenis_menu . ' dari Departemen ' . Auth::user()->departemen . ' untuk ' .  Carbon::createFromDate($tglPes)->format('d M Y') . ' - ' . Carbon::createFromDate($tglAPes)->format('d M Y') . ' pukul ' . Carbon::createFromDate($orders->waktu_pesanan)->format('H.i') . ' Diperbaharui';
                $notif_catering = 'Pesanan ' . $request->jenis_menu . ' dari Departemen ' . Auth::user()->departemen . ' untuk ' . Carbon::createFromDate($tglPes)->format('d M Y') . ' - ' . Carbon::createFromDate($tglAPes)->format('d M Y') . ' pukul ' . Carbon::createFromDate($orders->waktu_pesanan)->format('H.i') . ' Membutuhkan Konfirmasi Ulang';
                $users = User::where('id_role', 2)->get();
                $ga = User::where('id_role', 4)->get();
                foreach ($users as $user) {
                    $user->notify(new UserOrder('data', $notif_others, $id));
                }
                User::find(Auth::user()->id)->notify(new UserOrder('riwayat', $notif_user, $id));
                foreach ($ga as $use) {
                    $use->notify(new UserOrder('permintaan', $notif_catering, $id));
                }
            }


            if ($waktu_pesanan->greaterThanOrEqualTo(Carbon::createFromDate('07:00:00')) && $waktu_pesanan->lessThan(Carbon::createFromDate('11:00:00'))) {
                $orders->update([
                    'shift' => "Pagi"
                ]);
            }
            if ($waktu_pesanan->greaterThanOrEqualTo(Carbon::createFromDate('11:00:00')) && $waktu_pesanan->lessThan(Carbon::createFromDate('17:00:00'))) {
                $orders->update([
                    'shift' => "Siang"
                ]);
            }
            if ($waktu_pesanan->greaterThanOrEqualTo(Carbon::createFromDate('17:00:00')) && $waktu_pesanan->lessThan(Carbon::createFromDate('20:00:00'))) {
                $orders->update([
                    'shift' => "Malam"
                ]);
            }

            $orders->update([
                'makanan' => json_encode($request->makanan),
                'jumlah_pesanan' => json_encode($request->jumlah_pesanan),
                'lokasi_pengantaran' => $request->lokasi,
                'detail_karyawan' => implode(',', $request->detail_karyawan),
                'alasan_pemesanan' => $request->alasan_pemesanan,
                'catatan' => $request->catatan
            ]);
        }
        return redirect()->route('riwayatpesanan')->with('success', 'Data Pesanan Telah Diperbaharui');
    }

    public function permintaan_pesanan(Request $request)
    {  //permintaan pesanan
        if ($request->input('pesanan') != null) {
            $req = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->where('orders.id', $request->input('pesanan'))
                ->where('jenis_pesanan', "Others")
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->get();

            $orders = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->whereIn('orders.status', ['Selesai', 'Diproses'])
                ->where('orders.id', $request->input('pesanan'))
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->get();
        } else {
            $req = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->where('jenis_pesanan', "Others")
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->get();

            $orders = Order::join('users', 'orders.id_user', '=', 'users.id')
                ->whereIn('orders.status', ['Selesai', 'Diproses'])
                ->select('orders.id as order_id', 'users.id as user_id', 'users.*', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->get();
        }

        if (Auth::user()->id_role == 1) {
            return redirect()->route('home.dashboard');
        }
        if (Auth::user()->id_role == 2) {
            return redirect()->route('home.dashboard');
        }
        if (Auth::user()->id_role == 3) {
            return view('hrd.permintaanpesanan', [
                'orders' => $orders,
                'req' => $req
            ]);
        }
        if (Auth::user()->id_role == 4) {
            return view('ga.permintaanpesanan', [
                'orders' => $orders,
                'req' => $req
            ]);
        }
    }

    public function setuju(Request $request, $id)
    {
        $orders = Order::find($id);

        $orders->update([
            'status' => "Diproses",
        ]);

        $tanggalPes = json_decode($orders->tanggal_pesanan, true);

        $users = User::where('id', $orders->id_user)->first();
        $notif_user = 'Pesanan ' . $orders->jenis_pesanan . ' untuk ' . Carbon::createFromDate($tanggalPes[0])->format('d M Y') . ' - ' . Carbon::createFromDate($tanggalPes[1])->format('d M Y') . ' pukul ' . Carbon::createFromDate($orders->waktu_pesanan)->format('H.i') . ' Sudah Disetujui ';
        $users->notify(new UserOrder('riwayat', $notif_user, $id));

        $catering = User::where('id_role', 2)->get();
        $notif_catering = 'Pesanan ' . $orders->jenis_pesanan . ' dari Departemen ' . $users->departemen . ' untuk ' . Carbon::createFromDate($tanggalPes[0])->format('d M Y') . ' - ' . Carbon::createFromDate($tanggalPes[1])->format('d M Y') . ' pukul ' . Carbon::createFromDate($orders->waktu_pesanan)->format('H.i');
        foreach ($catering as $cat) {
            $cat->notify(new UserOrder('data', $notif_catering, $id));
        }

        return redirect()->route('permintaanpesanan')->with('success', 'Data Pesanan Telah Disetujui');
    }

    public function tolak(Request $request, $id)
    {
        $orders = Order::find($id);

        $orders->update([
            'alasan' => $request->alasan,
            'status' => "Ditolak"
        ]);

        $tanggalPes = json_decode($orders->tanggal_pesanan, true);

        $users = User::where('id', $orders->id_user)->first();
        $notif_user = 'Pesanan ' . $request->jenis_menu . ' untuk ' . Carbon::createFromDate($tanggalPes[0])->format('d M Y') . ' - ' . Carbon::createFromDate($tanggalPes[1])->format('d M Y') . ' pukul ' . Carbon::createFromDate($orders->waktu_pesanans)->format('H.i') . ' Ditolak ';
        $users->notify(new UserOrder('riwayat', $notif_user, $id));

        return redirect()->route('permintaanpesanan')->with('success', 'Permintaan Pesanan Telah Ditolak');
    }
}
