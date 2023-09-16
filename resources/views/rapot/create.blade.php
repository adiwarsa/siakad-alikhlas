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
                <div class="breadcrumb-item"><a href="{{ route('list.santri', ['kelasId' => $santri->id_kelas]) }}">Rapot Santri</a></div>
                <div class="breadcrumb-item active">Tambah Nilai Rapot Santri</div>
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

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                {{ session('error') }}
            </div>
        </div>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-2"></div>
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Rapot Santri {{ $santri->nama }} </h4> 
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('storerapot.santri', ['kelasId' => $santri->id_kelas, 'santriId' => $santri->id]) }}" class="needs-validation" novalidate="">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <label>Semester</label>
                                            <select class="form-control selectric @error('semester') is-invalid @enderror" name="semester">
                                                <option value=""> -- Semester --</option>
                                                <option value="1" {{ old('semester') === '1' ? 'selected' : '' }}> Semester 1</option>
                                                <option value="2" {{ old('semester') === '2' ? 'selected' : '' }}>Semester 2</option>
                                            </select>
                                            @error('semester')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input name="santri_id" type="hidden" value="{{ $santri->id }}">
                                        <input name="wali_id" type="hidden" value="{{ $wali }}">
                                        <input name="kelas_id" type="hidden" value="{{ $santri->id_kelas }}">
                                        @foreach ($mapels as $mapel)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mapel">Mata Pelajaran</label>
                                                <input name="mapel_ids[]" type="hidden" value="{{ $mapel->id }}">
                                                <input type="text" class="form-control" value="{{ $mapel->nama }}" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nilaipengetahuan">Nilai Pengetahuan</label>
                                                <input name="nilaipengetahuans[]" type="number" class="form-control @error('nilaipengetahuans.*') is-invalid @enderror" value="{{ old('nilaipengetahuans.' . $loop->index) }}" autocomplete="off">
                                                @error('nilaipengetahuans.*')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nilaiketerampilan">Nilai Keterampilan</label>
                                                <input name="nilaiketerampilans[]" type="number" class="form-control @error('nilaiketerampilans.*') is-invalid @enderror" value="{{ old('nilaiketerampilans.' . $loop->index) }}" autocomplete="off">
                                                @error('nilaiketerampilans.*')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
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