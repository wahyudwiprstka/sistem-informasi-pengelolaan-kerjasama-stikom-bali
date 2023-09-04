<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Kerjasama;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home()
    {
        $user = User::all();
        $kerjasama = Kerjasama::paginate(5);
        $allkerjasama = Kerjasama::all();
        $yearcount = DB::table('kerjasama')->select(DB::raw('count(*) as count, year(tanggal_awal) as date'))->groupBy(DB::raw('year(tanggal_awal)'))->orderBy(DB::raw('year(tanggal_awal)'))->get();
        $mou = Kerjasama::where('jenis', 'mou');
        $moa = Kerjasama::where('jenis', 'moa');
        $realisasi = Kerjasama::where('jenis', 'realisasi');
        $mitra = Mitra::all();

        $documentsHampirKadaluarsa = Kerjasama::where('status', 'aktif')->where('tanggal_berakhir', '<', Carbon::now()->addDays(30))->where('tanggal_berakhir', '>', Carbon::now())->paginate(10);
        $documentslewat = Kerjasama::where('status', 'aktif')->where('tanggal_berakhir', '<', Carbon::now())->paginate(10);

        return view('dashboard', [
            'user' => $user,
            'mou' => $mou,
            'moa' => $moa,
            'realisasi' => $realisasi,
            'kerjasama' => $kerjasama,
            'allkerjasama' => $allkerjasama,
            'yearcount' => $yearcount,
            'mitra' => $mitra,
            'documentsHampirKadaluarsa' => $documentsHampirKadaluarsa,
            'documentslewat' => $documentslewat,
        ]);
    }

    public function userNotAccepted()
    {
        return view('must_accepted');
    }

    public function unauthorized()
    {
        return view('unauthorized');
    }
}
