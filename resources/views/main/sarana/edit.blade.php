<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-right">
                <button class="btn btn-primary btn-rounded btn-lable-wrap left-label btn-data"> <span class="btn-label"><i
                            class="fa fa-arrow-left white-icon"></i> </span><span class="btn-text">Ubah
                        Data</span></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="form-wrap">
                    <form id="formUpdate">
                        <div class="form-group mb-0 mb-15 with-validation nama" id="nama-group">
                            <input type="hidden" name="id" id="id" class="form-control" value="{{$sarana->id}}">
                            <label class="control-label mb-10 " for="nama">Nama Sarana</label>
                            {{-- <label class="control-label mb-10 " for="nama">nama</label> <small>(biarkan
                                kosong jika ingin membuat nama otomatis)</small> --}}
                            <input type="text" id="nama" name="nama" class="form-control"
                                placeholder="nama sarana" value="{{$sarana->nama}}">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-nama"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group mb-0 mb-15 with-validation jumlah" id="jumlah-group">
                            <label class="control-label mb-10 " for="jumlah">Jumlah Sarana</label>
                            <input type="text" id="jumlah" name="jumlah" class="form-control"
                                placeholder="jumlah sarana" value="{{$sarana->jumlah}}">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-jumlah"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group mb-0 mb-15 with-validation jumlah" id="kepemilikan-group">
                            <label class="control-label mb-10 " for="kepemilikan">Kepemilikan</label>
                            <select name="kepemilikan" id="kepemilikan" class="form-control">
                                <option value="">Pilih kepemilikan sarana</option>
                                @foreach ($kategori as $item)
                                    <option value="{{$item}}" {{$sarana->kepemilikan == $item ? 'selected' : ''}}>{{$item}}</option>
                                @endforeach
                            </select>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-kepemilikan"></li>
                                </ul>
                            </div>
                        </div>


                        <div class="form-group mb-15 with-validation foto">
                            <label class="control-label mb-10 text-left">Foto Sarana <span class="small text-muted">(kosongkan jika tidak ingin mengganti foto)</span></label>
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

                        <div class="form-group mb-0">
                            <button class="btn btn-success btn-anim btn-update" type="button"><i
                                    class="icon-rocket"></i><span class="btn-text">Simpan</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
