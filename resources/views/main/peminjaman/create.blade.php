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
                            @can('siswa')
                            <input type="hidden" name="nama_peminjaman" id="nama_peminjaman" value="{{Auth::user()->id}}">
                            <input type="text" id="siswa" name="siswa" class="form-control"
                                placeholder="nama peminjam" value="{{Auth::user()->nama}}" readonly>
                            @endcan

                            @can('admin')
                            <select name="nama_peminjaman" id="nama_peminjaman" class="form-control">
                                @foreach($siswa as $s)
                                <option value="{{$s->id}}">{{$s->nama}}</option>
                                @endforeach
                            </select>
                            @endcan
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-nama_peminjam"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group mb-0 mb-15 with-validation keterangan" id="keterangan-group">
                            <label class="control-label mb-10 " for="keterangan">Keterangan Peminjaman</label>
                            <textarea id="keterangan" name="keterangan" class="form-control"
                                placeholder="keterangan peminjaman sarana"></textarea>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-keterangan"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group mb-15 with-validation foto">
                            <label class="control-label mb-10 text-left">Bukti Peminjaman</label>
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i
                                        class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                        class="fileinput-filename"></span></div>
                                <span class="input-group-addon fileupload btn btn-info btn-anim btn-file"><i
                                        class="fa fa-upload"></i> <span class="fileinput-new btn-text">Select
                                        file</span> <span class="fileinput-exists btn-text">Change</span>
                                    <input type="file" name="foto">
                                </span> <a href="#"
                                    class="input-group-addon btn btn-danger btn-anim fileinput-exists"
                                    data-dismiss="fileinput"><i class="fa fa-trash"></i><span class="btn-text">
                                        Hapus</span></a>
                            </div>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-foto"></li>
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
