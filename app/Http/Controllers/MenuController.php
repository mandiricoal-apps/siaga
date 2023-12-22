<?php

namespace App\Http\Controllers;

use App\Exports\DataMakanExport;
use App\Exports\SnackExport;
use App\Exports\PesananExport;
use App\Exports\MenuSpesialExport;
use App\Exports\MenuRegulerExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{


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
            'tanggal' => 'required',
            'shift' => 'required',
        ]);

        $snackExists = Menu::where('id', '<>', $id)
            ->where('tanggal_berlaku', $request->tanggal)
            ->where('shift', $request->shift)
            ->where('jenis_makanan', "Snack")
            ->exists();
        $errorMessages = [];

        // Simpan pembaruan data
        if (!$snackExists) {
            $snack->update([
                'nama_makanan' => json_encode($request->nama_makanan),
                'jenis_makanan' => "Snack",
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
            return redirect()->route('datamenu')->with('success', 'Data Berhasil Diubah.');
        }
    }

    public function ubah_menuspesial($id)
    { //ubah menu spesial
        $menus = Menu::find($id);
        return view('catering.ubahmenuspesial', [
            'menus' => $menus
        ]);
    }

    public function update_menuspesial(Request $request, $id)
    { //proses update menu spesial

        $menus = Menu::find($id);

        // Validasi input sesuai kebutuhan Anda
        $request->validate([
            'nama_makanan' => 'required',
            'tanggal' => 'required',
            'shift' => 'required',
        ]);

        $menusExists = Menu::where('id', '<>', $id)
            ->where('tanggal_berlaku', $request->tanggal)
            ->where('shift', $request->shift)
            ->where('jenis_makanan', "Menu Spesial")
            ->exists();
        $errorMessages = [];

        // Simpan pembaruan data
        if (!$menusExists) {
            $menus->update([
                'nama_makanan' => json_encode($request->nama_makanan),
                'jenis_makanan' => "Menu Spesial",
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
            return redirect()->route('datamenu')->with('success', 'Data Berhasil Diubah.');
        }
    }

    public function ubah_menureguler($id)
    { //ubah menu reguler
        $menur = Menu::find($id);
        return view('catering.ubahmenureguler', [
            'menur' => $menur
        ]);
    }

    public function update_menureguler(Request $request, $id)
    { //proses update menu reguler

        $menur = Menu::find($id);

        // Validasi input sesuai kebutuhan Anda
        $request->validate([
            'nama_makanan' => 'required',
            'tanggal' => 'required',
            'shift' => 'required',
        ]);

        $menurExists = Menu::where('id', '<>', $id)
            ->where('tanggal_berlaku', $request->tanggal)
            ->where('shift', $request->shift)
            ->where('jenis_makanan', "Reguler")
            ->exists();
        $errorMessages = [];

        // Simpan pembaruan data
        if (!$menurExists) {
            $menur->update([
                'nama_makanan' => json_encode($request->nama_makanan),
                'jenis_makanan' => "Reguler",
                'tanggal_berlaku' => $request->tanggal,
                'shift ' => $request->shift,
            ]);
        } else {
            $errorMessages[] = "Menu Reguler untuk tanggal " . $request->tanggal . " pada shift " . $request->shift . " sudah ada.";
        }
        if (!empty($errorMessages)) {
            // Simpan pesan error ke dalam Session
            Session::flash('error', implode('<br>', $errorMessages));
            return back();
        } else {
            return redirect()->route('datamenu')->with('success', 'Data Berhasil Diubah.');
        }
    }

    public function exportSnack(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'minSnack' => 'required|date',
            'maxSnack' => 'required|date|after_or_equal:min', // Pastikan 'max' setelah atau sama dengan 'min'
        ], [
            'minSnack.required' => 'Tanggal Awal harus diisi.',
            'minSnack.date' => 'Format Tanggal Awal tidak valid.',
            'maxSnack.required' => 'Tanggal Akhir harus diisi.',
            'maxSnack.date' => 'Format Tanggal Akhir tidak valid.',
            'maxSnack.after_or_equal' => 'Tanggal Akhir harus setelah atau sama dengan Tanggal Awal.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $min = $request->input('minSnack');
        $max = $request->input('maxSnack');

        $tglMin = Carbon::createFromDate($min)->format('d M Y');
        $tglMax = Carbon::createFromDate($max)->format('d M Y');

        return Excel::download(new SnackExport($min,$max), "Laporan Data Snack ".$tglMin." - ".$tglMax. ".xlsx");
    }

    public function exportMenus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'minMenus' => 'required|date',
            'maxMenus' => 'required|date|after_or_equal:min', // Pastikan 'max' setelah atau sama dengan 'min'
        ], [
            'minMenus.required' => 'Tanggal Awal harus diisi.',
            'minMenus.date' => 'Format Tanggal Awal tidak valid.',
            'maxMenus.required' => 'Tanggal Akhir harus diisi.',
            'maxMenus.date' => 'Format Tanggal Akhir tidak valid.',
            'maxMenus.after_or_equal' => 'Tanggal Akhir harus setelah atau sama dengan Tanggal Awal.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $min = $request->input('minMenus');
        $max = $request->input('maxMenus');

        $tglMin = Carbon::createFromDate($min)->format('d M Y');
        $tglMax = Carbon::createFromDate($max)->format('d M Y');

        return Excel::download(new MenuSpesialExport($min,$max), "Laporan Data Menu Spesial ".$tglMin." - ".$tglMax. ".xlsx");
    }

    public function exportMenur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'minMenur' => 'required|date',
            'maxMenur' => 'required|date|after_or_equal:min', // Pastikan 'max' setelah atau sama dengan 'min'
        ], [
            'minMenur.required' => 'Tanggal Awal harus diisi.',
            'minMenur.date' => 'Format Tanggal Awal tidak valid.',
            'maxMenur.required' => 'Tanggal Akhir harus diisi.',
            'maxMenur.date' => 'Format Tanggal Akhir tidak valid.',
            'maxMenur.after_or_equal' => 'Tanggal Akhir harus setelah atau sama dengan Tanggal Awal.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $min = $request->input('minMenur');
        $max = $request->input('maxMenur');

        $tglMin = Carbon::createFromDate($min)->format('d M Y');
        $tglMax = Carbon::createFromDate($max)->format('d M Y');

        return Excel::download(new MenuRegulerExport($min,$max), "Laporan Data Menu Reguler ".$tglMin." - ".$tglMax. ".xlsx");
    }

    public function exportDatamakan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'min' => 'required|date',
            'max' => 'required|date|after_or_equal:min', // Pastikan 'max' setelah atau sama dengan 'min'
        ], [
            'min.required' => 'Tanggal Awal harus diisi.',
            'min.date' => 'Format Tanggal Awal tidak valid.',
            'max.required' => 'Tanggal Akhir harus diisi.',
            'max.date' => 'Format Tanggal Akhir tidak valid.',
            'max.after_or_equal' => 'Tanggal Akhir harus setelah atau sama dengan Tanggal Awal.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $min = $request->input('min');
        $max = Carbon::createFromDate($request->input('max'))->modify('+1 day');


        $tglMin = Carbon::createFromDate($min)->format('d M Y');
        $tglMax = Carbon::createFromDate($request->input('max'))->format('d M Y');


        return Excel::download(new DataMakanExport($min, $max), "Laporan Data Makan ".$tglMin." - ".$tglMax. ".xlsx");
    }

    public function exportPesanan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'min' => 'required|date',
            'max' => 'required|date|after_or_equal:min', // Pastikan 'max' setelah atau sama dengan 'min'
        ], [
            'min.required' => 'Tanggal Awal harus diisi.',
            'min.date' => 'Format Tanggal Awal tidak valid.',
            'max.required' => 'Tanggal Akhir harus diisi.',
            'max.date' => 'Format Tanggal Akhir tidak valid.',
            'max.after_or_equal' => 'Tanggal Akhir harus setelah atau sama dengan Tanggal Awal.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $min = $request->input('min');
        $max = Carbon::createFromDate($request->input('max'))->modify('+1 day');

        $tglMin = Carbon::createFromDate($min)->format('d M Y');
        $tglMax = Carbon::createFromDate($request->input('max'))->format('d M Y');
        return Excel::download(new PesananExport($min, $max), "Laporan Data Pesanan ".$tglMin." - ".$tglMax. ".xlsx");
    }


    //Perbaikan
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
        $regulers = Menu::where('jenis_makanan', 'Reguler')->orderByRaw('
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

        $filteredRegulers = $regulers->filter(function ($regulers) use ($startDate, $endDate) {
            $menuDate = Carbon::parse($regulers->tanggal_berlaku);
            return $menuDate->between($startDate, $endDate);
        });

        $countSnack = $filteredSnacks->count();
        $countMenus = $filteredMenus->count();
        $countRegulers = $filteredRegulers->count();

        // Kelompokkan data snack berdasarkan shift menggunakan koleksi Laravel
        $groupedSnacks = $filteredSnacks->groupBy('shift');
        $groupedMenus = $filteredMenus->groupBy('shift');
        $groupedRegulers = $filteredRegulers->groupBy('shift');

        return view('catering.tambahmenu', [
            'snacks' => $snacks,
            'countSnack' => $countSnack,
            'countMenus' => $countMenus,
            'countRegulers' => $countRegulers,
            'groupedSnacks' => $groupedSnacks,
            'groupedMenus' => $groupedMenus,
            'groupedRegulers' => $groupedRegulers
        ]);
    }

    public function add_menu(Request $request) // tambah menu
    {
        $makanan = json_encode($request->nama_makanan);
        $validatedData = $request->validate([
            'tanggal.*' => 'date',
            'shift.*' => 'in:0,Pagi,Siang,Malam',
            'jenis_makanan' => 'in: 0, 1, 2, 3'
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
                        $menuDetail->nama_makanan = $makanan;
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
                        $menuDetail->nama_makanan = $makanan;
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
                } else if ($validatedData['jenis_makanan'] == 3) {
                    $menuExists = Menu::where('tanggal_berlaku', $validatedData['tanggal'][$i])
                        ->where('shift', $validatedData['shift'][$i])
                        ->where('jenis_makanan', 'Reguler')
                        ->exists();

                    if (!$menuExists) {
                        // Simpan data menu berdasarkan tanggal dan shift
                        $menuDetail = new Menu;
                        $menuDetail->nama_makanan = $makanan;
                        $menuDetail->jenis_makanan = "Reguler"; // Sesuaikan dengan jenis makanan yang sesuai
                        $menuDetail->tanggal_berlaku = $validatedData['tanggal'][$i];
                        $menuDetail->shift = $validatedData['shift'][$i];
                        $menuDetail->save();
                    } else {
                        $tanggalInput = Carbon::parse($validatedData['tanggal'][$i])
                            ->isoFormat('DD MMMM YYYY');
                        // Tambahkan pesan error ke dalam array pesan error
                        $errorMessages[] = "Menu Reguler untuk tanggal " . $tanggalInput . " pada shift " . $validatedData['shift'][$i] . " sudah ada.";
                    }
                } else if ($validatedData['jenis_makanan'] == '0') {
                    $errorMessages[] = "Anda belum memilih Jenis Menu!";
                }
            }
        }

        // Cek apakah ada pesan error yang perlu ditampilkan
        if (!empty($errorMessages)) {
            // Simpan pesan error ke dalam Session
            Session::flash('error', implode('\n', $errorMessages));
        } else {
            // Jika berhasil, tampilkan pesan sukses
            Session::flash('success', 'Menu berhasil disimpan.');
        }

        return redirect('/tambah-menu');
    }

    public function kelola_menu()
    { //kelola menu spesial
        $tgl_berlaku = now()->format('Y-m-d');
        $menus = Menu::select('id', 'nama_makanan', 'tanggal_berlaku', 'shift', 'jenis_makanan')->where('jenis_makanan', 'Menu Spesial')->get();
        $menur = Menu::select('id', 'nama_makanan', 'tanggal_berlaku', 'shift', 'jenis_makanan')->where('jenis_makanan', 'Reguler')->get();
        $snack = Menu::where('jenis_makanan', 'Snack')->get();

        if (Auth::user()->id_role == 1) {
            return view('departemen.datamenu', [
                'menus' => $menus,
                'menur' => $menur,
                'snack' => $snack,
                'tgl_berlaku' => $tgl_berlaku
            ]);
        }
        if (Auth::user()->id_role == 2) {
            return view('catering.datamenu', [
                'menus' => $menus,
                'menur' => $menur,
                'snack' => $snack,
                'tgl_berlaku' => $tgl_berlaku
            ]);
        }
        if (Auth::user()->id_role == 3) {
            return view('hrd.datamenu', [
                'menus' => $menus,
                'menur' => $menur,
                'snack' => $snack,
                'tgl_berlaku' => $tgl_berlaku
            ]);
        }
        if (Auth::user()->id_role == 4) {
            return view('ga.datamenu', [
                'menus' => $menus,
                'menur' => $menur,
                'snack' => $snack,
                'tgl_berlaku' => $tgl_berlaku
            ]);
        }


    }

    public function jadwal_menu()
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

        $menur = Menu::where('jenis_makanan', 'Reguler')->orderByRaw('
        CASE
            WHEN shift = "pagi" THEN 1
            WHEN shift = "siang" THEN 2
            WHEN shift = "malam" THEN 3
            ELSE 4
        END')->get();
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $filteredMenur = $menur->filter(function ($menur) use ($startDate, $endDate) {
            $menuDate = Carbon::parse($menur->tanggal_berlaku);
            return $menuDate->between($startDate, $endDate);
        });
        $countMenur = $filteredMenur->count();


        $groupedMenur = $filteredMenur->groupBy('shift');

        if (Auth::user()->id_role == 1) {
            return view('departemen.jadwalmenu', [
                'countMenus' => $countMenus,
                'groupedMenus' => $groupedMenus,
                'snacks' => $snacks,
                'countSnack' => $countSnack,
                'groupedSnacks' => $groupedSnacks,
                'countMenur' => $countMenur,
                'groupedMenur' => $groupedMenur
            ]);
        }
        if (Auth::user()->id_role == 2) {
            return redirect('/dashboard');
        }
        if (Auth::user()->id_role == 3) {
            return view('hrd.jadwalmenu', [
                'countMenus' => $countMenus,
                'groupedMenus' => $groupedMenus,
                'snacks' => $snacks,
                'countSnack' => $countSnack,
                'groupedSnacks' => $groupedSnacks,
                'countMenur' => $countMenur,
                'groupedMenur' => $groupedMenur
            ]);
        }
        if (Auth::user()->id_role == 4) {
            return view('ga.jadwalmenu', [
                'countMenus' => $countMenus,
                'groupedMenus' => $groupedMenus,
                'snacks' => $snacks,
                'countSnack' => $countSnack,
                'groupedSnacks' => $groupedSnacks,
                'countMenur' => $countMenur,
                'groupedMenur' => $groupedMenur
            ]);
        }


    }
}
