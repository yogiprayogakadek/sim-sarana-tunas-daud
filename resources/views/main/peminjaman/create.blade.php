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
                            <label class="control-label mb-10 " for="tanggal">Tanggal Peminjaman</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control"
                                placeholder="tanggal peminjaman">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-tanggal"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group mb-0 mb-15 with-validation nama_peminjam" id="nama_peminjam-group">
                            <label class="control-label mb-10 " for="nama_peminjam">Nama Peminjam</label>
                            <input type="text" id="nama_peminjam" name="nama_peminjam" class="form-control"
                                placeholder="nama peminjam">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-nama_peminjam"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group mb-0 mb-15 with-validation keterangan" id="keterangan-group">
                            <label class="control-label mb-10 " for="keterangan">Keterangan Peminjaman</label>
                            <textarea id="keterangan" name="keterangan" class="form-control"
                                placeholder="keterangan sarana"></textarea>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-keterangan"></li>
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
                                                <div class="form-group mb-0 mb-15 with-validation jumlah-peminjaman" id="jumlah-peminjaman-group-{{ $sarana->id }}">
                                                    <input class="form-control jumlah-peminjaman" disabled=true
                                                        id="jumlah-peminjaman{{ $sarana->id }}" data-id="{{ $sarana->id }}"
                                                        data-jumlah="{{ $sarana->jumlah }}" name="jumlah-peminjaman[]"
                                                        data-kepemilikan="{{$sarana->kepemilikan}}">
                                                    <div class="help-block with-errors error-message">
                                                        <ul class="list-unstyled">
                                                            <li class="error-jumlah-peminjaman-{{ $sarana->id }}"></li>
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