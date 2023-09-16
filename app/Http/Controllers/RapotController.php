<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\NilaiRapot;
use App\Models\Rapot;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Http\Request;

class RapotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = 'Rapot Santri';
        $data['kelas'] = Kelas::all();
        return view('rapot.index', $data);
    }

    public function listSantri($kelasId)
    {
        $data['pageTitle'] = 'Santri';
        // Retrieve the selected class
        $selectedClass = Kelas::findOrFail($kelasId);

        // Retrieve a list of students in the selected class
        $data['santri'] = Santri::where('id_kelas', $selectedClass->id)->get();

        $data['namakelas'] = $selectedClass->kelas;
        $data['kelasId'] = $selectedClass->id;
        return view('rapot.listsantri', $data);
    }

    public function createRapot($kelasId, $santriId)
    {
        $data['pageTitle'] = 'Create Rapot Santri';
        // Retrieve the selected class, student, and associated subjects
        $selectedClass = Kelas::findOrFail($kelasId);

        $data['wali'] = $selectedClass->wali_id;
        $data['santri'] = Santri::findOrFail($santriId);
        $data['mapels'] = MataPelajaran::where('id_kelas', $selectedClass->id)->get();
        return view('rapot.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeRapot(Request $request)
    {
        $request->validate([
            'santri_id' => 'required',
            'mapel_ids' => 'required|array',
            'nilaipengetahuans' => 'required|array',
            'nilaiketerampilans' => 'required|array',
            'predikatpengetahuans' => 'required|array',
            'predikatketerampilans' => 'required|array',
        ]);
    
        // Create a new Rapot
        $rapot = Rapot::create([
            'santri_id' => $request->santri_id,
            'wali_id' => $request->wali_id,
            'kelas_id' => $request->kelas_id,
            'semester' => 1,
        ]);
       
        // Loop through each mapel and create associated nilaiRapot records
        foreach ($request->mapel_ids as $index => $mapel_id) {
            // Calculate predikat based on nilai
            $nilaiPengetahuan = $request->nilaipengetahuans[$index];
            $nilaiKeterampilan = $request->nilaiketerampilans[$index];
        
            $predikatPengetahuan = '';
            $predikatKeterampilan = '';
        
            if ($nilaiPengetahuan >= 80) {
                $predikatPengetahuan = 'A';
            } elseif ($nilaiPengetahuan >= 70) {
                $predikatPengetahuan = 'B';
            } elseif ($nilaiPengetahuan >= 60) {
                $predikatPengetahuan = 'C';
            } else {
                $predikatPengetahuan = 'D';
            }
        
            if ($nilaiKeterampilan >= 80) {
                $predikatKeterampilan = 'A';
            } elseif ($nilaiKeterampilan >= 70) {
                $predikatKeterampilan = 'B';
            } elseif ($nilaiKeterampilan >= 60) {
                $predikatKeterampilan = 'C';
            } else {
                $predikatKeterampilan = 'D';
            }
        
            NilaiRapot::create([
                'rapot_id' => $rapot->id,
                'guru_id' => $request->wali_id,
                'mapel_id' => $mapel_id,
                'nilaipengetahuan' => $nilaiPengetahuan,
                'nilaiketerampilan' => $nilaiKeterampilan,
                'predikatpengetahuan' => $predikatPengetahuan,
                'predikatketerampilan' => $predikatKeterampilan,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
