@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Calamity Information</h1>
        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active">Calamity Information</li>
        </ol>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-cloud"></i> Calamity Information
                    </div>
                    <div class="card-body">
                        <div class="h3 calamity-name">
                            <svg class="" width="80" height="80" viewBox="0 0 1152 1024" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle;"><path d="M576 229.92l-437.060 385.5c-3.24 2.92-7.38 4.28-10.94 6.7v369.88c0 17.68 14.32 32 32 32h298.46l-74.46-145.62 208.22-128-120.32-238.44 296.1 273.56-208.22 128 79.84 110.5h352.38c17.68 0 32-14.32 32-32v-369.8c-3.4-2.32-7.44-3.64-10.52-6.4l-437.48-385.88zM1141.38 472.56l-117.38-103.66v-272.9c0-17.68-14.32-32-32-32h-128c-17.68 0-32 14.32-32 32v103.38l-202.5-178.76c-15.26-13.72-34.38-20.6-53.5-20.62s-38.2 6.82-53.4 20.54l-511.98 452.020c-13.14 11.82-14.24 32.040-2.42 45.2l42.8 47.64c11.8 13.14 32.040 14.24 45.2 2.42l458.64-404.56c12.1-10.66 30.24-10.66 42.34 0l458.64 404.54c13.14 11.8 33.38 10.72 45.2-2.42l42.8-47.64c11.8-13.14 10.72-33.38-2.44-45.18z" style="fill: rgb(60, 55, 68);"></path></svg>
                            Earthquake
                        </div>
                        <div class="h6">
                            Magnitude: 1
                        </div>
                        <div class="">
                            Location of epicenter: <strong>test</strong><br/>
                            Intensity of earthquake: <strong>III (Weak)</strong>
                        </div>
                    </div>
                    <div class="card-footer p-0">
                        <button type="button" class="btn btn-block btn-primary rounded-0">Update Calamity Info</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('calamity.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Select Calamity Type</label>
                                <select class="form-control toggle-cType" name="type">
                                    <option selected>Select Calamity Type</option>
                                    <option value="0">Tropical Cyclone (Bagyo)</option>
                                    <option value="1">Earthquake</option>
                                </select>
                            </div>
                            <div id="info_arr">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.numberonly').keypress(function (e) {
                let charCode = (e.which) ? e.which : event.keyCode
                if (String.fromCharCode(charCode).match(/[^0-9]/g)) {
                    return false
                }
                return true
            })

            $(document).on('change', '.toggle-cType', function(e) {
                let type = $(this).val()
                if (type == 1) {
                    $(`#info_arr`).html(`
                        <div class="form-group required">
                            <label>Location of Epicenter</label>
                            <input class="form-control" name="info_arr[location_of_epicenter]" required>
                        </div>
                        <div class="form-group required">
                            <label>Magnitude of Earthquake</label>
                            <input class="form-control" name="info_arr[magnitude]" value="0" required>
                        </div>
                        <div class="form-group required">
                            <label>Intensity of Earthquake</label>
                            <select class="form-control" name="info_arr[intensity_of_earthquake]" required>
                                <option disabled selected hidden>Select intensity of earthquake</option>
                                @foreach(\App\Models\Calamity::EARTHQUAKE_INTENSITIES as $index => $intensity)
                                <option value="{{ $index }}">{{ $intensity }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                        </div>
                    `)
                } else {
                    $(`#info_arr`).html(`
                        <div class="form-group required">
                            <label>Name of Tropical Cyclone</label>
                            <input class="form-control" name="info_arr[name_of_tropical_cyclone]" required>
                        </div>
                        <div class="form-group required">
                            <label>Windspeed of tropical cyclone (km/h)</label>
                            <input class="form-control" name="info_arr[windspeed_of_tropical_cyclone_(km/h)]" value="0" required>
                        </div>
                        <div class="form-group required">
                            <label>Direction of tropical cyclone</label>
                            <input class="form-control" name="info_arr[direction_of_tropical_cyclone]" required>
                        </div>
                        <div class="form-group required">
                            <label>Classification of tropical cyclone</label>
                            <select class="form-control" name="info_arr[classification_of_tropical_cyclone]" required>
                                <option disabled selected hidden>Select classification of tropical cyclone</option>
                                @foreach(\App\Models\Calamity::TROPICAL_CYCLONE_CLASSIFICATIONS as $index => $classification)
                                <option value="{{ $index }}">{{ $classification }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                        </div>
                    `)
                }
            })

        })
    </script>
@endsection