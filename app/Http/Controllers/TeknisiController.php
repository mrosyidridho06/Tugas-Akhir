<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Teknisi $teknisi)
    {
        $teknisi = Teknisi::get();
        return view('admin.teknisi.index', compact('teknisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teknisi.tambah');
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
            'nim' => 'required',            
            'hari' => 'required',            
            'sesi' => 'required',            
            'no_hp' => 'required',            
            'foto' => 'required|mimes:jpg,img,jpeg|max:50000'
        ]);

        $newNameFoto = date('ymd'). '-' . $request->foto->extension();
         
        $request->file('foto')->move(public_path('teknisi/foto'), $newNameFoto);
        
        Teknisi::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'hari' => $request->hari,
            'sesi' => $request->sesi,
            'no_hp' => $request->no_hp,
            'foto' => $newNameFoto
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teknisi $teknisi)
    {
        // dd($teknisi);
        return view('admin.teknisi.edit', compact('teknisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teknisi $teknisi)
    {
        return view('admin.teknisi.edit', compact('teknisi'));
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
            'nim' => 'required',            
            'hari' => 'required',            
            'sesi' => 'required',            
            'no_hp' => 'required',            
            'foto' => 'required|mimes:jpg,img,jpeg|max:50000'
        ]);
        
        $teknisis = $request->all();

        $teknisi = Teknisi::find($id);

        if ($foto = $request->file('foto')) {
            file::delete('teknisi/foto' .$teknisi->foto);
            $file_name = $request->foto->getClientOriginalName();
            $foto->move(public_path('teknisi/foto'), $file_name);
            $teknisis['foto'] = "$file_name";
        }
        else {
            unset($teknisis['foto']);
        }

        $teknisi->update($teknisis);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teknisi $teknisi, $id)
    {
        $teknisi->destroy($id);
        return redirect()->back();
    }
}
