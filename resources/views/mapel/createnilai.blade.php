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
                <div class="breadcrumb-item"><a href="{{ url('/jadwal') }}">KKM Nilai Mata Pelajaran</a></div>
                <div class="breadcrumb-item active">Tambah KKM</div>
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
                            <h4>KKM Nilai {{ $mapel->nama }} </h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('nilai.store', ['id' => $id]) }}" class="needs-validation" novalidate="">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="descpredikata">Predikat A</label>
                                                <input name="descpredikata" type="text" class="form-control @error('descpredikata') is-invalid @enderror" value="{{ old('descpredikata') }}">
                                                    @error('descpredikata')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="descpredikatb">Predikat B</label>
                                                <input name="descpredikatb" type="text" class="form-control @error('descpredikatb') is-invalid @enderror" value="{{ old('descpredikatb') }}">
                                                    @error('descpredikatb')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="descpredikatc">Predikat C</label>
                                                <input name="descpredikatc" type="text" class="form-control @error('descpredikatc') is-invalid @enderror" value="{{ old('descpredikatc') }}">
                                                    @error('descpredikatc')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="descpredikatd">Predikat D</label>
                                                <input name="descpredikatd" type="text" class="form-control @error('descpredikatd') is-invalid @enderror" value="{{ old('descpredikatd') }}">
                                                    @error('descpredikatd')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
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