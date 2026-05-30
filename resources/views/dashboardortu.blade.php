@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <style>
        .parent-summary .card-statistic-1 {
            height: calc(100% - 30px);
        }

        .parent-summary .card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .child-card {
            border: 1px solid #edf0f5;
            box-shadow: 0 4px 18px rgba(24, 38, 75, .05);
            height: calc(100% - 30px);
        }

        .child-card .card-header {
            align-items: center;
            border-bottom: 1px solid #edf0f5;
            min-height: 76px;
        }

        .child-avatar {
            align-items: center;
            background: #eef2ff;
            border-radius: 8px;
            color: #6777ef;
            display: flex;
            flex: 0 0 44px;
            font-size: 18px;
            height: 44px;
            justify-content: center;
            margin-right: 14px;
            width: 44px;
        }

        .child-title {
            min-width: 0;
        }

        .child-title h4 {
            font-size: 15px;
            line-height: 1.35;
            margin-bottom: 4px;
            overflow-wrap: anywhere;
        }

        .child-title .text-muted {
            font-size: 12px;
        }

        .info-list {
            margin-bottom: 0;
        }

        .info-list .list-group-item {
            align-items: flex-start;
            border-color: #edf0f5;
            display: flex;
            gap: 16px;
            justify-content: space-between;
            padding: 12px 0;
        }

        .info-list .list-group-item:first-child {
            padding-top: 0;
        }

        .info-list .list-group-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .info-list .label {
            color: #6c757d;
            flex: 0 0 94px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0;
            text-transform: uppercase;
        }

        .info-list .value {
            color: #34395e;
            font-weight: 600;
            min-width: 0;
            overflow-wrap: anywhere;
            text-align: right;
        }

        .schedule-card .card-header {
            align-items: center;
            justify-content: space-between;
        }

        .schedule-table thead th {
            border-bottom: 0;
            font-size: 12px;
            letter-spacing: 0;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .schedule-table td {
            vertical-align: middle;
        }

        .student-pill {
            align-items: center;
            display: inline-flex;
            font-weight: 600;
            gap: 8px;
            min-width: 160px;
        }

        .student-pill i {
            color: #6777ef;
        }

        @media (max-width: 575.98px) {
            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .section-header-breadcrumb {
                margin-top: 8px;
            }

            .child-card .card-header {
                min-height: auto;
            }

            .info-list .list-group-item {
                display: block;
            }

            .info-list .value {
                display: block;
                margin-top: 4px;
                text-align: left;
            }
        }
    </style>
@endsection

@section('content')
    @php
        $totalAnak = $santri->count();
        $totalJadwal = $jadwalAnak->count();
        $totalKelas = $santri->pluck('id_kelas')->filter()->unique()->count();
        $totalWali = $santri->pluck('kelas.wali_id')->filter()->unique()->count();
    @endphp

    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">Dashboard Orang Tua</div>
            </div>
        </div>

        <div class="row parent-summary">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Anak</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalAnak }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-calendar-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jadwal Aktif</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalJadwal }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-school"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kelas Anak</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalKelas }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Wali Kelas</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalWali }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-title mt-0">Biodata Anak</div>
        <div class="row">
            @forelse ($santri as $anak)
                @php
                    $kelas = optional($anak->kelas);
                    $waliKelas = optional($kelas->guruwali)->name ?: '-';
                    $namaKelas = trim(($kelas->kelas ?: '-') . ' ' . ($kelas->madrasah ?: ''));
                @endphp
                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                    <div class="card child-card">
                        <div class="card-header">
                            <div class="child-avatar">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="child-title">
                                <h4>{{ $anak->nama }}</h4>
                                <span class="text-muted">NIS {{ $anak->nis }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush info-list">
                                <li class="list-group-item">
                                    <span class="label">Kelas</span>
                                    <span class="value">{{ $namaKelas }}</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="label">Wali</span>
                                    <span class="value">{{ $waliKelas }}</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="label">Tahun</span>
                                    <span class="value">{{ $anak->tahun_masuk ?: '-' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning mb-4">
                        Belum ada santri yang terhubung dengan akun ini.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="card schedule-card">
            <div class="card-header">
                <h4>Jadwal Aktif Anak</h4>
                <span class="badge badge-primary">{{ $totalJadwal }} Jadwal</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped schedule-table" id="datatable">
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
                                    <td>
                                        <span class="student-pill">
                                            <i class="fas fa-user-graduate"></i>
                                            {{ $anak->nama }}
                                        </span>
                                    </td>
                                    <td>{{ optional($jdwl->hari)->nama_hari ?: '-' }}</td>
                                    <td>{{ optional($jdwl->mapel)->nama ?: '-' }}</td>
                                    <td>{{ optional($jdwl->guru)->name ?: '-' }}</td>
                                    <td>{{ optional($jdwl->kelas)->kelas }} {{ optional($jdwl->kelas)->madrasah }}</td>
                                    <td>
                                        <span class="badge badge-light">
                                            {{ $jdwl->formatted_tanggal ?: '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $jdwl->jam_mulai }} - {{ $jdwl->jam_selesai }}
                                        </span>
                                    </td>
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
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
@endsection
