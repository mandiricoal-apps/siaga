<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function tambah_menu(){  //tambah menu
        return view('catering.tambahmenu');
    }

    public function kelola_snack(){ //kelola snack
        return view('catering.kelolasnack');
    }

    public function kelola_menuspesial(){ //kelola menu spesial
        return view('catering.kelolamenuspesial');
    }

    public function ubah_snack(){ //ubah snack
        return view('catering.ubahsnack');
    }

    public function ubah_menuspesial(){ //ubah menu spesial
        return view('catering.ubahmenuspesial');
    }

    public function depart_snack(){ //data snack departemen
        return view('departemen.datasnack');
    }

    public function depart_menuspesial(){ //data menu spesial departemen
        return view('departemen.datamenuspesial');
    }

    public function ga_snack(){ //data snack ga
        return view('ga.datasnack');
    }

    public function ga_menuspesial(){ //data menu spesial ga
        return view('ga.datamenuspesial');
    }

}
