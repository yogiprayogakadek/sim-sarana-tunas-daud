@extends('template.master')

@section('page-title', 'Pengembalian')
@section('sub-title', 'List')


@section('content')
    <div class="row printableArea">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-heading mb-30">
                        <div class="pull-left">
                            <img src="{{ asset('assets/image/logo.png') }}" class="inline-block" width="150px">
                        </div>
                        <div class="pull-right">
                            <h3>Data Pengembalian</h3>
                            <span>Tanggal dicetak: {{ date('d-m-Y H:i:s') }}</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <h3 class="text-center">Laporan Pengembalian</h3>
                        <p class="text-center">{{$kategori == 'Semua' ? '' : $startTime.' s/d ' . $endTime }}</p>
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tangal Pengembalian</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengembalian as $pengembalian)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date_format(date_create($pengembalian->tanggal), 'd-m-Y') }}</td>
                                                <td>{{ $pengembalian->keterangan }}</td>
                                                <td>{{ $pengembalian->status }}</td>
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
    </div>
@endsection
