<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function tambah_menu()
    {  //tambah menu

        // Ambil data snack dari database
        $snacks = Menu::where('jenis_makanan', 'Snack')->orderByRaw('
        CASE
            WHEN shift = "pagi" THEN 1
            WHEN shift = "siang" THEN 2
            WHEN shift = "malam" THEN 3
            ELSE 4
        END')->get();
        $menus = Menu::where('jenis_makanan', 'Menu Spesial')->orderByRaw('
        CASE
            WHEN shift = "pagi" THEN 1
            WHEN shift = "siang" THEN 2
            WHEN shift = "malam" THEN 3
            ELSE 4
        END')->get();
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        // Melakukan filter data snack berdasarkan tanggal_berlaku
        $filteredSnacks = $snacks->filter(function ($snack) use ($startDate, $endDate) {
            $snackDate = Carbon::parse($snack->tanggal_berlaku);
            return $snackDate->between($startDate, $endDate);
        });



        $filteredMenus = $menus->filter(function ($menus) use ($startDate, $endDate) {
            $menuDate = Carbon::parse($menus->tanggal_berlaku);
            return $menuDate->between($startDate, $endDate);
        });

        $countSnack = $filteredSnacks->count();
        $countMenus = $filteredMenus->count();

        // Kelompokkan data snack berdasarkan shift menggunakan koleksi Laravel
        $groupedSnacks = $filteredSnacks->groupBy('shift');
        $groupedMenus = $filteredMenus->groupBy('shift');

        return view('catering.tambahmenu', [
            'snacks' => $snacks,
            'countSnack' => $countSnack,
            'countMenus' => $countMenus,
            'groupedSnacks' => $groupedSnacks,
            'groupedMenus' => $groupedMenus
        ]);
    }

    public function kelola_snack()
    { //kelola snack
        $tgl_berlaku = now()->format('Y-m-d');
        $snack = Menu::where('jenis_makanan', 'Snack')->get();

        return view('catering.kelolasnack', [
            'snack' => $snack,
            'tgl_berlaku' => $tgl_berlaku
        ]);
    }

    public function kelola_menuspesial()
    { //kelola menu spesial
        $tgl_berlaku = now()->format('Y-m-d');
        $menus = Menu::select('id', 'nama_makanan', 'tanggal_berlaku', 'shift', 'jenis_makanan','deskripsi')->where('jenis_makanan', 'Menu Spesial')->get();

        return view('catering.kelolamenuspesial', [
            'menus' => $menus,
            'tgl_berlaku' => $tgl_berlaku
        ]);
    }

    public function ubah_snack($id)
    { //ubah snack
        $snacks = Menu::find($id);
        return view('catering.ubahsnack', [
            'snacks' => $snacks,
        ]);
    }

    public function update_snack(Request $request, $id)
    { //proses update snack

        $snack = Menu::find($id);

        // Validasi input sesuai kebutuhan Anda
        $request->validate([
            'nama_makanan' => 'required',
            'jenis_makanan' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'shift' => 'required',
        ]);
        if ($request->jenis_makanan == 1) {
            $data = "Menu Spesial";
        }
        if ($request->jenis_makanan == 2) {
            $data = "Snack";
        }

        $snackExists = Menu::where('id', '<>', $id)
            ->where('tanggal_berlaku', $request->tanggal)
            ->where('shift', $request->shift)
            ->where('jenis_makanan', $data)
            ->exists();
        $errorMessages = [];

        // Simpan pembaruan data
        if (!$snackExists) {
            $snack->update([
                'nama_makanan' => $request->nama_makanan,
                'jenis_makanan' => $data,
                'deskripsi' => $request->deskripsi,
                'tanggal_berlaku' => $request->tanggal,
                'shift ' => $request->shift,
            ]);
        } else {
            $errorMessages[] = "Snack untuk tanggal " . $request->tanggal . " pada shift " . $request->shift . " sudah ada.";
        }
        if (!empty($errorMessages)) {
            // Simpan pesan error ke dalam Session
            Session::flash('error', implode('<br>', $errorMessages));
            return back();
        } else {
            return redirect()->route('catering.kelolasnack')->with('success', 'Data Berhasil Diubah.');
        }
    }

    public function ubah_menuspesial($id)
    { //ubah menu spesial
        $menus = Menu::find($id);
        return view('catering.ubahmenuspesial',[
            'menus'=>$menus
        ]);
    }

    public function update_menuspesial(Request $request, $id)
    { //proses update snack

        $menus = Menu::find($id);

        // Validasi input sesuai kebutuhan Anda
        $request->validate([
            'nama_makanan' => 'required',
            'jenis_makanan' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'shift' => 'required',
        ]);
        if ($request->jenis_makanan == 1) {
            $data = "Menu Spesial";
        }
        if ($request->jenis_makanan == 2) {
            $data = "Snack";
        }

        $snackExists = Menu::where('id', '<>', $id)
            ->where('tanggal_berlaku', $request->tanggal)
            ->where('shift', $request->shift)
            ->where('jenis_makanan', $data)
            ->exists();
        $errorMessages = [];

        // Simpan pembaruan data
        if (!$snackExists) {
            $menus->update([
                'nama_makanan' => $request->nama_makanan,
                'jenis_makanan' => $data,
                'deskripsi' => $request->deskripsi,
                'tanggal_berlaku' => $request->tanggal,
                'shift ' => $request->shift,
            ]);
        } else {
            $errorMessages[] = "Menu Spesial untuk tanggal " . $request->tanggal . " pada shift " . $request->shift . " sudah ada.";
        }
        if (!empty($errorMessages)) {
            // Simpan pesan error ke dalam Session
            Session::flash('error', implode('<br>', $errorMessages));
            return back();
        } else {
            return redirect()->route('catering.kelolamenuspesial')->with('success', 'Data Berhasil Diubah.');
        }
    }

    public function depart_snack()
    { //data snack departemen
        $snacks = Menu::where('jenis_makanan', 'Snack')->orderByRaw('
        CASE
            WHEN shift = "pagi" THEN 1
            WHEN shift = "siang" THEN 2
            WHEN shift = "malam" THEN 3
            ELSE 4
        END')->get();

        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        // Melakukan filter data snack berdasarkan tanggal_berlaku
        $filteredSnacks = $snacks->filter(function ($snack) use ($startDate, $endDate) {
            $snackDate = Carbon::parse($snack->tanggal_berlaku);
            return $snackDate->between($startDate, $endDate);
        });

        $countSnack = $filteredSnacks->count();

        // Kelompokkan data snack berdasarkan shift menggunakan koleksi Laravel
        $groupedSnacks = $filteredSnacks->groupBy('shift');

        return view('departemen.datasnack', [
            'snacks' => $snacks,
            'countSnack' => $countSnack,
            'groupedSnacks' => $groupedSnacks,
        ]);
    }

    public function depart_menuspesial()
    { //data menu spesial departemen
        $menus = Menu::where('jenis_makanan', 'Menu Spesial')->orderByRaw('
        CASE
            WHEN shift = "pagi" THEN 1
            WHEN shift = "siang" THEN 2
            WHEN shift = "malam" THEN 3
            ELSE 4
        END')->get();
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $filteredMenus = $menus->filter(function ($menus) use ($startDate, $endDate) {
            $menuDate = Carbon::parse($menus->tanggal_berlaku);
            return $menuDate->between($startDate, $endDate);
        });
        $countMenus = $filteredMenus->count();


        $groupedMenus = $filteredMenus->groupBy('shift');
        return view('departemen.datamenuspesial', [
            'countMenus' => $countMenus,
            'groupedMenus' => $groupedMenus
        ]);
    }

    public function ga_snack()
    { //data snack ga
        $snacks = Menu::where('jenis_makanan', 'Snack')->orderByRaw('
        CASE
            WHEN shift = "pagi" THEN 1
            WHEN shift = "siang" THEN 2
            WHEN shift = "malam" THEN 3
            ELSE 4
        END')->get();

        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        // Melakukan filter data snack berdasarkan tanggal_berlaku
        $filteredSnacks = $snacks->filter(function ($snack) use ($startDate, $endDate) {
            $snackDate = Carbon::parse($snack->tanggal_berlaku);
            return $snackDate->between($startDate, $endDate);
        });

        $countSnack = $filteredSnacks->count();

        // Kelompokkan data snack berdasarkan shift menggunakan koleksi Laravel
        $groupedSnacks = $filteredSnacks->groupBy('shift');
        return view('ga.datasnack', [
            'snacks' => $snacks,
            'countSnack' => $countSnack,
            'groupedSnacks' => $groupedSnacks,
        ]);
    }

    public function ga_menuspesial()
    { //data menu spesial ga
        $menus = Menu::where('jenis_makanan', 'Menu Spesial')->orderByRaw('
        CASE
            WHEN shift = "pagi" THEN 1
            WHEN shift = "siang" THEN 2
            WHEN shift = "malam" THEN 3
            ELSE 4
        END')->get();
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $filteredMenus = $menus->filter(function ($menus) use ($startDate, $endDate) {
            $menuDate = Carbon::parse($menus->tanggal_berlaku);
            return $menuDate->between($startDate, $endDate);
        });
        $countMenus = $filteredMenus->count();


        $groupedMenus = $filteredMenus->groupBy('shift');
        return view('ga.datamenuspesial', [
            'countMenus' => $countMenus,
            'groupedMenus' => $groupedMenus
        ]);
    }

    public function add_menu(Request $request) // tambah menu
    {
        $validatedData = $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal.*' => 'date',
            'shift.*' => 'in:0,Pagi,Siang,Malam',
            'jenis_makanan' => 'in: 0, 1, 2'
        ]);

        // Variable untuk menyimpan pesan error
        $errorMessages = [];


        for ($i = 0; $i < count($validatedData['tanggal']); $i++) {
            if (!empty($validatedData['tanggal'][$i]) && $validatedData['shift'][$i] != 0) {
                if ($validatedData['jenis_makanan'] == 1) {
                    $menuExists = Menu::where('tanggal_berlaku', $validatedData['tanggal'][$i])
                        ->where('shift', $validatedData['shift'][$i])
                        ->where('jenis_makanan', 'Menu Spesial')
                        ->exists();

                    if (!$menuExists) {
                        // Simpan data menu berdasarkan tanggal dan shift
                        $menuDetail = new Menu;
                        $menuDetail->nama_makanan = $validatedData['nama_makanan'];
                        $menuDetail->deskripsi = $validatedData['deskripsi'];
                        $menuDetail->jenis_makanan = "Menu Spesial";
                        $menuDetail->tanggal_berlaku = $validatedData['tanggal'][$i];
                        $menuDetail->shift = $validatedData['shift'][$i];
                        $menuDetail->save();
                    } else {
                        $tanggalInput = Carbon::parse($validatedData['tanggal'][$i])
                            ->isoFormat('DD MMMM YYYY');
                        // Tambahkan pesan error ke dalam array pesan error
                        $errorMessages[] = "Menu Spesial untuk tanggal " . $tanggalInput . " pada shift " . $validatedData['shift'][$i] . " sudah ada.";
                    }
                } else if ($validatedData['jenis_makanan'] == 2) {
                    $menuExists = Menu::where('tanggal_berlaku', $validatedData['tanggal'][$i])
                        ->where('shift', $validatedData['shift'][$i])
                        ->where('jenis_makanan', 'Snack')
                        ->exists();

                    if (!$menuExists) {
                        // Simpan data menu berdasarkan tanggal dan shift
                        $menuDetail = new Menu;
                        $menuDetail->nama_makanan = $validatedData['nama_makanan'];
                        $menuDetail->deskripsi = $validatedData['deskripsi'];
                        $menuDetail->jenis_makanan = "Snack"; // Sesuaikan dengan jenis makanan yang sesuai
                        $menuDetail->tanggal_berlaku = $validatedData['tanggal'][$i];
                        $menuDetail->shift = $validatedData['shift'][$i];
                        $menuDetail->save();
                    } else {
                        $tanggalInput = Carbon::parse($validatedData['tanggal'][$i])
                            ->isoFormat('DD MMMM YYYY');
                        // Tambahkan pesan error ke dalam array pesan error
                        $errorMessages[] = "Snack untuk tanggal " . $tanggalInput . " pada shift " . $validatedData['shift'][$i] . " sudah ada.";
                    }
                } else if ($validatedData['jenis_makanan'] == '0') {
                    $errorMessages[] = "Anda belum memilih Jenis Menu!";
                }
            }
        }

        // Cek apakah ada pesan error yang perlu ditampilkan
        if (!empty($errorMessages)) {
            // Simpan pesan error ke dalam Session
            Session::flash('error', implode('<br>', $errorMessages));
        } else {
            // Jika berhasil, tampilkan pesan sukses
            Session::flash('success', 'Menu berhasil disimpan.');
        }

        return redirect('/catering/tambah-menu');
    }
}
