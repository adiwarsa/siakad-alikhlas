<?php

namespace App\Http\Controllers;

use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $data = [];
        if (auth()->user()->hasRole('administrator')) {
            // Fetch all Jadwal data
            $data['pageTitle'] = 'Jadwal Pelajaran';
            $data['jadwal'] = Jadwal::all();
        } elseif (auth()->user()->hasRole('guru')) {
            // Fetch Jadwal data where the kelas has guru_id matching the user's ID
            $data['pageTitle'] = 'Jadwal Pelajaran';
            $data['jadwal'] = Jadwal::whereHas('kelas', function ($query) {
                $query->where('guru_id', auth()->user()->id);
            })->get();
        } elseif (auth()->user()->hasRole('orangtua')) {
            // Fetch Jadwal data where kelas_id matches the user's userDetail->santri_id
            $data['pageTitle'] = 'Jadwal Pelajaran';
            $user = auth()->user();
            $data['jadwal'] = Jadwal::whereHas('kelas', function ($query) use ($user) {
                $query->where('id', $user->userDetail->anak->id_kelas);
            })->get();
            return view('orangtua.jadwal.index', $data);
        }
        
        return view('jadwal.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Tambah Data Jadwal Pelajaran';
        $data['hari'] = Hari::all();
        $data['kelas'] = Kelas::all();
        $data['mapel'] = MataPelajaran::all();

        return view('jadwal.create', $data);
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
            'hari_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'jam_mulai' => 'required', 
            'jam_selesai' => 'required',
            'tanggal' => 'required',
            'semester' => 'required'
        ];

        $customMessages = [
            'hari_id.required' => 'Field hari belum diisi!',
            'kelas_id.required' => 'Field kelas belum diisi!',
            'mapel_id.required' => 'Field mapel belum diisi!',
            'jam_mulai.required' => 'Field jam mulai belum diisi!',
            'jam_selesai.required' => 'Field jam selesai belum diisi!',
            'tanggal.required' => 'Field tanggal belum diisi!',
            'semester.required' => 'Field semester belum diisi!'
        ];

        $this->validate($request, $rules, $customMessages);
        $id_mapel = $request->mapel_id;
        $matapelajaran = MataPelajaran::where('id', $id_mapel)->first();
        $id_guru = $matapelajaran->id_user;

        $interval = $request->input('interval'); // The chosen interval (6 months or 1 year)
        $startDate = Carbon::parse($request->input('tanggal'));
        $endDate = $startDate->copy()->addMonths($interval);
        
        $jadwalRecords = [];
        
        while ($startDate->lt($endDate)) {
            $jadwalRecords[] = [
                'hari_id' => $request->input('hari_id'),
                'kelas_id' => $request->input('kelas_id'),
                'mapel_id' => $request->input('mapel_id'),
                'guru_id' => $id_guru, 
                'jam_mulai' => $request->input('jam_mulai'),
                'jam_selesai' => $request->input('jam_selesai'),
                'tanggal' => $startDate->format('Y-m-d'),
                'status' => 0,
                'semester' => $request->input('semester'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            $startDate->addWeek(); // Add a week to the current date
        }

        Jadwal::insert($jadwalRecords);
        return redirect('/jadwal')->with('message', 'Data telah ditambahkan');
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
        $data['pageTitle'] = 'Tambah Data Jadwal Pelajaran';
        $data['jadwal'] = Jadwal::findOrFail($id);
        $data['hari'] = Hari::all();
        $data['kelas'] = Kelas::all();
        $data['mapel'] = MataPelajaran::all();

        return view('jadwal.edit', $data);
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
            'hari_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'jam_mulai' => 'required', 
            'jam_selesai' => 'required',
            'tanggal' => 'required',
            'semester' => 'required'
        ];


        $customMessages = [
            'hari_id.required' => 'Field hari belum diisi!',
            'kelas_id.required' => 'Field kelas belum diisi!',
            'mapel_id.required' => 'Field mapel belum diisi!',
            'jam_mulai.required' => 'Field jam mulai belum diisi!',
            'jam_selesai.required' => 'Field jam selesai belum diisi!',
            'tanggal.required' => 'Field tanggal belum diisi!',
            'semester.required' => 'Field semester belum diisi!'
        ];

        $jadwal = Jadwal::findOrFail($id);
        $this->validate($request, $rules, $customMessages);
        $id_mapel = $request->mapel_id;
        $matapelajaran = MataPelajaran::where('id', $id_mapel)->first();
        $id_guru = $matapelajaran->id_user;
        // $guru = User::where('id', $id_guru);
        // $namaguru = $guru->name;
        $jadwal->update([
            'hari_id' => $request->hari_id,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'guru_id' => $id_guru,
            'jam_mulai' => $request->jam_mulai, 
            'jam_selesai' => $request->jam_selesai,
            'tanggal' => $request->tanggal,
            'semester' => $request->semester
        ]);
        return redirect('/jadwal')->with('message', 'Data telah ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect('/jadwal')->with('message', 'Data telah dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $currenttime = Carbon::Now();
        $jadwal->update([
            'status' => $request->status,
            'updated_at' => $currenttime,
        ]);
        return redirect('/jadwal')->with('message', 'Status Data Jadwal Berhasil Diubah');
    }
}
