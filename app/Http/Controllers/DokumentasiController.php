<?php

namespace App\Http\Controllers;


use App\Models\dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokumentasi = Dokumentasi::get();
        return view('admin.dokumentasi.dokumentasi', compact('dokumentasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dokumentasi.dokumentasitambah');
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
            'waktu' => 'required',
            'deskripsi' => 'required',
            'media' => 'required|file|image|mimes:jpg,img,jpeg|max:500000',

        ]);

        $newNameMedia = $request->nama . '-' . date('His'). '-' .$request->media->extension();

        $request->file('media')->move(public_path('images/dokumentasi'), $newNameMedia);


        Dokumentasi::create([
            'nama'=>$request->nama,
            'waktu'=>$request->waktu,
            'deskripsi'=>$request->deskripsi,
            'media'=>$newNameMedia
        ]);

        return redirect()->route('dokumentasi.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokumentasi = Dokumentasi::where('id', $id)->get();
        return view('admin.dokumentasi.dokumentasidetail', compact('dokumentasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumentasi = Dokumentasi::findOrfail($id);
        return view('admin.dokumentasi.dokumentasiedit', compact('dokumentasi'));
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
        // dd($request);
        $request->validate([
            'nama' => 'required',
            'waktu' => 'required',
            'deskripsi' => 'required',
            'media' => 'file|mimes:jpg,jpeg|max:50000'
        ]);

        $dokumenta = $request->all();

        $dokumentasi = Dokumentasi::find($id); 
        
        // dd($dokumentasi);
        if ($media = $request->file('media')) {
            File::delete('images/dokumentasi/'.$dokumentasi->media);
            $file_name = $request->media->getClientOriginalName();
            $media->move(public_path('images/dokumentasi'), $file_name);
            $dokumenta['media'] = "$file_name";
        }else{
            unset($dokumenta['media']);
        }

        $dokumentasi->update($dokumenta);

        return redirect()->route('dokumentasi.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumentasi $dokumentasi)
    {
        $dokumentasi->delete();
        File::delete('images/dokumentasi/'.$dokumentasi->media);
        return redirect()->back();
    }

    public function showuser($id)
    {
        $dokumentasi = Dokumentasi::where('id', $id)->get();
        return view('user.dokumentasidetail', compact('dokumentasi'));
    }

    public function user()
    {
        $dokumentasi = Dokumentasi::get();
        return view('user.dokumentasi', compact('dokumentasi')); 
    }
}
