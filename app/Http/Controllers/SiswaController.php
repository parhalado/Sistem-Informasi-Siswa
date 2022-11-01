<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index( Request $request)
    {
        if ($request->has('cari')) {
            $data_siswa = Siswa::where('nama_depan','LIKE','%'  .$request->cari.'%')->get();
        }
        else {
            $data_siswa = Siswa::all();
        }
        
        return view('siswa.index',['data_siswa' => $data_siswa]);
    }
    public function create(Request $request)
    {
        
        //insert table user
        $user = new User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = Str::random(60);
        $user->save();


        // insert table siswa
        $request->request->add(['user_id' => $user->id]);
        $siswa = Siswa::create($request->all());

        return redirect('/siswa')->with('sukses','Data Berhasil Ditambahkan !');
    }
    public function edit($id)
    {
        $siswa =Siswa::find($id);
        return view('/siswa/edit',['siswa' => $siswa]);
    }
    public function update(Request $request ,$id)
    {
        $siswa = Siswa::find($id);
        $siswa->update($request->all());
        if($request->hasFile('avatar'))
        {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses','Data berhasil di ubah');
    }
    public function delete($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();

        return redirect('/siswa')->with('sukses','Data Berhasil di Hapus');
    }
    public function profile($id)
    {
        $siswa = Siswa::find($id);
        return view('siswa.profile',['siswa' => $siswa]);
    }
}
