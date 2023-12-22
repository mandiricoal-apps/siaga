<table>
    <thead>
        <tr>
            <th>Jenis Menu</th>
            <th>Menu Spesial 1,5 Main Course</th>
            <th>Menu Spesial 2,5 Main Course</th>
            <th>Jumlah Porsi 1,5 Main Course</th>
            <th>Jumlah Porsi 2,5 Main Course</th>
            <th>Nama Pemesan</th>
            <th>Departemen</th>
            <th>Tanggal Pemesanan</th>
            <th>Tanggal Pesanan</th>
            <th>Waktu Pengiriman</th>
            <th>Alasan Pemesanan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->jenis_pesanan }}</td>
                @php
                    $detail_menu = json_decode($order->makanan, true);
                    $detail_porsi = json_decode($order->jumlah_pesanan, true);
                    $tglPes = json_decode($order->tanggal_pesanan, true);
                    $waktuPes = \Carbon\Carbon::parse($order->waktu_pesanan)->format("H:i");
                @endphp
                <td>{{ $detail_menu[0] }}</td>
                <td>{{ $detail_menu[1] }}</td>
                <td>{{ $detail_porsi[0] }}</td>
                <td>{{ $detail_porsi[1] }}</td>
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
