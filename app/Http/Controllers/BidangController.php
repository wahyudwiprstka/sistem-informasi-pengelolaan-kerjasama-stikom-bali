<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;
use SDamian\Larasort\Larasort;

class BidangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['index']]);
        $this->middleware('admin', ['except' => ['index']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->orderby == null && $request->search == null) {
            $bidang = Bidang::orderBy('id', 'desc')->paginate(10);
        } else if ($request->orderby != null) {
            $bidang = Bidang::whereNotNull('id')->autosort()->paginate(10);
        } else if ($request->search != null) {
            $bidang = Bidang::where('nama_bidang', 'like', '%' . $request->search . '%')->paginate(10);
        }
        return view('bidang.bidang', [
            'bidangs' => $bidang,
            'orderby' => $request->orderby,
            'order' => $request->order
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bidang.add-bidang');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bidang' => 'required',
            'klasifikasi' => 'required',
            'pic' => 'required'
        ]);

        Bidang::create($validated);
        return redirect('/bidang')->with('success', 'Bidang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bidang = Bidang::find($id);
        return view('bidang.edit-bidang', [
            'bidang' => $bidang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bidang = Bidang::find($id);
        $bidang->nama_bidang = $request->nama_bidang;
        $bidang->klasifikasi = $request->klasifikasi;
        $bidang->pic = $request->pic;
        $bidang->save();
        return redirect('/bidang')->with('success', 'Bidang berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bidang = Bidang::where('id', $id)->delete();
        return redirect('/bidang');
    }
}
