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
                <div class="breadcrumb-item"><a href="{{ url('/santri') }}">Santri</a></div>
                <div class="breadcrumb-item active">Ubah Data Santri</div>
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
                            <h4>Ubah Data Santri</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/santri/' .$santri->id) }}" class="needs-validation" novalidate="">
                                @method('patch')
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $santri->nama) }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                
                                    <label>NIS</label>
                                    <input name="nis" type="text" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis', $santri->nis) }}">
                                    @error('nis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control selectric @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                        <option value=""> -- Jenis Kelamin --</option>
                                        <option value="Laki - Laki" {{ old('jenis_kelamin', $santri->jenis_kelamin) === 'Laki - Laki' ? 'selected' : '' }}>Laki - Laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin', $santri->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                
                                    <label>Tempat Lahir</label>
                                    <input name="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir', $santri->tempat_lahir) }}">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                
                                    <label>Tanggal Lahir</label>
                                    <input name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $santri->tanggal_lahir) }}">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                
                                    <label>Kelas</label>
                                    <select class="form-control selectric @error('id_kelas') is-invalid @enderror" name="id_kelas">
                                        @foreach ($kelas as $kls)
                                        <option value="{{ $kls->id }}" {{ old('id_kelas', $santri->id_kelas) == $kls->id ? 'selected' : '' }}>Kelas : {{ $kls->kelas }} || Madrasah : {{ $kls->madrasah }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kelas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                
                                    <label>Tahun Masuk</label>
                                    <input name="tahun_masuk" type="text" class="form-control @error('tahun_masuk') is-invalid @enderror" value="{{ old('tahun_masuk', $santri->tahun_masuk) }}">
                                    @error('tahun_masuk')
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