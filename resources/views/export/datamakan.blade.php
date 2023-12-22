<table>
    <thead>
        <tr>
            <!-- <th scope="col">Pilihan</th> -->
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Shift</th>
            <th>Tanggal dan Waktu</th>
            <th>Kategori Makan</th>
            <th>Lokasi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;

        @endphp
        @foreach ($datamakan as $index => $data)
        @php
            $tgl = \Carbon\Carbon::createFromDate($data->tanggalwaktu)->format('d-m-Y H:i:s');
        @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nik }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->shift }}</td>
                <td>{{ $tgl }}</td>
                <td>{{ $data->kategori }}</td>
                <td>{{ $data->lokasi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
