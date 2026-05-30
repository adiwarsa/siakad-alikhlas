@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <style>
        .fontBold {
            font-weight: bold;
        }

        .centered {
            text-align: center;
        }
    </style>
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
                            <h4>Mata Pelajaran Anak</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Santri</th>
                                            <th>Nama Mapel</th>
                                            <th>Guru</th>
                                            <th>Kode</th>
                                            <th>Kelas</th>
                                            <th>Jenjang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mapelAnak as $row)
                                            @php
                                                $anak = $row['santri'];
                                                $mpl = $row['mapel'];
                                                $modalId = 'exampleModal' . $anak->id . '-' . $mpl->id;
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $anak->nama }}</td>
                                                <td>{{ $mpl->nama }}</td>
                                                <td>
                                                    <a href="" data-toggle="modal" data-target="#{{ $modalId }}" title="Klik untuk melihat data guru">{{ $mpl->user->name }}</a>
                                                </td>
                                                <td>{{ $mpl->kode }}</td>
                                                <td>{{ $anak->kelas->kelas }} || {{ $anak->kelas->madrasah }}</td>
                                                <td>{{ $mpl->jenjang }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Belum ada mata pelajaran untuk santri.</td>
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

    @foreach ($mapelAnak as $row)
        @php
            $anak = $row['santri'];
            $mpl = $row['mapel'];
            $modalId = 'exampleModal' . $anak->id . '-' . $mpl->id;
        @endphp
        <div class="modal fade bd-example-modal-lg" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $anak->id }}-{{ $mpl->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel{{ $anak->id }}-{{ $mpl->id }}">{{ $mpl->nama }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid mt-4">
                            <div class="table-responsive">
                                <table class="table table-bordered customTable">
                                    <tr>
                                        <td colspan="3" class="fontBold centered">Info Guru</td>
                                    </tr>
                                    <tr>
                                        <td class="fontBold centered">Nama</td>
                                        <td class="fontBold centered">Email</td>
                                        <td class="fontBold centered">No Hp</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $mpl->user->name }}</td>
                                        <td class="centered">{{ $mpl->user->email }}</td>
                                        <td>{{ optional($mpl->user->userDetail)->nohp }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="fontBold centered">Lebih Detail</td>
                                    </tr>
                                    <tr>
                                        <td class="fontBold">Nama Lengkap</td>
                                        <td colspan="2">{{ optional($mpl->user->userDetail)->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fontBold">No Induk</td>
                                        <td colspan="2">{{ optional($mpl->user->userDetail)->noinduk }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fontBold">Alamat</td>
                                        <td colspan="2">{{ optional($mpl->user->userDetail)->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fontBold">Tempat Lahir</td>
                                        <td colspan="2">{{ optional($mpl->user->userDetail)->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fontBold">Tanggal Lahir</td>
                                        <td colspan="2">{{ optional($mpl->user->userDetail)->tanggal_lahir }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
@endsection
