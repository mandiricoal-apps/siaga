<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function depart_pesan_menu(){ //pesan menu
        return view('departemen.pesanmenu');
    }

    public function depart_riwayat_pesanan(){  //riwayat pesanan
        return view('departemen.riwayatpesanan');
    }

    public function depart_ubah_pesanan(){  //riwayat pesanan
        return view('departemen.ubahpesanan');
    }

    public function ga_pesan_menu(){ //pesan menu
        return view('ga.pesanmenu');
    }

    public function ga_riwayat_pesanan(){  //riwayat pesanan
        return view('ga.riwayatpesanan');
    }

    public function ga_ubah_pesanan(){  //riwayat pesanan
        return view('ga.ubahpesanan');
    }

    public function ga_permintaan_pesanan(){  //permintaan pesanan
        return view('ga.permintaanpesanan');
    }

    public function data_pesanan(){  //data pesanan catering
        return view('catering.datapesanan');
    }
}
