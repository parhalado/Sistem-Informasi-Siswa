<table class="table" style="border:1px solid #ddd">
    <thead style=" font-size: 16px; color:blue;" >
        <tr>
            <th>NAMA LENGKAP</th>
            <th>JENIS KELAMIN</th>
            <th>AGAMA</th>
            <th>ALAMAT</th>
            <th>TOTAL NILAI</th>
            <th>JUMLAH PELAJARAN</th>
            <th>RATA NILAI</th>
        </tr>
    </thead>
    <tbody style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
        @foreach ($siswa as $s)
        <tr>
           <td>{{ $s->namaLengkap() }}</td>
           <td>{{ $s->jenis_kelamin }}</td>
           <td>{{ $s->agama }}</td>
           <td>{{ $s->alamat }}</td>
           <td>{{ $s->totalNilai() }}</td>
           <td>{{ $s->mapel->count() }}</td>
           <td>{{ $s->rataNilai() }}</td>
        </tr>
        @endforeach
        
    </tbody>
</table>