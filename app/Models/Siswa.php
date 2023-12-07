<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
     protected $table = 'siswa';
     protected $fillable = ['nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar','user_id'];
   
     public function getAvatar()
     {
        if (!$this->avatar) {
            return asset('images/default.ico');
            
        }
        return asset('images/'.$this->avatar);
     }
     
     public function mapel()
     {
        return $this->belongsToMany(Mapel::class)->withPivot('nilai')->withTimestamps();
     }

     public function totalNilai()
     {
      $total =0;
      foreach ($this->mapel as $nilai)
       {
         $total += $nilai->pivot->nilai;
      }
      return $total;
     }

     public function rataNilai()
     {
      $total= 0;
      $hitung =0;
      foreach ($this->mapel as $mapel) {
         $total += $mapel->pivot->nilai;
         $hitung++;
      }
      return round($total/($hitung ? : 1)) ;

     }
     public function namaLengkap()
     {
      return $this->nama_depan.' '.$this->nama_belakang;

     }
   
     use HasFactory;
}
