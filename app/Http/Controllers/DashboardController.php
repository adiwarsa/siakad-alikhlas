<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\LogActivity;
use App\Models\MataPelajaran;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {


        $data = [];
        $data['pageTitle'] = 'Dashboard';
        if (auth()->user()->hasRole('administrator')) {
            $data['guru'] = User::whereHas('roles', function ($query) {
                $query->where('name', 'guru');
            })->count();
            $data['santri'] = Santri::all()->count();
            $data['kelas'] = Kelas::all()->count();
            $data['mapel'] = MataPelajaran::all()->count();
            $data['logs'] = LogActivity::whereNull('event')->latest()->get();
        } elseif (auth()->user()->hasRole('guru')) {
            // Fetch Jadwal data where the kelas has guru_id matching the user's ID
            $guru = Auth::user();
            $data['guru'] = User::whereHas('roles', function ($query) {
                $query->where('name', 'guru');
            })->count();
            $data['santri'] = Santri::whereHas('kelas', function ($query) use ($guru) {
                $query->where('wali_id', $guru->id);
            })->count();
            $data['kelas'] = Kelas::where('wali_id', $guru->id)->count();
            $data['mapel'] = MataPelajaran::where('id_user', $guru->id)->count();
            $data['jadwal'] = Jadwal::where('guru_id', $guru->id)->where('status', 0)->get();
        } elseif (auth()->user()->hasRole('orangtua')) {
            $ortu = Auth::user();
            $idsantri = $ortu->userDetail->santri_id;
            $data['santri'] = Santri::where('id', $idsantri)->first();
            $data['jadwal'] = Jadwal::whereHas('kelas', function ($query) use ($ortu) {
                $query->where('id', $ortu->userDetail->anak->id_kelas);
            })
            ->where('status', 0)
            ->get();
            return view('dashboardortu', $data);
        }
        return view('dashboard', $data);
    }
}
