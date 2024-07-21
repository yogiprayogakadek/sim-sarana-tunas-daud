<!DOCTYPE html>
<html lang="en">

@include('template.partials.head')

<body>
    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->
    <div class="wrapper theme-1-active pimary-color-green">

        <!-- Top Menu Items -->
        @include('template.partials.navbar')
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        @include('template.partials.sidebar')
        <!-- /Left Sidebar Menu -->


        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid">

                <!-- Title -->
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">@yield('page-title')</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li>@stack('page-link')</li>
                            <li class="active"><span>@yield('sub-title')</span></li>
                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- /Title -->

                @yield('content')

                <!-- Footer -->
                @include('template.partials.footer')
                <!-- /Footer -->
            </div>
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->

    @include('template.partials.script')


</body>

</html>
