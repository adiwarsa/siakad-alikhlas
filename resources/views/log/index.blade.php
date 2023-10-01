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

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Log Activity</h4>
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
                                            <th>Deskripsi</th>
                                            <th>Model</th>
                                            <th>Dilakukan</th>
                                            <th>Sebelum</th>
                                            <th>Sesudah</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($activity as $act)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $act->user->name}}</td>
                                            <td>{{ $act->description}}</td>
                                            <td>{{ $act->formatted_subject_type }}</td>
                                            <td>{{ $act->created_at_formatted }}</td>
                                            <td>
                                                @php
                                                $properties = json_decode($act->properties);
                                                @endphp
                                            
                                                
                                                @if (isset($properties->old))
                                                    @dump(json_decode($act->properties)->old)
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                $properties = json_decode($act->properties);
                                                @endphp
                                            
                                                @if (isset($properties->attributes))
                                                @dump(json_decode($act->properties)->attributes)
                                                @else
                                                    -
                                                @endif
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