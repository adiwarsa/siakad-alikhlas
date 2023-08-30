<?php

namespace App\Http\Controllers;

use App\Models\AbsensiSantri;
use App\Models\Jadwal;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AbsenSantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $pageTitle = 'Absensi Santri';
       // Assuming $id is the ID of the Jadwal
        $jadwal = Jadwal::findOrFail($id);
        $id_kelas = $jadwal->kelas->id;

        $santri = Santri::where('id_kelas', $id_kelas)->get();

        // Rest of your code

        return view('absensantri.create', compact('santri', 'pageTitle', 'jadwal')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $santriIds = $request->santri_id;
        $keterangans = $request->keterangan;

        // Loop through each pair of santri_id and keterangan
        foreach ($santriIds as $index => $santriId) {
            $absensi = AbsensiSantri::create([
                'santri_id' => $santriId,
                'jadwal_id' => $id,
                'keterangan' => $keterangans[$index],
            ]);
        }

        // Update the status of the Jadwal to 1
        $jadwal = Jadwal::findOrFail($id);
        if ($jadwal) {
            $jadwal->status = 1;
            $jadwal->save();
        }

        // Redirect or return a response
        return redirect('/jadwal')->with('message', 'Absensi telah ditambahkan');

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
        $pageTitle = 'Edit Absensi Santri';
        // Assuming $id is the ID of the Jadwal
         $jadwal = Jadwal::findOrFail($id);

         $absensi = AbsensiSantri::where('jadwal_id', $id)->get();
         // Rest of your code
 
         return view('absensantri.edit', compact('absensi', 'pageTitle', 'jadwal')); 
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
        // Retrieve the record by jadwal_id
        $absensi = AbsensiSantri::where('jadwal_id', $id)->first();

        // Delete the record
        $absensi->delete();

        // Redirect to the edit route with the appropriate jadwal ID
        return Redirect::route('absen.edit', ['id' => $id])->with('message', 'Absen santri telah dihapus');
    }
}
