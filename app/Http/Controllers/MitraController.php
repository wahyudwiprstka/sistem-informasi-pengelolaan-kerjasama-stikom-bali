<?php

namespace App\Http\Controllers;

use App\Models\Kerjasama;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SDamian\Larasort\Larasort;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->orderby == null && $request->search == null) {
            $mitras = Mitra::orderBy('id', 'desc')->paginate(10);
        } else if ($request->orderby != null) {
            $mitras = Mitra::whereNotNull('id')->autosort()->paginate(10);
        } else if ($request->search != null) {
            $mitras = Mitra::where('nama', 'like', '%' . $request->search . '%')->paginate(10);
        }
        return view('mitra.mitra', [
            'mitras' => $mitras,
            'orderby' => $request->orderby,
            'order' => $request->order,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mitra.add-mitra');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'klasifikasi' => 'required',
            'country' => 'required',
            'address' => 'nullable',
            'telp' => 'nullable',
            'website' => 'nullable',
        ]);

        Mitra::create($validated);
        return redirect('/mitra/create')->with('success', 'Mitra berhasil dibuat');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     $mitra = DB::table('mitra')->where('id', $id);
    //     return view('mitra-detail', [
    //         'mitra' => $mitra,
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mitra = Mitra::where('id', $id)->first();
        return view('mitra.edit-mitra', [
            'mitra' => $mitra
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mitra = Mitra::where('id', $id)->first();
        $mitra->nama = $request->nama;
        $mitra->klasifikasi = $request->klasifikasi;
        $mitra->country = $request->country;
        $mitra->address = $request->address;
        $mitra->telp = $request->telp;
        $mitra->website = $request->website;

        $mitra->save();
        return redirect('/mitra');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kerjasama = Kerjasama::all();
        foreach ($kerjasama as $kerma) {
            if ($kerma->id_mitra == $id) {
                return back()->with('failed', 'Delete Failed, Silahkan cek kerjasama yang berhubungan dengan mitra ini.');
            }
        }
        Mitra::destroy($id);
        return back()->with('success', 'Delete Success');
    }
}
