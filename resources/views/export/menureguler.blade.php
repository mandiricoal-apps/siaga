<table>
    <thead>
        <tr>
            <!-- <th scope="col">Pilihan</th> -->
            <th rowspan="2">No</th>
            <th rowspan="2">Nama Makanan</th>
            <th colspan="2">Tanggal<th>
            <th rowspan="2">Shift</th>
            <th rowspan="2">Jenis Makanan</th>
        </tr>
        <tr>
            <th>Tanggal masuk</th>
            <th>tanggal Keluar</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($menur as $index => $data)
            @php
                $makanan = json_decode($data->nama_makanan, true);
                $nama_makanan = implode(', ', $makanan);

                $tgl = \Carbon\Carbon::createFromDate($data->tanggal_berlaku)->format('d-m-Y');
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $nama_makanan }}</td>
                <td>{{ $tgl }}<td>
                <td>{{ $tgl }}<td>
                <td>{{ $data->shift }}</td>
                <td>{{ $data->jenis_makanan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
