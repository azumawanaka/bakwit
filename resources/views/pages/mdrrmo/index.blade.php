@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">MDRRMO</h1>
        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active">MDRRMO</li>
        </ol>

        <div class="table-responsive">
            <div class="d-flex justify-content-between">
                <div class="d-flex gap-2 align-items-center mb-2">

                </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/multi-gmap.js') }}"></script>
    <script>
        $(document).ready(function () {
        })
    </script>
@endsection