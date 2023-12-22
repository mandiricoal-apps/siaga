<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;

class SnackOrderExport implements FromView, WithTitle
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
        return view('export.snackorder', [
            'orders' => Order::join('users', 'orders.id_user', '=', 'users.id')
                ->where('orders.status', 'Selesai')
                ->where('orders.jenis_pesanan', 'Snack')
                ->whereBetween('orders.created_at', [$this->awal, $this->akhir])
                ->select('orders.id as order_id', 'users.id as user_id', 'users.name', 'users.departemen', 'orders.*')
                ->orderBy('orders.id', 'desc')
                ->get()
        ]);
    }
}
