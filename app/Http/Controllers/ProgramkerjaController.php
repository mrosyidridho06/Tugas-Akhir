<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\programkerja;
use App\Models\divisi;
use App\Models\Kepengurusan;
use Exception;
use Illuminate\Support\Facades\File;

class ProgramkerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proker = Programkerja::get();
        return view('admin.proker.proker', compact('proker'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kepengurusan = Kepengurusan::select('nama','id')->get();
        $divisi = Divisi::select('nama','id')->get();
        // dd($kepengurusan);
        return view('admin.proker.tambah',
        [
            'kepengurusan' => $kepengurusan,
            'divisi' => $divisi,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'penanggung_jawab' => 'required',
            'pengurus' => 'required',
            'landasan_kegiatan' => 'required',
            'tujuan_kegiatan' => 'required',
            'objek_segmentasi' => 'required',
            'deskripsi' => 'required',
            'parameter_keberhasilan' => 'required',
            'kebutuhan_dana' => 'required',
            'sumber_dana' => 'required',
            'jumlah_sdm' => 'required',
            'kebutuhan_lain' => 'required',
            'divisi_id' => 'required',
            'kepengurusan_id' => 'required'
        ]);

        Programkerja::create([
            'nama' => $request->nama,
            'penanggung_jawab' => $request->penanggung_jawab,
            'pengurus' => $request->pengurus,
            'landasan_kegiatan' => $request->landasan_kegiatan,
            'tujuan_kegiatan' => $request->tujuan_kegiatan,
            'objek_segmentasi' => $request->objek_segmentasi,
            'deskripsi' => $request->deskripsi,
            'parameter_keberhasilan' => $request->parameter_keberhasilan,
            'kebutuhan_dana' => $request->kebutuhan_dana,
            'sumber_dana' => $request->sumber_dana,
            'jumlah_sdm' => $request->jumlah_sdm,
            'kebutuhan_lain' => $request->kebutuhan_lain,
            'divisi_id' => $request->divisi_id,
            'kepengurusan_id' => $request->kepengurusan_id
        ]);

        return redirect()->route('proker.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proker = Programkerja::findOrfail($id);
        return view('admin.proker.prokeredit', compact('proker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'penanggung_jawab' => 'required',
            'pengurus' => 'required',
            'landasan_kegiatan' => 'required',
            'tujuan_kegiatan' => 'required',
            'objek_segmentasi' => 'required',
            'deskripsi' => 'required',
            'parameter_keberhasilan' => 'required',
            'kebutuhan_dana' => 'required',
            'sumber_dana' => 'required',
            'jumlah_sdm' => 'required',
            'kebutuhan_lain' => 'required'
        ]);

        return redirect()->route('proker.proker');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proker = Programkerja::find($id);
        try {
            $proker->delete();
        } catch (Exception $e){
            return redirect()->back();
        }
        return redirect()->back();
    }


    public function show($id)
    {
        $proker = Programkerja::findOrfail($id);
        return view('admin.proker.show', compact('proker'));
    }
    public function user()
    {
        $proker = programkerja::get();
        return view('user.proker', compact('proker')); 
    }


}

