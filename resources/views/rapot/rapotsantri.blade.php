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
        <h1>{{ $pageTitle }} {{ $rapot->kelas->kelas }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url()->previous() }}">Rapot Santri </a></div>
            <div class="breadcrumb-item active">Detail Rapot Santri</div>
        </div>
    </div>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Detail Rapot</h4>
            <a href="{{ route('exportraport.santri', ['santriId' => $rapot->santri_id, 'semester' => $rapot->semester]) }}" class="card-title" target="_blank">Download</a>
        </div>
      <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
                <table class="table" style="margin-top: -10px;">
                    <tr>
                        <td>No Induk Santri</td>
                        <td>:</td>
                        <td>{{ $rapot->santri->nis }}</td>
                    </tr>
                    <tr>
                        <td>Nama Siswa</td>
                        <td>:</td>
                        <td>{{ $rapot->santri->nama }}</td>
                    </tr>
                    <tr>
                        <td>Nama Kelas</td>
                        <td>:</td>
                        <td>{{ $rapot->kelas->kelas }} {{ $rapot->kelas->madrasah }}</td>
                    </tr>
                    <tr>
                        <td>Wali Kelas</td>
                        <td>:</td>
                        <td>{{ $rapot->guruwali->name }}</td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td>
                            {{ $rapot->semester }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tahun Pelajaran</td>
                        <td>:</td>
                        <td>
                           2022
                        </td>
                    </tr>
                </table>
                <hr>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="ctr" rowspan="3">No.</th>
                            <th rowspan="2">Mata Pelajaran</th>
                            <th class="ctr" colspan="4">Pengetahuan</th>
                            <th class="ctr" colspan="4">Keterampilan</th>
                        </tr>
                        <tr>
                            <th class="ctr">KKM</th>
                            <th class="ctr">Nilai</th>
                            <th class="ctr">Predikat</th>
                            <th class="ctr">Deskripsi</th>
                            <th class="ctr">KKM</th>
                            <th class="ctr">Nilai</th>
                            <th class="ctr">Predikat</th>
                            <th class="ctr">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($rapot->nilaiRapots as $index => $nilairapot)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $nilairapot->mapel->nama }}</td>
                            <td class="ctr">{{ $nilairapot->mapel->kkm }}</td>
                            <td class="ctr">{{ $nilairapot->nilaipengetahuan }}</td>
                            <td class="ctr">{{ $nilairapot->predikatpengetahuan }}</td>
                            <td class="ctr">{{ $nilairapot->getDeskripsiAttribute() }}</td> 
                            <td class="ctr">{{ $nilairapot->mapel->kkm }}</td>
                            <td class="ctr">{{ $nilairapot->nilaiketerampilan }}</td>
                            <td class="ctr">{{ $nilairapot->predikatketerampilan }}</td>
                            <td class="ctr">{{ $nilairapot->getDeskripsiAttribute() }}</td> 
                        </tr>
                    @empty
                        <td>
                            No Data Rapot
                        </td>
                    @endforelse
                    <tr>
                        <th colspan="11"></th>
                    </tr>
                        <tr>
                            <th class="ctr" colspan="3">Izin</th>
                            <th class="ctr" colspan="4">Sakit</th>
                            <th class="ctr" colspan="4">Alpha</th>
                        </tr>
                        <tr>
                            <td class="ctr" colspan="3">{{ $izin }} Hari</td>
                            <td class="ctr" colspan="4">{{ $sakit }} Hari</td>
                            <td class="ctr" colspan="4">{{ $alpha }} Hari</td>
                        </tr>
                </table>
                
            </div>
          </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</section>
<style>
    .ctr {
            text-align: center !important;
        }
        
        thead > tr > th, tbody > tr > td{
            vertical-align: middle !important;
        }
        th{
            border-bottom: 1px solid !important;
        }
        th, td{
            border-color: #a3a19d !important;
        }
        
</style>
@endsection
