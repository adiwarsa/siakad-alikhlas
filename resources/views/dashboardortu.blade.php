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
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Dashboard Orang Tua</div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Detail Santri</h4>
            </div>
            <div class="card-body">
                @forelse ($santri as $anak)
                    <div class="table-responsive mb-4">
                        <table class="table" style="margin-top: -10px;">
                            <tr>
                                <td>No Induk Santri</td>
                                <td>:</td>
                                <td>{{ $anak->nis }}</td>
                            </tr>
                            <tr>
                                <td>Nama Santri</td>
                                <td>:</td>
                                <td>{{ $anak->nama }}</td>
                            </tr>
                            <tr>
                                <td>Nama Kelas</td>
                                <td>:</td>
                                <td>{{ $anak->kelas->kelas }} {{ $anak->kelas->madrasah }}</td>
                            </tr>
                            <tr>
                                <td>Wali Kelas</td>
                                <td>:</td>
                                <td>{{ $anak->kelas->guruwali->name }}</td>
                            </tr>
                            <tr>
                                <td>Tahun Pelajaran</td>
                                <td>:</td>
                                <td>{{ $anak->tahun_masuk }}</td>
                            </tr>
                        </table>
                    </div>
                @empty
                    <div class="alert alert-warning mb-0">Belum ada santri yang terhubung dengan akun ini.</div>
                @endforelse

                <hr>

                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Santri</th>
                                <th>Hari</th>
                                <th>Pelajaran</th>
                                <th>Guru</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwalAnak as $row)
                                @php
                                    $anak = $row['santri'];
                                    $jdwl = $row['jadwal'];
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $anak->nama }}</td>
                                    <td>{{ $jdwl->hari->nama_hari }}</td>
                                    <td>{{ $jdwl->mapel->nama }}</td>
                                    <td>{{ $jdwl->guru->name }}</td>
                                    <td>{{ $jdwl->kelas->kelas }} || {{ $jdwl->kelas->madrasah }}</td>
                                    <td>{{ $jdwl->formatted_tanggal }}</td>
                                    <td>{{ $jdwl->jam_mulai }} - {{ $jdwl->jam_selesai }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada jadwal aktif untuk santri.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .ctr {
        text-align: center !important;
    }

    thead > tr > th, tbody > tr > td {
        vertical-align: middle !important;
    }

    th {
        border-bottom: 1px solid !important;
    }

    th, td {
        border-color: #a3a19d !important;
    }
</style>
@endsection

@section('script')
<script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
@endsection
