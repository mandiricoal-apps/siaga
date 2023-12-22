<table>
    <thead>
        <tr>
            <th>Jenis Menu</th>
            <th>Menu Makanan</th>
            <th>Jumlah Porsi</th>
            <th>Nama Pemesan</th>
            <th>Departemen</th>
            <th>Tanggal Pemesanan</th>
            <th>Tanggal Pesanan</th>
            <th>Alasan Pemesanan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->jenis_pesanan }}</td>
                @php
                    $detail_menu = json_decode($order->makanan, true);
                    $menu = implode(', ', $detail_menu);
                    $detail_porsi = json_decode($order->jumlah_pesanan, true);
                    $total_porsi = array_sum($detail_porsi);
                    $tglPes = json_decode($order->tanggal_pesanan, true);
                    $waktuPes = \Carbon\Carbon::parse($order->waktu_pesanan)->format("H:i");
                @endphp
                <td>{{ $menu }}</td>
                <td>{{ $total_porsi }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->departemen }}</td>
                <td>{{ $order->created_at}}</td>
                <td>{{ $tglPes[0] }} - {{ $tglPes[1] }}</td>
                <td>{{ $waktuPes }}</td>
                <td>{{ $order->alasan_pemesanan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
