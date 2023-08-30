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
                <div class="breadcrumb-item"><a href="{{ url('/jadwal') }}">Jadwal Santri</a></div>
                <div class="breadcrumb-item active">Tambah Absensi Santri</div>
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
                            <h4>Absensi Santri {{ $jadwal->mapel->nama }} || {{ $jadwal->formatted_tanggal }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('absensisantri', $jadwal->id) }}" class="needs-validation" novalidate="">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="santri">Santri</label>
                                                <select class="form-control selectric @error('santri_id') is-invalid @enderror" name="santri_id[]">
                                                    @foreach ($santri as $str)
                                                    <option value="{{ $str->id }}" {{ old('santri_id', $str->id) == $str->id ? 'selected' : '' }}>{{ $str->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('santri_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <select class="form-control" id="keterangan" name="keterangan[]">
                                                    <option value="Sakit">Sakit</option>
                                                    <option value="Izin">Izin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="dynamic-fields">
                                        <!-- Dynamic input fields will be added here -->
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" id="add-field-button">Add Field</button>
                                </div>
                            </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addButton = document.getElementById('add-field-button');
            const dynamicFields = document.querySelector('.dynamic-fields');
            const rowTemplate = `
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="santri">Santri</label>
                            <select class="form-control selectric @error('santri_id') is-invalid @enderror" name="santri_id[]">
                                @foreach ($santri as $str)
                                <option value="{{ $str->id }}" {{ old('santri_id', $str->id) == $str->id ? 'selected' : '' }}>{{ $str->nama }}</option>
                                @endforeach
                            </select>
                            @error('santri_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <select class="form-control" id="keterangan" name="keterangan[]">
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-field-button">Remove</button>
                    </div>
                </div>
            `;
    
            addButton.addEventListener('click', function() {
                dynamicFields.insertAdjacentHTML('beforeend', rowTemplate);
            });
    
            dynamicFields.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-field-button')) {
                    const row = event.target.closest('.row');
                    if (row) {
                        row.remove();
                    }
                }
            });
        });
    </script>
@endsection