{{-- Modal password --}}
<div id="change-password-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title">Ubah Kata Sandi</h5>
            </div>
            <div class="modal-body">
                <form id="formChangePassword">
                    <div class="form-group current_password with-validation">
                        <label class="col-sm-3 control-label mt-10" for="current_password">Kata Sandi Sekarang</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password"
                                    placeholder="Masukkan kata sandi sekarang" name="current_password">
                                <div class="input-group-addon"><i class="icon-lock"></i></div>
                            </div>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-current_password"></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group new_password with-validation">
                        <label class="col-sm-3 control-label mt-10" for="new_password">Kata Sandi Baru</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password"
                                    placeholder="Masukkan kata sandi baru" name="new_password">
                                <div class="input-group-addon"><i class="icon-lock"></i></div>
                            </div>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-new_password"></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group confirm_password with-validation">
                        <label class="col-sm-3 control-label mt-10" for="confirm_password">Konfirmasi Kata Sandi Baru</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password"
                                    placeholder="Masukkan ulang kata sandi baru" name="confirm_password">
                                <div class="input-group-addon"><i class="icon-lock"></i></div>
                            </div>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-confirm_password"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-outline btn-change-password mr-15">Simpan</button>
            </div>
        </div>
    </div>
</div>
{{-- End --}}

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap">
                <a href="{{route('dashboard.index')}}">
                    <img class="brand-img" src="{{ asset('assets/image/logo.png') }}" alt="brand" width="30px" />
                    <span class="brand-text">SIM-Sarana</span>
                </a>
            </div>
        </div>
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i
                class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                    <span class="mr-10">{{auth()->user()->nama}}</span>
                    <img src="{{ asset('assets/image/user1.png') }}" alt="user_auth" class="user-auth-img img-circle" />
                    <span class="user-online-status"></span>
                </a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li>
                        <a href="javascript:void(0)" class="change-password"><i class="zmdi zmdi-lock"></i><span>Ubah
                                Kata Sandi</span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="zmdi zmdi-power"></i><span>Keluar</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</nav>
