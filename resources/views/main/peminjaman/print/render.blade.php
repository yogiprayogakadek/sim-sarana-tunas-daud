@extends('template.master')

@section('page-title', 'Peminjaman')
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
                            <h3>Data Peminjaman</h3>
                            <span>Tanggal dicetak: {{ date('d-m-Y H:i:s') }}</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <h3 class="text-center">Laporan Peminjaman</h3>
                        <p class="text-center">{{$kategori == 'Semua' ? '' : $startTime.' s/d ' . $endTime }}</p>
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tangal Peminjaman</th>
                                            <th>Nama Peminjam</th>
                                            <th>Keterangan</th>
                                            <th>Sarana</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjaman as $peminjaman)
                                            @php
                                                $sarana = json_decode($peminjaman->sarana, true);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date_format(date_create($peminjaman->tanggal), 'd-m-Y') }}</td>
                                                <td>{{ $peminjaman->user->nama }}</td>
                                                <td>{{ $peminjaman->keterangan }}</td>
                                                <td>
                                                    <div class="row">
                                                        @foreach ($sarana as $s)
                                                            <div class="col-md-4">
                                                                <span>Nama</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span>: {{ $s['namaSarana'] }}</span>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <span>Jumlah</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span>: {{ $s['jumlah'] }}</span>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <span>Kepemilikan</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span>: {{ $s['kepemilikan'] }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
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
    </div>
@endsection
