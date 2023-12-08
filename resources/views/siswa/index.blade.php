@extends('layouts.master')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                {{-- FLASH MESSAGE --}}
                                @if (session('sukses'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('sukses') }}
                                    </div>
                                @endif

                                <h3 class="panel-title">Tabel Data Siswa</h3>
                                <div class="right">
                                    <a href="/siswa/export" class="fa fa-download ">Download Excel</a>
                                    <a href="/siswa/exportpdf" class="fa fa-download ">Download PDF</a>
                                    <button type="button" class="btn " data-toggle="modal" data-target="#exampleModal">
                                        <i class="lnr lnr-plus-circle"></i>
                                    </button>
                                </div>

                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <tr>
                                        <th>NAMA DEPAN</th>
                                        <th>NAMA BELAKANG</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>AGAMA</th>
                                        <th>ALAMAT</th>
                                        <th>RATA NILAI</th>
                                        <th>AKSI</th>
                                    </tr>


                                    @foreach ($data_siswa as $siswa)
                                        <tr>
                                            <td><a href="/siswa/{{ $siswa->id }}/profile"> {{ $siswa->nama_depan }}</a>
                                            </td>
                                            <td><a href="/siswa/{{ $siswa->id }}/profile">{{ $siswa->nama_belakang }}</a>
                                            </td>
                                            <td>{{ $siswa->jenis_kelamin }}</td>
                                            <td>{{ $siswa->agama }}</td>
                                            <td>{{ $siswa->alamat }}</td>
                                            <td>{{ $siswa->rataNilai() }}</td>
                                            <td>
                                                <a href="/siswa/{{ $siswa->id }}/edit"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm delete"
                                                    siswa-id="{{ $siswa->id }}">Delete</a>
                                            </td>

                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODALll --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/siswa/create" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group {{ $errors->has('nama_depan') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1" class="form-label">Nama Depan</label>
                            <input name="nama_depan" type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Nama Depan" value="{{ old('nama_depan') }}">
                            @if ($errors->has('nama_depan'))
                                <span class="help_block">{{ $errors->first('nama_depan') }}</span>
                            @endif


                        </div>
                        <div class="form-group {{ $errors->has('nama_belakang') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1" class="form-label">Nama Belakang</label>
                            <input name="nama_belakang" type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Nama Belakang"
                                value="{{ old('nama_belakang') }}">
                            @if ($errors->has('nama_belakang'))
                                <span class="help_block">{{ $errors->first('nama_belakang') }}</span>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help_block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }} ">
                            <label for="exampleFormControlSelect">Pilih Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">

                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki - Laki
                                </option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                </option>

                            </select>
                            @if ($errors->has('jenis_kelamin'))
                                <span class="help_block">{{ $errors->first('jenis_kelamin') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                            <label for="exampleFormControlSelect">Pilih Agama</label>
                            <select name="agama" class="form-control" aria-label="exampleFormControlSelect1">

                                <option value="Kristen Protestan"
                                    {{ old('agama') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                                <option value="Kristen Khatolik"
                                    {{ old('agama') == 'Kristen Khatolik' ? 'selected' : '' }}>Kristen Khatolik</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                <option value="Khong Hu Chu" {{ old('agama') == 'Khong Hu Chu' ? 'selected' : '' }}>Khong
                                    Hu Chu</option>
                            </select>
                            @if ($errors->has('agama'))
                                <span class="help_block">{{ $errors->first('agama') }}</span>
                            @endif
                        </div>

                        <div class="form-group ">
                            <label for="floatingTextarea2">Alamat</label>
                            <div class="form-floating mb-3">
                                <textarea name="alamat" class="form-control" placeholder="Alamat" id="floatingTextarea2" style="height: 100px">{{ old('alamat') }}</textarea>

                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}"">
                            <label for="exampleFormControlSelect1" class="mb-3">Avatar</label>
                            <input type="file" name="avatar" class="form-control">

                            @if ($errors->has('avatar'))
                                <span class="help_block">{{ $errors->first('avatar') }}</span>
                            @endif
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>


@stop
@section('footer')
    <script>
        $('.delete').click(function() {
            var siswa_id = $(this).attr('siswa-id');
            
            swal({
                    title: "Hapus ?",
                    text: "Data siswa "+ siswa_id +" akan di hapus ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location="/siswa/"+siswa_id+"/delete";
                       
                    } 
                });
        });
    </script>
@stop
