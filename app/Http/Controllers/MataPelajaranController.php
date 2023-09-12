<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Mata Pelajaran';
        $data['mapel'] = MataPelajaran::all();
        return view('mapel.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Data Mata Pelajaran';
        $data['kelas'] = Kelas::all();
        $data['guru'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru');
        })->get();

        return view('mapel.create', $data);
    }

    public function createnilai($id)
    {
        $data['mapel'] = MataPelajaran::findOrFail($id);
        $namamapel = $data['mapel']->nama;
        $data['pageTitle'] = 'Tambah Data KKM Nilai Pelajaran ' .$namamapel;

        return view('mapel.createnilai', $data);
    }

    public function storenilai(Request $request, $id)
    {

        $mapel = MataPelajaran::findOrFail($id);
        $rules = [
            'descpredikata' => 'required',
            'descpredikatb' => 'required',
            'descpredikatc' => 'required',
            'descpredikatd' => 'required',
        ];

        $customMessages = [
            'descpredikata.required' => 'Field Predikat A belum diisi!',
            'descpredikatb.required' => 'Field Predikat B belum diisi!',
            'descpredikatc.required' => 'Field Predikat C belum diisi!',
            'descpredikatd.required' => 'Field Predikat C belum diisi!',
        ];

        $this->validate($request, $rules, $customMessages);
        $nilai = Nilai::create([
            'id_mapel' => $id,
            'kkm' => $mapel->kkm,
            'descpredikata' => $request->descpredikata,
            'descpredikatb' => $request->descpredikatb,
            'descpredikatc' => $request->descpredikatc,
            'descpredikatd' => $request->descpredikatd,

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
        $rules = [
            'id_user' => 'required',
            'id_kelas' => 'required',
            'nama' => 'required',
            'kode' => 'required',
            'kkm' => 'required'
            // 'jenjang' => 'required', 
        ];


        $customMessages = [
            'id_user.required' => 'Field guru belum diisi!',
            'id_kelas.required' => 'Field kelas belum diisi!',
            'nama.required' => 'Field nama belum diisi!',
            'kode.required' => 'Field kode belum diisi!',
            'kkm.required' => 'Field kkm belum diisi!'
            // 'jenjang.required' => 'Field jenjang belum diisi!',
        ];

        $this->validate($request, $rules, $customMessages);

        $mapel = MataPelajaran::create([
            'id_user' => $request->id_user,
            'id_kelas' => $request->id_kelas,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kkm' => $request->kkm,

        ]);
        $kelas = Kelas::find($request->id_kelas);
        $mapel->jenjang = $kelas->madrasah;
       
        $mapel->save();

        return redirect('/mapel')->with('message', 'Data telah ditambahkan');
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
        $data['pageTitle'] = 'Ubah Data Mata Pelajaran';
        $data['mapel'] = MataPelajaran::findOrFail($id);
        $data['kelas'] = Kelas::all();
        $data['guru'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru');
        })->get();

        return view('mapel.edit', $data);
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
            'id_user' => 'required',
            'id_kelas' => 'required',
            'nama' => 'required',
            'kode' => 'required',
            'kkm' => 'required',
            // 'jenjang' => 'required', 
        ];


        $customMessages = [
            'id_user.required' => 'Field guru belum diisi!',
            'id_kelas.required' => 'Field kelas belum diisi!',
            'nama.required' => 'Field nama belum diisi!',
            'kode.required' => 'Field kode belum diisi!',
            'kkm.required' => 'Field kkm belum diisi!'
            // 'jenjang.required' => 'Field jenjang belum diisi!',
        ];

        $mapel = MataPelajaran::findOrFail($id);
        $this->validate($request, $rules, $customMessages);

        $mapel->update([
            'id_user' => $request->id_user,
            'id_kelas' => $request->id_kelas,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kkm' => $request->kkm,

        ]);

        $kelas = Kelas::find($request->id_kelas);
        $mapel->jenjang = $kelas->madrasah;
       
        $mapel->save();
        
        return redirect('/mapel')->with('message', 'Data telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $mapel->delete();
        return redirect('/mapel')->with('message', 'Data telah dihapus');
    }
}
