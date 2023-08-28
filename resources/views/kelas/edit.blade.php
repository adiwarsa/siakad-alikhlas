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
                <div class="breadcrumb-item"><a href="{{ url('/kelas') }}">Kelas</a></div>
                <div class="breadcrumb-item active">Ubah Data Kelas</div>
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
                            <h4>Ubah Kelas</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/kelas/' .$kelas->id) }}" class="needs-validation" novalidate="">
                                @method('patch')
                                @csrf
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select class="form-control selectric @error('kelas') is-invalid @enderror" name="kelas">
                                        <option value=""> -- Kelas --</option>
                                        <option value="VII" {{ old('kelas', $kelas->kelas) === 'VII' ? 'selected' : '' }}>VII</option>
                                        <option value="VIII" {{ old('kelas', $kelas->kelas) === 'VIII' ? 'selected' : '' }}>VIII</option>
                                        <option value="IX" {{ old('kelas', $kelas->kelas) === 'IX' ? 'selected' : '' }}>IX</option>
                                        <option value="X" {{ old('kelas', $kelas->kelas) === 'X' ? 'selected' : '' }}>X</option>
                                        <option value="XI" {{ old('kelas', $kelas->kelas) === 'XI' ? 'selected' : '' }}>XI</option>
                                        <option value="XII" {{ old('kelas', $kelas->kelas) === 'XII' ? 'selected' : '' }}>XII</option>

                                    </select>
                                    @error('kelas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Madrasah</label>
                                    <select class="form-control selectric @error('madrasah') is-invalid @enderror" name="madrasah">
                                        <option value=""> -- Madrasah --</option>
                                        <option value="MA. AL-IKHLAS" {{ old('madrasah', $kelas->madrasah) === 'MA. AL-IKHLAS' ? 'selected' : '' }}>MA. AL-IKHLAS</option>
                                        <option value="MTs. AL-IKHLAS" {{ old('madrasah', $kelas->madrasah) === 'MTs. AL-IKHLAS' ? 'selected' : '' }}>MTs. AL-IKHLAS</option>
                                    </select>
                                    @error('madrasah')
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