<table>
    <thead>
        <tr>
            <!-- <th scope="col">Pilihan</th> -->
            <th>No</th>
            <th>Nama Makanan</th>
            <th>Tanggal Berlaku</th>
            <th>Shift</th>
            <th>Jenis Makanan</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($snack as $index => $data)
            @php
                $makanan = json_decode($data->nama_makanan, true);
                $nama_makanan = implode(', ', $makanan);

                $tgl = \Carbon\Carbon::createFromDate($data->tanggal_berlaku)->format('d-m-Y');
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $nama_makanan }}</td>
                <td>{{ $tgl }}
                <td>{{ $data->shift }}</td>
                <td>{{ $data->jenis_makanan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
