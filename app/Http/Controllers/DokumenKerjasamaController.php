<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Kerjasama;
use App\Models\Mitra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SDamian\Larasort\Larasort;

class DokumenKerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Larasort::setDefaultSortable('id');

        if ($request->orderby == null) {
            $documents = Kerjasama::orderBy('id', 'desc')->paginate(10);
        } else {
            $documents = Kerjasama::whereNotNull('id')->autosort()->paginate(10);
        }

        if ($request->search) {
            $documents = Kerjasama::where('judul', 'LIKE', '%' . $request->search . '%')->paginate(10);
        }

        return view('kerjasama.kerjasama', [
            'documents' => $documents,
            'orderby' => $request->orderby,
            'order' => $request->order
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mitras = DB::select('select * from mitra');
        $mous = DB::select('select * from kerjasama where jenis="mou"');
        $bidang = DB::select('select * from bidang');
        return view('kerjasama.add-kerjasama', [
            'mitras' => $mitras,
            'mous' => $mous,
            'bidang' => $bidang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'jenis' => 'required',
            'status' => 'required',
            'bidang' => 'required',
            'durasi' => 'required',
            'tanggal_awal' => 'nullable',
            'tanggal_berakhir' => 'nullable',
            'id_mitra' => 'required',
            'ttd_pihak1' => 'required',
            'ttd_pihak2' => 'required',
            'jabatan_pihak1' => 'required',
            'jabatan_pihak2' => 'required',
            'deskripsi' => 'nullable',
            'id_mou' => 'nullable',
            'no_dokumen_stikom' => 'nullable',
            'no_dokumen_mitra' => 'nullable',
            'dokumen' => 'required|mimes:pdf|max:2048'
        ]);

        if ($request->jenis == 'mou' && $request->id_mou != null) {
            return back()->with('dokumenError', 'Jenis dokumen harus selain MOU untuk mengisi Dasar Dokumen Kerjasama');
        }

        $filenamewithext = $request->file('dokumen')->getClientOriginalName();
        $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
        $extension = $request->file('dokumen')->getClientOriginalExtension();
        $filesavename = $filename . '_' . time() . '.' . $extension;

        $path = $request->file('dokumen')->storeAs('public/dokumen', $filesavename);

        $validated['dokumen'] = $filesavename;

        // Assign data ke tabel kerjasama
        $kerjasama = [];
        $kerjasama['judul'] = $validated['judul'];
        $kerjasama['jenis'] = $validated['jenis'];
        $kerjasama['status'] = $validated['status'];
        $kerjasama['durasi'] = $validated['durasi'];
        $kerjasama['bidang'] = $validated['bidang'];
        $kerjasama['tanggal_awal'] = $validated['tanggal_awal'];
        $kerjasama['tanggal_berakhir'] = $validated['tanggal_berakhir'];
        $kerjasama['id_mitra'] = $validated['id_mitra'];
        $kerjasama['deskripsi'] = $validated['deskripsi'];
        $kerjasama['id_mou'] = $validated['id_mou'];
        $kerjasama['id_user'] = $request->user()->id;

        // Assign data dokumen ke tabel dokumen
        $dokumen = [];
        $dokumen['no_dokumen_stikom'] = $validated['no_dokumen_stikom'];
        $dokumen['no_dokumen_mitra'] = $validated['no_dokumen_mitra'];
        $dokumen['dokumen'] = $validated['dokumen'];

        // Memasukkan data dokumen ke database
        $dokumenUpload = Dokumen::create($dokumen);

        $kerjasama['id_dokumen'] = $dokumenUpload['id'];

        Kerjasama::create($kerjasama);

        return redirect('/kerjasama')->with('success', 'Berhasil Upload Dokumen');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kerjasama = Kerjasama::where('id', '=', $id)->first();
        return view('kerjasama.detail-kerjasama', [
            'kerjasama' => $kerjasama,
        ]);
        // return response()->file(public_path('/storage/dokumen/' . $kerjasama->dokumen), ['content-type' => 'application/pdf']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kerjasama = Kerjasama::where('id', '=', $id)->first();
        $mitras = Mitra::all();
        $mous = Kerjasama::where('jenis', '=', 'mou')->get();
        return view('kerjasama.edit-kerjasama', [
            'kerjasama' => $kerjasama,
            'mitras' => $mitras,
            'mous' => $mous
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kerjasama = Kerjasama::find($id);

        $kerjasama->judul = $request->judul;
        $kerjasama->jenis = $request->jenis;
        $kerjasama->status = $request->status;
        $kerjasama->tanggal_awal = $request->tanggal_awal;
        $kerjasama->tanggal_berakhir = $request->tanggal_berakhir;
        $kerjasama->tanggal_berakhir = $request->tanggal_berakhir;
        $kerjasama->id_mitra = $request->id_mitra;
        $kerjasama->deskripsi = $request->deskripsi;
        $kerjasama->id_mou = $request->id_mou;
        $kerjasama->no_dokumen = $request->no_dokumen;
        if ($request->dokumen != null) {
            $filenamewithext = $request->file('dokumen')->getClientOriginalName();
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
            $extension = $request->file('dokumen')->getClientOriginalExtension();
            $filesavename = $filename . '_' . time() . '.' . $extension;

            $kerjasama->dokumen = $filesavename;

            $path = $request->file('dokumen')->storeAs('public/dokumen', $filesavename);
        }

        $kerjasama->save();

        return redirect('/kerjasama/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kerjasama = Kerjasama::find($id);
        Dokumen::destroy($kerjasama->dokumen->id);
        Kerjasama::destroy($id);
        Storage::delete($kerjasama->dokumen->dokumen);
        return back()->with('success', 'Delete Success');
    }
}
