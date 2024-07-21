@extends('template.master')

@section('page-title', 'Sarana')
@section('sub-title', 'List')
@push('page-link')
    <a href="{{ route('sarana.index') }}">Sarana</a>
@endpush
{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dist/jasny-bootstrap.min.css') }}">
@endpush --}}

@section('content')
    <div class="row render">

    </div>
@endsection

@push('script')
    {{-- <script src="{{ asset('assets/js/dist/jasny-bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('assets/function/sarana/script.js') }}"></script>
    <script>
        @if (session('status'))
            Swal.fire(
                "{{ session('title') }}",
                "{{ session('message') }}",
                "{{ session('status') }}",
            );
        @endif
    </script>
@endpush
