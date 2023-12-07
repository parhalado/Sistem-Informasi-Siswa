<?php

use App\Models\Guru;
use App\Models\Siswa;

function ranking5Besar()
{
    $siswa = Siswa::all();
    $siswa->map(function($s){
        $s->rataNilai = $s->ratanilai();
        return $s;
    });
    $siswa = $siswa->sortByDesc('rataNilai')->take(5);
    return $siswa;
}

function totalSiswa()
{
    return Siswa::count();
}
function totalGuru()
{
    return Guru::count();
}
