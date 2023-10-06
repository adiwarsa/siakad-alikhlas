
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $pageTitle }} &mdash; {{ config('app.name') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">


    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <style>
        .card-primary{
            border: none !important;
        }
        .main-contents{
            padding-left: 30px;
            padding-right: 30px;
            padding-top: 50px;
            width: 100%;
            position: relative;
        }
    </style>
</head>

<body>
            <!-- Main Content -->
            <div class="main-contents">
                <section class="section">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                      <!-- /.card-header -->
                        <div class="card-body">
                          <div class="row">
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
            </div>
            

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        // Wait for the page to fully load
        window.addEventListener('load', function() {
            // Open the print dialog
            window.print();
        });
    </script>
</body>
</html>