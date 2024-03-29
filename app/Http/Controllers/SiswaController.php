<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data_siswa = Siswa::where('nama_depan', 'LIKE', '%'  . $request->cari . '%')->get();
        } else {
            $data_siswa = Siswa::all();
        }

        return view('siswa.index', ['data_siswa' => $data_siswa]);
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_depan' => 'min:5',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'agama' => 'required',
            'alamat' => 'required',
            'avatar' => 'mimes:jpg,png',
        ]);

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
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        return redirect('/siswa')->with('sukses', 'Data Berhasil Ditambahkan !');
    }
    public function edit(Siswa $siswa)
    {
        return view('/siswa/edit', ['siswa' => $siswa]);
    }
    public function update(Request $request, Siswa $siswa)
    {
        $siswa->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data berhasil di ubah');
    }
    public function delete(Siswa $siswa)
    {

        $siswa->delete();

        return redirect('/siswa')->with('sukses', 'Data Berhasil di Hapus');
    }
    public function profile(Siswa $siswa)
    {
        $matapelajaran = Mapel::all();
        // menyiapkan data untuk chart
        $categories = [];
        $data = [];
        foreach ($matapelajaran as $mp) {
            if ($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()) {
                $categories[] = $mp->nama;
                $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }
        }

        return view('siswa.profile', ['siswa' => $siswa, 'matapelajaran' => $matapelajaran, 'categories' => $categories, 'data' => $data]);
    }
    public function addnilai(Request $request, $idsiswa)
    {
        $siswa = Siswa::find($idsiswa);
        if ($siswa->mapel()->where('mapel_id', $request->mapel)->first()) {
            return redirect('siswa/' . $idsiswa . '/profile')->with('error', 'Data mata pelajaran sudah ada');
        }
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);
        return redirect('siswa/' . $idsiswa . '/profile')->with('sukses', 'Data Nilai berhasil di masukkan');
    }

    public function deletenilai($idsiswa, $idmapel)
    {
        $siswa = Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('sukses', 'Data Nilai Berhasil Di hapus');
    }
    public function export()
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }
    public function exportpdf()
    {
        $siswa = Siswa::all();
        $pdf = PDF::loadView('exports.pdf', ['siswa' => $siswa]);
        return $pdf->download('siswa.pdf');
    }
}
