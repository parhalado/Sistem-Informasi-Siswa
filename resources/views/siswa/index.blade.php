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
                                        {{session('sukses')}}
                                            </div>
                                        @endif

									<h3 class="panel-title">Tabel Data Siswa</h3>
                                       <div class="right">
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
                                                    <th>AKSI</th>
                                                </tr>

                                                
                                                    @foreach ($data_siswa as $siswa)
                                                    <tr>
                                                        <td>{{ $siswa ->nama_depan }}</td>
                                                        <td>{{ $siswa ->nama_belakang }}</td>
                                                        <td>{{ $siswa ->jenis_kelamin }}</td>
                                                        <td>{{ $siswa ->agama }}</td>
                                                        <td>{{ $siswa ->alamat }}</td>
                                                        <td>
                                                            <a href="/siswa/{{$siswa->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                                            <a href="/siswa/{{$siswa->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin data {{ $siswa->nama_depan }} ini akan di hapus?')">Delete</a>
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
                            <form action="/siswa/create" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Depan</label>
                                    <input name="nama_depan" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Depan">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Belakang</label>
                                    <input name="nama_belakang" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Belakang">
                                </div>
                                <select name="jenis_kelamin" class="form-select mb-3" aria-label="Default select example">
                                    <option selected>Pilih Jenis Kelamin</option>
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                    
                                </select>
                                <select name="agama" class="form-select mb-3" aria-label="Default select example">
                                    <option selected>Pilih Agama</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Kristen Khatolik">Kristen Khatolik</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Khong Hu Chu">Khong Hu Chu</option>
                                </select>
                                <div class="form-floating mb-3">
                                    <textarea name="alamat" class="form-control" placeholder="Alamat" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Alamat</label>
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

