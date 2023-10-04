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
            <h1>{{ $pageTitle }}</h1>
        </div>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    Kata sandi telah berhasil diatur ulang.
                </div>
            </div>
        @endif

        <div class="section-body">
        <section>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                      <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Total Guru</h4>
                      </div>
                      <div class="card-body">
                        {{ $guru }}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                      <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Total Santri</h4>
                      </div>
                      <div class="card-body">
                        {{ $santri }}
                      </div>
                    </div>
                  </div>
                </div>   
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                      <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Total Kelas</h4>
                      </div>
                      <div class="card-body">
                        {{ $kelas }}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                      <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Total Mata Pelajaran</h4>
                      </div>
                      <div class="card-body">
                        {{ $mapel }}
                      </div>
                    </div>
                  </div>
                </div>
        </section>
        @if(auth()->user()->hasRole('administrator'))
        <div class="card">
          <div class="card-header">
            <h4>Logs Login/Logout</h4>
          </div>
        <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped" id="datatable">
                                  <thead>
                                      <tr>
                                        <th class="text-center">
                                          No.
                                      </th>
                                      <th>Nama User</th>
                                      <th>Deskripsi</th>
                                      <th>Tanggal</th> 
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($logs as $log)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $log->user->name}}</td>
                                        <td>{{ $log->description}}</td>
                                        <td>{{ $log->created_at_formatted }}</td>
                
                                    </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        @endif
        @if(auth()->user()->hasRole('guru'))
        <div class="card">
          <div class="card-header">
            <h4>Jadwal Terkini</h4>
          </div>
        <div class="section-body">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped" id="datatable">
                                  <thead>
                                      <tr>
                                        <th class="text-center">
                                          No.
                                      </th>
                                      <th>Hari</th>
                                      <th>Pelajaran</th>
                                      <th>Kelas</th>
                                      <th>Tanggal</th>
                                      <th>Jam</th>
                                      <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($jadwal as $jdwl)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $jdwl->hari->nama_hari }}</td>
                                            @if ($jdwl->status == 0)
                                            <td><a href="{{ route('absen.create', ['id' => $jdwl->id]) }}" title="Klik untuk menambahkan santri yang absen">{{ $jdwl->mapel->nama }}</a></td>
                                            @else
                                            <td>{{ $jdwl->mapel->nama }}</td>
                                            @endif
                                            <td>{{ $jdwl->kelas->kelas }} || {{ $jdwl->kelas->madrasah }}</td>
                                            <td>{{ $jdwl->formatted_tanggal }} </td>
                                            <td>{{ $jdwl->jam_mulai }} - {{ $jdwl->jam_selesai }} </td>
                                            
                                            <td>
                                                <a class="badge bg-warning text-dark" data-toggle="modal" data-target="#exampleModal{{ $jdwl->id }}" title="Klik untuk merubah status jadwal">Belum Absen</a>
                                            </td> 
                                        @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        @endif
        @if(auth()->user()->hasRole('orangtua'))

        @endif


      @endsection

@section('script')
<!-- JS Libraies -->
<script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
@endsection