<table>
    <thead>
        <tr>
            <!-- <th scope="col">Pilihan</th> -->
            <th>No</th>
            <th>Menu Spesial 1,5 Main Course</th>
            <th>Menu Spesial 2,5 Main Course</th>
            <th>Tanggal Berlaku</th>
            <th>Shift</th>
            <th>Jenis Makanan</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($menus as $index => $data)
            @php
                $makanan = json_decode($data->nama_makanan, true);

                $tgl = \Carbon\Carbon::createFromDate($data->tanggal_berlaku)->format('d-m-Y');
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $makanan[0] }}</td>
                <td>{{ $makanan[1] }}</td>
                <td>{{ $tgl }}
                <td>{{ $data->shift }}</td>
                <td>{{ $data->jenis_makanan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
