@extends('template.master')

@section('page-title', 'Halaman utama')
@section('sub-title', 'Home')
@push('page-link')
    <a href="{{ route('dashboard.index') }}">Halaman utama</a>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dist/morris.css') }}">
@endpush
{{-- col-sm-offset-3 --}}
@section('content')
    <div class="row">
        @can('admin')
        @foreach (listData()['list'] as $key => $item)
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim">{{countData($item)}}</span></span>
                                        <span class="weight-500 uppercase-font block font-13">{{$item}}</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="{{listData()['icons'][$key]}} data-right-rep-icon txt-light-grey"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endcan

        @can('siswa')
        <div class="col-6 col-offset-3 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('assets/image/logo.png') }}" alt="User Image" width="100px">
                    </div>
                    <h3 class="text-center">Selamat datang, {{auth()->user()->nama}}</h3>
                </div>
            </div>
        @endcan
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/dist/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/js/dist/morris.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
@endpush
