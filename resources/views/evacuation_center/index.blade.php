@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">BDRRMO</h1>
        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active">BDRRMO</li>
        </ol>

        <div class="table-responsive">
            <div class="d-flex justify-content-between">
                <button type="button"
                   class="btn btn-md btn-outline-primary mb-2"
                   data-toggle="modal"
                   data-target="#evacuationCenterModal">
                    <i class="fas fa-plus"></i> Add Evacuation Center
                </button>
                <form class="d-none d-md-inline-block">
                    <div class="input-group">
                        <input class="form-control"
                               type="text"
                               placeholder="Search for..."
                               aria-label="Search for..."
                               aria-describedby="btnESearch">
                        <button class="btn btn-primary" id="btnESearch" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <hr />

            @include('evacuation_center.tables.brgy-evacuation')

        </div>
    </div>

    @include('evacuation_center.modals.new-evacuation-center')

@endsection

@section('scripts')
  <script>
      $(document).ready(function () {

          $('.numberonly').keypress(function (e) {
              var charCode = (e.which) ? e.which : event.keyCode
              if (String.fromCharCode(charCode).match(/[^0-9]/g)) {
                  return false
              }
              return true
          })

      })
  </script>
@endsection