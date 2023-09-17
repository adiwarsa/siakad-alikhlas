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
            <h1>{{ $pageTitle }} {{ $namakelas }}</h1>
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
                            <h4>Data Santri</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('rapot.index') }}" class="btn btn-icon btn-primary"><i class="">Kembali</i></a>
                                </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                No.
                                            </th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>TTL</th>
                                            <th>Kelas</th>
                                            <th>Madrasah</th>
                                            <th>Tahun Masuk</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1
                                        @endphp
                                        
                                        @foreach ($santri as $str)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $str->nis }}</td>
                                            <td>
                                                <a href="" data-toggle="modal" data-target="#exampleModal{{ $str->id }}">
                                                    {{ $str->nama }}
                                                </a>
                                            </td>
                                            <td>{{ $str->jenis_kelamin }}</td>
                                            <td>{{ $str->tempat_lahir }}, {{ $str->formatted_tanggal_lahir }}</td>
                                            <td>{{ $str->kelas->kelas}}</td>
                                            <td>{{ $str->kelas->madrasah}}</td>
                                            <td>{{ $str->tahun_masuk}}</td>
                                            <td>
                                                <a href="{{ route('createrapot.santri', ['kelasId' => $kelasId, 'santriId' => $str->id]) }}" class="btn btn-icon btn-warning"><i class="">Buat</i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $str->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $str->id }}" aria-hidden="true" data-backdrop="false">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Lihat Rapot : {{ $str->nama }}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid mt-4">
                                                        <div class="row">
                                                            <div class="col-md-6 text-center">
                                                                <a href="{{ route('showrapot.santri', ['santriId' => $str->id, 'semester' => '1']) }}" class="btn btn-success">Semester 1</a>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <a href="{{ route('showrapot.santri', ['santriId' => $str->id, 'semester' => '2']) }}" class="btn btn-success">Semester 2</a>
                                                            </div>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="data-modal-delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="#">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus data ini?</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-danger btn-shadow">Ya</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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