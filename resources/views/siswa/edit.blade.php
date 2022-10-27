@extends('layouts.master')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
							    <div class="panel-heading">
									<h3 class="panel-title">Inputs</h3>
								</div>
								<div class="panel-body">
                                    <form action="/siswa/{{ $siswa ->id }}/update" method="POST">
                                            @csrf
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Nama Depan</label>
                                                        <input name="nama_depan"value="{{ $siswa->nama_depan }}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Depan">
                                                    </div>        
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Nama Belakang</label>
                                                        <input name="nama_belakang" value="{{ $siswa->nama_belakang }}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Belakang">
                                                    </div>
                                                   <div class="form-group">
                                                     <label for="exampleFormControlSelect1" class="mb-3">Pilih Jenis Kelamin</label>
                                                        <select name="jenis_kelamin" class="form-select mb-3" aria-label="Default select example">
                                                        <option selected>Pilih Jenis Kelamin</option>
                                                        <option value="L" @if ($siswa->jenis_kelamin == 'L') selected @endif>Laki - Laki</option>
                                                        <option value="P" @if ($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                                                
                                                     </select>
                                                   </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1" class="mb-3">Pilih Agama</label>
                                                        <select name="agama" class="form-select mb-3" aria-label="Default select example">
                                                        
                                                            <option value="Kristen Protestan" @if ($siswa->agama == 'Kristen Protestan') selected @endif>Kristen Protestan</option>
                                                                <option value="Kristen Khatolik" @if ($siswa->agama == 'Kristen Khatolik') selected @endif>Kristen Khatolik</option>
                                                                <option value="Islam" @if ($siswa->agama == 'Islam') selected @endif>Islam</option>
                                                                <option value="Hindu" @if ($siswa->agama == 'Hindu') selected @endif>Hindu</option>
                                                                <option value="Budha" @if ($siswa->agama == 'Budha') selected @endif>Budha</option>
                                                                <option value="Khong Hu Chu" @if ($siswa->agama == 'Khong Hu Chu') selected @endif>Khong Hu Chu</option>
                                                    </select>
                                                    </div>
                                                    
                                                   
                                                   <div class="form-group">
                                                    <label for="exampleFormControlSelect1" class="mb-3">Alamat</label>
                                                        <div class="form-floating mb-3">
                                                             <textarea name="alamat" class="form-control" placeholder="Alamat" id="floatingTextarea2" style="height: 100px">{{ $siswa->alamat }}</textarea>
                                                            
                                                        </div>
                                                   </div>
                                                    
                                                    {{-- FOOTER         --}}
                                                
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary m-3" data-bs-dismiss="modal">Tutup</button>
                                                        <button type=" submit" class="btn btn-warning"> Update</button>
                                                    </div>
                                            </form>
								</div>	
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content1')
    
        <h1>Edit Data Siswa</h1>
        @if (session('sukses'))
            <div class="alert alert-success" role="alert">
           {{session('sukses')}}
            </div>
        @endif
            
        <div class="row">
            <div class="col-md-12"> 
               <form action="/siswa/{{ $siswa ->id }}/update" method="POST">
                @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Depan</label>
                        <input name="nama_depan"value="{{ $siswa->nama_depan }}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Depan">
                    </div>        
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Belakang</label>
                    <input name="nama_belakang" value="{{ $siswa->nama_belakang }}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Belakang">
                    
                        </div>
                        <select name="jenis_kelamin" class="form-select mb-3" aria-label="Default select example">
                            <option selected>Pilih Jenis Kelamin</option>
                                <option value="L" @if ($siswa->jenis_kelamin == 'L') selected @endif>Laki - Laki</option>
                                <option value="P" @if ($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                    
                        </select>
                        <select name="agama" class="form-select mb-3" aria-label="Default select example">
                            <option selected>Pilih Agama</option>
                                <option value="Kristen Protestan" @if ($siswa->agama == 'Kristen Protestan') selected @endif>Kristen Protestan</option>
                                <option value="Kristen Khatolik" @if ($siswa->agama == 'Kristen Khatolik') selected @endif>Kristen Khatolik</option>
                                <option value="Islam" @if ($siswa->agama == 'Islam') selected @endif>Islam</option>
                                <option value="Hindu" @if ($siswa->agama == 'Hindu') selected @endif>Hindu</option>
                                <option value="Budha" @if ($siswa->agama == 'Budha') selected @endif>Budha</option>
                                <option value="Khong Hu Chu" @if ($siswa->agama == 'Khong Hu Chu') selected @endif>Khong Hu Chu</option>
                        </select>
                        <div class="form-floating mb-3">
                            <textarea name="alamat" class="form-control" placeholder="Alamat" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">{{ $siswa->alamat }}</label>
                        </div>
                                
                    
                        <div class="modal-footer">
                             <button type="button" class="btn btn-secondary m-3" data-bs-dismiss="modal">Tutup</button>
                             <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                </form>
            </div>
        </div>

@endsection

