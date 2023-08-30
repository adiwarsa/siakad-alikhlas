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
                <div class="breadcrumb-item"><a href="{{ url('/jadwal') }}">Jadwal Pelajaran</a></div>
                <div class="breadcrumb-item active">Ubah Data Jadwal Pelajaran</div>
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
                            <h4>Ubah Data Jadwal Pelajaran</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/jadwal/' .$jadwal->id) }}" class="needs-validation" novalidate="">
                                @method('patch')
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Hari</label>
                                        <select class="form-control selectric @error('hari_id') is-invalid @enderror" name="hari_id">
                                            @foreach ($hari as $hr)
                                            <option value="{{ $hr->id }}" {{ old('hari_id', $jadwal->hari_id) == $hr->id ? 'selected' : '' }}>{{ $hr->nama_hari }}</option>
                                            @endforeach
                                        </select>
                                        @error('hari_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label>Kelas</label>
                                        <select class="form-control selectric @error('kelas_id') is-invalid @enderror" name="kelas_id">
                                            @foreach ($kelas as $kls)
                                            <option value="{{ $kls->id }}" {{ old('kelas_id', $jadwal->kelas_id) == $kls->id ? 'selected' : '' }}>{{ $kls->kelas }} {{ $kls->madrasah }}</option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label>Mata Pelajaran</label>
                                        <select class="form-control selectric @error('mapel_id') is-invalid @enderror" name="mapel_id">
                                            @foreach ($mapel as $mpl)
                                            <option value="{{ $mpl->id }}" {{ old('mapel_id', $jadwal->mapel_id) == $mpl->id ? 'selected' : '' }}>{{ $mpl->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('mapel_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label>Tanggal</label>
                                        <input name="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $jadwal->tanggal) }}">
                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label>Jam Mulai</label>
                                        <input name="jam_mulai" type="time" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}">
                                        @error('jam_mulai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label>Jam Selesai</label>
                                        <input name="jam_selesai" type="time" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}">
                                        @error('jam_selesai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
@endsection

@section('script')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/auth-register.js') }}"></script>
@endsection