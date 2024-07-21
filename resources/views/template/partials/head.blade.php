<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>SIM Sarana | SMA Tunas Daud</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/image/logo.png') }}">
    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">

    <!-- Data table CSS -->
    <link href="{{ asset('assets/css/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/datatables/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dist/jasny-bootstrap.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
</head>
