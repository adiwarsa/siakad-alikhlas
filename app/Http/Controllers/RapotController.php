<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
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

    public function rapotsantri()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pageTitle = 'Create Rapot Santri';
        // Retrieve the Santri for whom you want to create Rapot
        $santri = Santri::find($request->id);
        // Retrieve the subjects associated with the Santri's class
        $mapel = $santri->kelas->mapels;
        @dd($mapel);
        return view('rapot.index', compact('santri', 'mapel', 'pageTitle'));
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
