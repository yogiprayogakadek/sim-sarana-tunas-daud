<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Menu</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">
                <div class="pull-left"><i class="zmdi zmdi-home mr-20"></i><span class="right-nav-text">Dashboard</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        @can('admin')
        <li>
            <a href="{{ route('siswa.index') }}" class="{{ Request::is('siswa') ? 'active' : '' }}">
                <div class="pull-left"><i class="fa fa-users mr-20"></i><span
                        class="right-nav-text">Siswa</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        @endcan
        <li>
            <a href="{{ route('sarana.index') }}" class="{{ Request::is('sarana') ? 'active' : '' }}">
                <div class="pull-left"><i class="fa fa-dropbox mr-20"></i><span
                        class="right-nav-text">Sarana</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        @can('admin')
        <li>
            <a href="{{ route('peminjaman.index') }}" class="{{ Request::is('peminjaman') ? 'active' : '' }}">
                <div class="pull-left"><i class="fa fa-arrow-up mr-20"></i><span
                        class="right-nav-text">Peminjaman</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a href="{{ route('pengembalian.index') }}" class="{{ Request::is('pengembalian') ? 'active' : '' }}">
                <div class="pull-left"><i class="fa fa-arrow-down mr-20"></i><span
                        class="right-nav-text">Pengembalian</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a href="{{ route('kerusakan.index') }}" class="{{ Request::is('kerusakan') ? 'active' : '' }}">
                <div class="pull-left"><i class="fa fa-times mr-20"></i><span
                        class="right-nav-text">Kerusakan</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        @endcan
    </ul>
</div>
