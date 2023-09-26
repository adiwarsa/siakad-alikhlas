@extends('layouts.app')

@section('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('/jadwal') }}">Absensi Santri</a></div>
                <div class="breadcrumb-item active">Edit Absensi Santri</div>
            </div>
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
                <div class="col-12 col-md-2"></div>
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Absensi Santri <br>
                                Guru : {{ $jadwal->guru->name }} <br>
                                Kelas : {{ $jadwal->mapel->nama }} || {{ $jadwal->formatted_tanggal }}</h4>
                            </div>
                        <div class="card-body">
                                <div class="container">
                                    @forelse ($absensi as $absen)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="santri">Santri</label>
                                                    <input class="form-control" value="{{ $absen->santri->nama }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="keterangan">Keterangan</label>
                                                    <input class="form-control" value="{{ $absen->keterangan }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-1 mt-4">
                                                <button class="btn btn-icon btn-danger delete-absen" data-toggle="modal" data-target="#data-modal-delete" data-id="{{ $absen->id }}"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                    @empty
                                    <div class="row">
                                        <div class="col content-center">
                                            <div class="text-center">
                                                <p>Hadir Semua</p>
                                            </div>
                                            <div>
                                                <p>Ubah Status Jadwal : 
                                                    <a href="" class="badge bg-danger text-dark" data-toggle="modal" data-target="#exampleModal{{ $jadwal->id }}" title="Klik untuk merubah status jadwal">Belum Diabsen</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="exampleModal{{ $jadwal->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $jadwal->id }}" aria-hidden="true" data-backdrop="false">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Status Jadwal ke Belum Diabsen ?</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid mt-4">
                                                        <div class="row">
                                                            <!-- Center-align the button -->
                                                            <div class="col-12 d-flex justify-content-center">
                                                                <form action="{{  route('jadwal.updatestatus',['id'=>$jadwal->id,'status'=>0])}}" method="POST">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="text" name="id" value="{{ $jadwal->id }}" hidden>
                                                                    <button type="submit" class="btn btn-danger">Belum Diabsen</button>
                                                                </form>
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
                                    @endforelse
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
                <form method="post" action="#" id="delete-form"> <!-- Give the form an ID -->
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
    <script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/auth-register.js') }}"></script>

    <script>
        $('#datatable').on('click', '.delete-absen', function() {
            let id = $(this).data('id');
            let form = $('#delete-form'); // Use the ID of the form
    
            form.attr('action', '{{ route('absen.destroy', '') }}/' + id);
            form.find('input[name="_method"]').val('DELETE');
        });
    </script>
@endsection