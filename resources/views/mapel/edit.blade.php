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
                <div class="breadcrumb-item"><a href="{{ url('/mapel') }}">Mata Pelajaran</a></div>
                <div class="breadcrumb-item active">Ubah Data Mata Pelajaran</div>
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
                            <h4>Ubah Data Mata Pelajaran</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/mapel/' .$mapel->id) }}" class="needs-validation" novalidate="">
                                @method('patch')
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $mapel->nama) }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label>Jenjang</label>
                                        <select class="form-control selectric @error('jenjang') is-invalid @enderror" name="jenjang">
                                            <option value=""> -- Jenjang --</option>
                                            <option value="MA. AL-IKHLAS" {{ old('jenjang', $mapel->jenjang) === 'MA. AL-IKHLAS' ? 'selected' : '' }}>MA. AL-IKHLAS</option>
                                            <option value="MTs. AL-IKHLAS" {{ old('jenjang', $mapel->jenjang) === 'MTs. AL-IKHLAS' ? 'selected' : '' }}>MTs. AL-IKHLAS</option>
                                        </select>
                                        @error('jenjang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                        <label>Guru</label>
                                        <select class="form-control selectric @error('id_user') is-invalid @enderror" name="id_user">
                                            @foreach ($guru as $gr)
                                                <option value="{{ $gr->id }}" {{ old('id_user', $mapel->id_user) == $gr->id ? 'selected' : '' }}>{{ $gr->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_kelas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <label>Kode</label>
                                        <input name="kode" type="text" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode', $mapel->kode) }}">
                                         @error('kode')
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