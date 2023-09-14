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
            <div class="" style="background-color: white">
              <div class="card-body">
                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                <blockquote class="d-flex">
                  <div class="flex-grow-1"> 
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
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

          <div class="" style="background-color: white">
            <div class="card-body">
              <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
              <blockquote class="d-flex">
                <div class="flex-grow-1"> 
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
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
        </div>
    </section>
@endsection

@section('script')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endsection