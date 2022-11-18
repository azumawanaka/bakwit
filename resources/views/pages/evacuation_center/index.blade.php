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
{{--                <form method="get" class="d-flex align-items-center gap-2">--}}
{{--                    <div class="input-group d-flex align-items-center">--}}
{{--                        <label class="mr-1 mb-0">Search By:</label>--}}
{{--                        <select class="form-control" name="search_for">--}}
{{--                            <option value="barangay">Barangay</option>--}}
{{--                            <option value="evacuation_center_type">Evacuation Center Type</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="input-group">--}}
{{--                        <input class="form-control"--}}
{{--                               type="text"--}}
{{--                               name="keyword"--}}
{{--                               placeholder=""--}}
{{--                               aria-describedby="btnESearch">--}}
{{--                            <button class="btn btn-primary" id="btnESearch" type="submit"><i class="fas fa-search"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
            </div>
            @if (session('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <hr/>

            @include('pages.evacuation_center.tables.brgy-evacuation')

        </div>
    </div>

    @include('pages.evacuation_center.modals.new-evacuation-center')
    @include('pages.evacuation_center.modals.edit-evacuation-center')
    @include('pages.evacuation_center.modals.confirm-delete')

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

            let updateUrl = ''
            $(document).on('click','.edit-evacuation-center', function(e) {
                let url = $(this).attr('data-get-url')
                const center = $(this).attr('data-center')
                updateUrl = $(this).attr('data-update-url')

                $('[name=family_count]').val(0)
                $('[name=male_count]').val(0)
                $('[name=female_count]').val(0)
                $('[name=pwd_count]').val(0)

                window.axios.get(url).then(response => {
                    let data = response.data
                    console.log(data)
                    $('#form-edit').attr('action', updateUrl)
                    $('#update_barangay_id')
                        .attr('disabled', 'disabled')
                        .val(data.barangay)
                        .change()
                    $('#update_evacuation_center_type_id').val(data.center_type).change()
                    $('#update_max_capacity').val(data.max_capacity)

                    let family_count = data.evacuee.family_count
                    let male_count = data.evacuee.male_count
                    let female_count = data.evacuee.female_count
                    let pwd_count = data.evacuee.pwd_count

                    $('[name=family_count]').val(family_count)
                    $('[name=male_count]').val(male_count)
                    $('[name=female_count]').val(female_count)
                    $('[name=pwd_count]').val(pwd_count)
                })
            })

            $(document).on('click', '.confirmModalDelete', function (e) {
                e.preventDefault()
                let url = $(this).attr('data-url')
                $('#confirmDelete form').attr('action', url)
            })

        })
    </script>
@endsection