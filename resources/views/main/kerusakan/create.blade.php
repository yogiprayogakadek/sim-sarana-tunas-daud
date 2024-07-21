<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-right">
                <button class="btn btn-primary btn-rounded btn-lable-wrap left-label btn-data"> <span class="btn-label"><i
                            class="fa fa-arrow-left white-icon"></i> </span><span class="btn-text">Tambah
                        Data</span></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="form-wrap">
                    <form id="formAdd">
                        <div class="form-group mb-0 mb-15 with-validation tanggal" id="tanggal-group">
                            <label class="control-label mb-10 " for="tanggal">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control"
                                placeholder="tanggal">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-tanggal"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group mb-0 mb-15 with-validation daftar_sarana" id="daftar_sarana-group">
                            <label class="control-label mb-10 " for="daftar_sarana">Daftar Sarana</label>
                            <table class="table table-bordered" id="modalTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nama Sarana</th>
                                        <th>Ketersediaan</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sarana as $sarana)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="checkbox-sarana"
                                                    id="checkbox{{ $sarana->id }}" name="list[]"
                                                    data-id="{{ $sarana->id }}" data-nama="{{ $sarana->nama }}"
                                                    data-kepemilikan="{{$sarana->kepemilikan}}">
                                            </td>
                                            <td>{{ $sarana->nama }}</td>
                                            <td>{{ $sarana->jumlah }}</td>
                                            <td>
                                                <div class="form-group mb-0 mb-15 with-validation jumlah-kerusakan" id="jumlah-kerusakan-group-{{ $sarana->id }}">
                                                    <input class="form-control jumlah-kerusakan" disabled=true
                                                        id="jumlah-kerusakan{{ $sarana->id }}" data-id="{{ $sarana->id }}"
                                                        data-jumlah="{{ $sarana->jumlah }}" name="jumlah-kerusakan[]"
                                                        data-kepemilikan="{{$sarana->kepemilikan}}">
                                                    <div class="help-block with-errors error-message">
                                                        <ul class="list-unstyled">
                                                            <li class="error-jumlah-kerusakan-{{ $sarana->id }}"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-0 mb-15 with-validation keterangan" id="keterangan-group-{{ $sarana->id }}">
                                                    <textarea class="form-control keterangan" disabled=true
                                                        id="keterangan{{ $sarana->id }}" data-id="{{ $sarana->id }}"
                                                        data-jumlah="{{ $sarana->jumlah }}" name="keterangan[]"
                                                        data-kepemilikan="{{$sarana->kepemilikan}}"></textarea>
                                                    <div class="help-block with-errors error-message">
                                                        <ul class="list-unstyled">
                                                            <li class="error-keterangan-{{ $sarana->id }}"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group mb-0">
                            <button class="btn btn-success btn-anim btn-save btn-send" disabled="true" type="button"><i
                                    class="icon-rocket"></i><span class="btn-text">Simpan</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
