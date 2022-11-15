@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        @auth()
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        @endauth
        @include('plugins.weather-updates')
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-building me-1"></i>
                Barangays Evacuation Centers
            </div>
            <div class="card-body">
                <div id="map" class="mb-4"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
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
                        @auth()
                            <a href="#" class="btn btn-outline-secondary btn-sm">Generate Report</a>
                        @endauth
                    </div>
                    <hr />
                    <table class="table table-dash table-hover">
                        <thead>
                        <tr>
                            <th>Barangay</th>
                            <th width="240">No. of Evacuees / Capacity</th>
                            <th width="100">Males</th>
                            <th width="100">Females</th>
                            <th width="100">PWDs</th>
                            @auth()
                                <th width="130"></th>
                            @endauth
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="legend bg-danger"></span> Anonang</td>
                            <td>240/9450</td>
                            <td>120</td>
                            <td>120</td>
                            <td>10</td>
                            @auth()
                                <td>
                                    <a href="#" class="btn btn-sm btn-secondary">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success text-white">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger text-white">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            @endauth
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/multi-gmap.js') }}"></script>
@endsection