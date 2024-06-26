@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        @auth()
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        @endauth
        @include('plugins.weather-updates')
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-phone me-1"></i>
                        Emergency Numbers
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>BFP</strong> - (038) 513 9463
                            </li>
                            <li class="list-group-item">
                                <strong>PNP</strong> - 09985986407
                            </li>
                            <li class="list-group-item">
                                <strong>NDRRMC</strong> - 513-9484
                            </li>
                            <li class="list-group-item">
                                <strong>MHO</strong> - 513-9404
                            </li>
                            <li class="list-group-item">
                                <strong>NPD</strong> - 09778254479
                            </li>
                            <li class="list-group-item">
                                <strong>MDRRMO</strong> - 09982812990
                            </li>
                            <li class="list-group-item">
                                <strong>AMBULANCE</strong> - 09507025923
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-house me-1"></i>
                        Barangay Information
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                Legend:
                                <small><span class="legend bg-danger"></span> Full</small>&emsp;
                                <small><span class="legend bg-success"></span> Available</small>
                            </div>
                        </div>
                        <hr />
                        <table class="table table-dash table-hover">
                            <thead>
                            <tr>
                                <th>Barangay</th>
                                <th>No. of Evacuees / Capacity</th>
                                <th width="100">Males</th>
                                <th width="100">Females</th>
                                <th width="100">PWDs</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($evacuationCenters->count() > 0)
                                @foreach($evacuationCenters as $center)
                                <tr>
                                <td><span class="legend bg-{{ $center->is_evacuation_center_full ? 'danger' : 'success' }}"></span>
                                    {{ $center->barangay->name }}
                                </td>
                                <td>
                                    @php
                                        $male_count = isset($center->evacuee) != null ? $center->evacuee->male_count : 0;
                                        $female_count = isset($center->evacuee) != null ? $center->evacuee->female_count : 0;
                                        $total = $male_count + $female_count;
                                    @endphp
                                    {{ $total }} / {{ $center->max_capacity }}
                                </td>
                                <td>{{ $male_count }}</td>
                                <td>{{ $female_count }}</td>
                                <td>{{ isset($center->evacuee) != null ? $center->evacuee->pwd_count : 0 }}</td>
                            </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        
                        <div class="d-flex justify-content-end mt-5">
                            {{ $evacuationCenters->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/chart-area-demo.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_key') }}"></script>
    <script src="{{ asset('js/jquery.googlemap.js') }}"></script>
    <script src="{{ asset('js/multi-gmap.js') }}"></script>
    <script src="{{ asset('js/weather.js') }}"></script>
@endsection