@extends('layouts.app')

@section('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <style>
        .fontBold{
            font-weight: bold;
        }
        .centered{
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
                            <h4>Mata Pelajaran {{  auth()->user()->userDetail->anak->nama }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                No.
                                            </th>
                                            <th>Nama Mapel</th>
                                            <th>Guru</th>
                                            <th>Kode</th>
                                            <th>Kelas</th>
                                            <th>Jenjang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mapel as $mpl)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $mpl->nama }}</td>
                                            <td>
                                            <a  href="" data-toggle="modal" data-target="#exampleModal{{ $mpl->id }}" title="Klik untuk Melihat data guru">{{ $mpl->user->name }}</a>
                                            </td>

                                            <td>{{ $mpl->kode }}</td>
                                            <td>{{ $mpl->kelas->kelas }} </td>
                                            <td>{{ $mpl->jenjang }} </td>
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

    @foreach ($mapel as $mpl)
    <div class="modal fade bd-example-modal-lg" id="exampleModal{{ $mpl->id }}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel{{ $mpl->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $mpl->nama }}</h5>
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
                                    <td>{{ $mpl->user->userDetail->nohp }}</td>
                                </tr> 
                            <tr>
                                <td colspan="3" class="fontBold centered">Lebih Detail</td>
                            </tr>
                                <tr>
                                <td class="fontBold">Nama Lengkap</td>
                                <td colspan="2">{{ $mpl->user->userDetail->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td class="fontBold">No Induk</td>
                                <td colspan="2">{{ $mpl->user->userDetail->noinduk }}</td>
                            </tr>
                            <tr>
                                <td class="fontBold">Alamat</td>
                                <td colspan="2"> 
                                    {{ $mpl->user->userDetail->alamat }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fontBold">Tempat Lahir</td>
                                <td colspan="2"> 
                                    {{ $mpl->user->userDetail->tempat_lahir }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fontBold">Tanggal Lahir</td>
                                <td colspan="2">
                                {{ $mpl->user->userDetail->tanggal_lahir }}
                                </td>
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
    <script>
        $('#datatable').on('click', '.delete-mapel', function(){
            let id = $(this).data('id');

            $('.modal-title').html('Hapus Data Mapel');
            $('.modal-content form').attr('action', '{{ url('/mapel/') }}/' +id);
        });
    </script>
@endsection