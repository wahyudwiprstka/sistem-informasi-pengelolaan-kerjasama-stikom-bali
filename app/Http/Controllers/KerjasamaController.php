<?php

namespace App\Http\Controllers;

use App\Models\DokumenKerjasama;
use App\Models\Kerjasama;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KerjasamaController extends Controller
{   
    public function hampirKadaluarsa()
    {
        $dateplus = Carbon::now()->addDays(30);
        $documents = Kerjasama::where('status', 'aktif')->where('tanggal_berakhir', '<', Carbon::now()->addDays(30))->where('tanggal_berakhir', '>', Carbon::now())->paginate(10);
        $documentslewat = Kerjasama::where('status', 'aktif')->where('tanggal_berakhir', '<', Carbon::now())->paginate(10);
        return view('kerjasama.hampir-kadaluarsa', [
            'documents' => $documents,
            'dateplus' => $dateplus,
            'documentslewat' => $documentslewat
        ]);
    }
}
