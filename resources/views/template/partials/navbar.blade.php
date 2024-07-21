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
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img
                        src="{{ asset('assets/image/user1.png') }}" alt="user_auth"
                        class="user-auth-img img-circle" /><span class="user-online-status"></span></a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    {{-- <li>
                        <a href="javascript:void(0)" class="change-password"><i class="zmdi zmdi-lock"></i><span>Ubah
                                Kata Sandi</span></a>
                    </li>
                    <li class="divider"></li> --}}
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
