@extends('layouts.app')

@section('style')
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
                    <span>&times;</span>
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
                            <h4>Jadwal Pelajaran Anak</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Santri</th>
                                            <th>Kelas</th>
                                            <th>Hari</th>
                                            <th>Pelajaran</th>
                                            <th>Guru</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($jadwalAnak as $row)
                                            @php
                                                $anak = $row['santri'];
                                                $jdwl = $row['jadwal'];
                                                $absensi = $jdwl->absensi->where('santri_id', $anak->id)->first();
                                                $keterangan = $absensi ? $absensi->keterangan : 'Hadir';
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $anak->nama }}</td>
                                                <td>{{ $jdwl->kelas->kelas }} || {{ $jdwl->kelas->madrasah }}</td>
                                                <td>{{ $jdwl->hari->nama_hari }}</td>
                                                <td>{{ $jdwl->mapel->nama }}</td>
                                                <td>{{ $jdwl->guru->name }}</td>
                                                <td>{{ $jdwl->formatted_tanggal }}</td>
                                                <td>{{ $jdwl->jam_mulai }} - {{ $jdwl->jam_selesai }}</td>
                                                <td>{{ $keterangan }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">Belum ada jadwal untuk santri.</td>
                                            </tr>
                                        @endforelse
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
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
@endsection
