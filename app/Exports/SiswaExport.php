<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SiswaExport implements FromView
{
    public function view(): View
    {
        return view('exports.invoices', [
            'siswa' => Siswa::all()
        ]);
    }
}
