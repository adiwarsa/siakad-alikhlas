@extends('layouts.app')

@section('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Detail Rapot</h3>
      </div>
      <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
                <table class="table" style="margin-top: -10px;">
                    <tr>
                        <td>No Induk Siswa</td>
                        <td>:</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>Nama Siswa</td>
                        <td>:</td>
                        <td>Kurcace</td>
                    </tr>
                    <tr>
                        <td>Nama Kelas</td>
                        <td>:</td>
                        <td>rawr</td>
                    </tr>
                    <tr>
                        <td>Wali Kelas</td>
                        <td>:</td>
                        <td>rawr</td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td>
                           
                                Semester Ganjil
                           

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
                            <th class="ctr" rowspan="2">No.</th>
                            <th rowspan="2">Mata Pelajaran</th>
                            <th class="ctr" colspan="3">Pengetahuan</th>
                            <th class="ctr" colspan="3">Keterampilan</th>
                        </tr>
                        <tr>
                            <th class="ctr">Nilai</th>
                            <th class="ctr">Predikat</th>
                            <th class="ctr">Deskripsi</th>
                            <th class="ctr">Nilai</th>
                            <th class="ctr">Predikat</th>
                            <th class="ctr">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                         
                                <tr>
                                    <td>1</td>
                                    <td>tarar</td>
                                   

                                    <td class="ctr">d</td>
                                    <td class="ctr">3</td>
                                    <td class="ctr">w</td>
                                    <td class="ctr">f</td>
                                    <td class="ctr">g</td>
                                    <td class="ctr">h</td>
                                </tr>

                    </tbody>
                </table>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
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
