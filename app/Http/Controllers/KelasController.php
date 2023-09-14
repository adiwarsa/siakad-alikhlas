<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data['pageTitle'] = 'Kelas';
        $data['kelas'] = Kelas::all();
        return view('kelas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Data Kelas';
        $data['guru'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru');
        })->get();

        return view('kelas.create', $data);
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
            'wali_id' => 'required',
            'kelas' => 'required',
            'madrasah' => 'required',
        ];

        $customMessages = [
            'wali_id.required' => 'Field wali belum diisi!',
            'kelas.required' => 'Field kelas belum diisi!',
            'madrasah.required' => 'Field madrasah belum diisi!',
        ];
        $this->validate($request, $rules, $customMessages);

        $kelas = Kelas::create([
            'wali_id' => $request->wali_id,
            'kelas' => $request->kelas,
            'madrasah' => $request->madrasah,

        ]);

        return redirect('/kelas')->with('message', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kelas  
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Ubah Data kelas';
        $data['kelas'] = Kelas::findOrFail($id);
        $data['guru'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'guru');
        })->get();

        return view('kelas.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'wali_id' => 'required',
            'kelas' => 'required',
            'madrasah' => 'required',
        ];

        $customMessages = [
            'wali_id.required' => 'Field wali belum diisi!',
            'kelas.required' => 'Field kelas belum diisi!',
            'madrasah.required' => 'Field madrasah belum diisi!',
        ];

        $kelas = Kelas::findOrFail($id);
        
        $this->validate($request, $rules, $customMessages);

            $kelas->update([
                    'wali_id' => $request->wali_id,
                    'kelas' => $request->kelas,
                    'madrasah' => $request->madrasah,
                ]);
            return redirect('/kelas')->with('message', 'Data telah diubah');
        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect('/kelas')->with('message', 'Data telah dihapus');
    }
}
