<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Santri';
        $data['santri'] = Santri::all();
        return view('santri.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Data Santri';
        $data['kelas'] = Kelas::all();

        return view('santri.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'id_kelas' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required', 
            'tanggal_lahir' => 'required', 
            'tahun_masuk' => 'required', 
        ];


        $customMessages = [
            'id_kelas.required' => 'Field kelas belum diisi!',
            'nis.required' => 'Field nis belum diisi!',
            'nama.required' => 'Field nama belum diisi!',
            'jenis_kelamin.required' => 'Field jenis kelamin belum diisi!',
            'tempat_lahir.required' => 'Field tempat lahir belum diisi!',
            'tanggal_lahir.required' => 'Field tanggal lahir belum diisi!',
            'tahun_masuk.required' => 'Field tahun masuk belum diisi!',
        ];

        $this->validate($request, $rules, $customMessages);

        $santri = Santri::create([
            'id_kelas' => $request->id_kelas,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir, 
            'tanggal_lahir' => $request->tanggal_lahir, 
            'tahun_masuk' => $request->tahun_masuk, 

        ]);

        return redirect('/santri')->with('message', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Ubah Data kelas';
        $data['santri'] = Santri::findOrFail($id);
        $data['kelas'] = Kelas::all();

        return view('santri.edit', $data);
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
        $rules = [
            'id_kelas' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required', 
            'tanggal_lahir' => 'required', 
            'tahun_masuk' => 'required', 
        ];

        $customMessages = [
            'id_kelas.required' => 'Field kelas belum diisi!',
            'nis.required' => 'Field nis belum diisi!',
            'nama.required' => 'Field nama belum diisi!',
            'jenis_kelamin.required' => 'Field jenis kelamin belum diisi!',
            'tempat_lahir.required' => 'Field tempat lahir belum diisi!',
            'tanggal_lahir.required' => 'Field tanggal lahir belum diisi!',
            'tahun_masuk.required' => 'Field tahun masuk belum diisi!',
        ];

        $santri = Santri::findOrFail($id);

        $this->validate($request, $rules, $customMessages);

        $santri->update([
            'id_kelas' => $request->id_kelas,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir, 
            'tanggal_lahir' => $request->tanggal_lahir, 
            'tahun_masuk' => $request->tahun_masuk, 

        ]);
        return redirect('/santri')->with('message', 'Data telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);
        $santri->delete();
        return redirect('/santri')->with('message', 'Data telah dihapus');
    }
}
