@extends('layouts.app')

@section('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
        </div>

        @if(session('message'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                {{ session('message') }}
            </div>
        </div>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jadwal Pelajaran {{ auth()->user()->userDetail->anak->nama }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                No.
                                            </th>
                                            <th>Hari</th>
                                            <th>Pelajaran</th>
                                            <th>Guru</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Kehadiran</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1
                                        @endphp
                                        
                                        @foreach ($jadwal as $jdwl)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $jdwl->hari->nama_hari }}</td>
                                            <td>{{ $jdwl->mapel->nama }}</td>
                                            <td>{{ $jdwl->guru->name }}</td>
                                            <td>{{ $jdwl->formatted_tanggal }} </td>
                                            <td>{{ $jdwl->jam_mulai }} - {{ $jdwl->jam_selesai }} </td>
                                            @php
                                                $absensi = $jdwl->absensi->where('santri_id', auth()->user()->userDetail->anak->id)->first();
                                                $keterangan = $absensi ? $absensi->keterangan : 'Hadir';
                                            @endphp
                                            <td>{{ $keterangan }} </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
@endsection