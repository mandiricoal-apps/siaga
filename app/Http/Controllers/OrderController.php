<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function depart_pesan_menu()
    { //pesan menu
        return view('departemen.pesanmenu');
    }

    public function depart_riwayat_pesanan()
    {  //riwayat pesanan
        $karyawan = json_decode(file_get_contents(public_path('data/karyawan.json')), true);
        return view('departemen.riwayatpesanan', [
            'karyawan' => $karyawan,
        ]);
    }

    public function depart_ubah_pesanan()
    {  //riwayat pesanan
        return view('departemen.ubahpesanan');
    }

    public function ga_pesan_menu()
    { //pesan menu
        return view('ga.pesanmenu');
    }

    public function ga_riwayat_pesanan()
    {  //riwayat pesanan
        return view('ga.riwayatpesanan');
    }

    public function ga_ubah_pesanan()
    {  //riwayat pesanan
        return view('ga.ubahpesanan');
    }

    public function ga_permintaan_pesanan()
    {  //permintaan pesanan
        return view('ga.permintaanpesanan');
    }

    public function data_pesanan()
    {  //data pesanan catering
        return view('catering.datapesanan');
    }

    public function getMenu(Request $request)
    { //mengambil data menu yang tersedia
        $jenisMenu = $request->input('jenisMenu');
        $tanggalPesanan = $request->input('tanggalPesanan');
        $waktuPesanan = $request->input('waktuPesanan');

        // Query database untuk mendapatkan menu berdasarkan jenis dan tanggal
        if (Carbon::parse($waktuPesanan)->greaterThanOrEqualTo(Carbon::parse('07:00:00')) && Carbon::parse($waktuPesanan)->lessThan(Carbon::parse('12:00:00'))) {
            $menu = Menu::where('jenis_makanan', $jenisMenu)
                ->whereDate('tanggal_berlaku', $tanggalPesanan)
                ->where('shift', 'Pagi')
                ->get();
        }
        if (Carbon::parse($waktuPesanan)->greaterThanOrEqualTo(Carbon::parse('12:00:00')) && Carbon::parse($waktuPesanan)->lessThan(Carbon::parse('15:00:00'))) {
            $menu = Menu::where('jenis_makanan', $jenisMenu)
                ->whereDate('tanggal_berlaku', $tanggalPesanan)
                ->where('shift', 'Siang')
                ->get();
        }
        if (Carbon::parse($waktuPesanan)->greaterThanOrEqualTo(Carbon::parse('15:00:00')) && Carbon::parse($waktuPesanan)->lessThan(Carbon::parse('18:00:00'))) {
            $menu = Menu::where('jenis_makanan', $jenisMenu)
                ->whereDate('tanggal_berlaku', $tanggalPesanan)
                ->where('shift', 'Malam')
                ->get();
        }


        // Kembalikan data menu dalam bentuk HTML
        $menuHtml = '<ul>';
        foreach ($menu as $item) {
            $menuHtml .= "<b>Menu yang tersedia:</b> </br><div class='mt-1'>- " . $item->nama_makanan . "</div>";
        }
        $menuHtml .= '</ul>';

        return $menuHtml;
    }

    public function pesanan(Request $request)
    {  //memesan makanan
        $now = Carbon::now()->format("Y-m-d");
        $sekarang = Carbon::createFromDate($now);
        $tgl_pesanan = Carbon::createFromDate($request->tanggal_pesanan)->format("Y-m-d");
        $waktu_pesanan = Carbon::createFromDate($now)->format("h:i:s A");
        dd($waktu_pesanan);

        $errorMessages = [];
        if ($sekarang->lte($tgl_pesanan)) {
            $errorMessages[] = "Kamu tidak dapat lagi memesan menu pada " . $now;
        }

        $order = new Order();
        $order->jenis_pesanan = $request->jenis_menu;
        $order->tanggal_pesanan = $request->tanggal_pesanan;
        $order->jumlah_pesanan = $request->jumlah_pesanan;
        $order->detail_karyawan = $request->detail_karyawan;
        $order->catatan = $request->catatan;
        $order->lokasi_pengantaran = $request->lokasi;
        $order->id_menu = 1;
        $order->id_user = Auth::user()->id;
        $order->save();


        if (!empty($errorMessages)) {
            // Simpan pesan error ke dalam Session
            Session::flash('error', implode('<br>', $errorMessages));
            return back();
        } else {
            return redirect()->route('departemen.riwayatpesanan');
        }
    }
}
