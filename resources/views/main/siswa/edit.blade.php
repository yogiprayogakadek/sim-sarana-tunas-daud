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
                        <div class="form-group mb-0 mb-15 with-validation username" id="username-group">
                            <input type="hidden" name="id" id="id" class="form-control" value="{{$siswa->id}}">
                            <label class="control-label mb-10 " for="username">NIS</label>
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="nis" value="{{$siswa->username}}" disabled>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-username"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group mb-0 mb-15 with-validation nama" id="nama-group">
                            <label class="control-label mb-10 " for="nama">Nama Siswa</label>
                            <input type="text" id="nama" name="nama" class="form-control"
                                placeholder="nama lengkap" value="{{$siswa->nama}}">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-nama"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group mb-0 mb-15 with-validation status" id="status-group">
                            <label class="control-label mb-10 " for="status">status Sarana</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="0" {{$siswa->is_active == false ? 'selected' : ''}}>Tidak Aktif</option>
                                <option value="1" {{$siswa->is_active == true ? 'selected' : ''}}>Aktif</option>
                            </select>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-status"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button class="btn btn-success btn-anim btn-update" type="button"><i
                                    class="icon-rocket"></i><span class="btn-text">Simpan</span></button>
                                    <button class="btn btn-warning btn-anim btn-reset-password ml-3" data-id="{{$siswa->id}}" type="button"><i
                                            class="icon-lock"></i><span class="btn-text">Reset Password</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
