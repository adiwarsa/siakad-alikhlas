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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Users</h4>
                            @can('users-create')
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></a>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                No.
                                            </th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Nama Pengguna</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1
                                        @endphp
                                        
                                        @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>
                                                @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $role)
                                                        <span class="badge badge-light">{{ $role }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @can('users-update')
                                                @if ($user->hasRole('guru'))
                                                    <a href="{{ route('guru.edit', ['id' => $user->id]) }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                                                @elseif ($user->hasRole('orangtua'))
                                                    <a href="{{ route('ortu.edit', ['id' => $user->id]) }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                                                @else
                                                    <a href="{{ url('/users/' .$user->id. '/edit') }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                                                @endif

                                                @endcan
                                                @can('users-delete')
                                                <button class="btn btn-icon btn-danger delete-user" data-toggle="modal" data-target="#data-modal-delete" data-id="{{ $user->id }}"><i class="fas fa-times"></i></button>
                                                @endcan
                                            </td>
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
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Buat User</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid mt-4">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <a href="{{ route('users.create') }}" class="btn btn-success">Admin</a>
                        </div>
                        <div class="col-md-4 text-center">
                            <a href="{{ route('guru.create') }}" class="btn btn-success">Guru</a>
                        </div>
                        <div class="col-md-4 text-center">
                            <a href="{{ route('ortu.create') }}" class="btn btn-success">Orang Tua</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="data-modal-delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="#">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus data ini?</p>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-danger btn-shadow">Ya</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
    <script>
        $('#datatable').on('click', '.delete-user', function(){
            let id = $(this).data('id');

            $('.modal-title').html('Hapus Data user');
            $('.modal-content form').attr('action', '{{ url('/users/') }}/' +id);
        });
    </script>
@endsection