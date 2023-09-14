@extends('layouts.app')

@section('style')
    <!-- CSS Libraries -->
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
          @forelse ($kelas as $kls)
            <div class="" style="background-color: white">
              <div class="card-body">
                <footer class="blockquote-footer">Wali : <cite title="Source Title">{{ $kls->guruwali->name }}</cite></footer>
                <blockquote class="d-flex">
                  <div class="flex-grow-1"> 
                   <p>{{ $kls->kelas }} - {{ $kls->madrasah }}</p>
                  </div>
                  <div class="ml-auto align-self-start"> 
                    <a href="#" class="btn btn-icon btn-danger">
                      <i class="">Lihat</i>
                    </a>
                  </div>
                </blockquote>
            </div>
            <hr>
          </div>
          @empty
          <div class="alert alert-warning">
              No classes found.
          </div>
          @endforelse
        </div>
        </div>
    </section>
@endsection

@section('script')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endsection