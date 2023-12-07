<table>
    <thead>
    <tr>
        <th>Nama Lengkap</th>
        <th>Jenis Kelamin</th>
        <th>Agama</th>
        <th>Alamat</th>
        <th>Total Nilai</th>
        <th>Mata Pelajaran</th>
        <th>Rata Nilai</th>
    </tr>
    </thead>
    <tbody>
    @foreach($siswa as $invoice)
        <tr>
            <td>{{ $invoice->namaLengkap () }}</td>
            <td>{{ $invoice->jenis_kelamin }}</td>
            <td>{{ $invoice->agama }}</td>
            <td>{{ $invoice->alamat }}</td>
            <td>{{ $invoice->totalNilai() }}</td>
            <td>{{ $invoice->mapel->count() }}</td>
            <td>{{ $invoice->rataNilai() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>