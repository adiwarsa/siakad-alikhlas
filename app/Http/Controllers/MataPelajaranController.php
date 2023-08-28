<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
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
        $data['guru'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru');
        })->get();

        return view('mapel.create', $data);
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
            'nama' => 'required',
            'kode' => 'required',
            'jenjang' => 'required', 
            'kkm' => 'required'
        ];


        $customMessages = [
            'id_user.required' => 'Field guru belum diisi!',
            'nama.required' => 'Field nama belum diisi!',
            'kode.required' => 'Field kode belum diisi!',
            'jenjang.required' => 'Field jenjang belum diisi!',
            'kkm.required' => 'Field kkm belum diisi!'
        ];

        $this->validate($request, $rules, $customMessages);

        $mapel = MataPelajaran::create([
            'id_user' => $request->id_user,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jenjang' => $request->jenjang,
            'kkm' => $request->kkm,

        ]);

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
            'nama' => 'required',
            'kode' => 'required',
            'jenjang' => 'required', 
            'kkm' => 'required',
        ];


        $customMessages = [
            'id_user.required' => 'Field guru belum diisi!',
            'nama.required' => 'Field nama belum diisi!',
            'kode.required' => 'Field kode belum diisi!',
            'jenjang.required' => 'Field jenjang belum diisi!',
            'kkm.required' => 'Field kkm belum diisi!'
        ];

        $mapel = MataPelajaran::findOrFail($id);
        $this->validate($request, $rules, $customMessages);

        $mapel->update([
            'id_user' => $request->id_user,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jenjang' => $request->jenjang,
            'kkm' => $request->kkm,

        ]);
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
