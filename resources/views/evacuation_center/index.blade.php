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
                <a href="javascript:void(0)" class="btn btn-md btn-outline-secondary mb-2">
                    <i class="fas fa-plus"></i> Add Evacuation Center
                </a>
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
            <table class="table table-dashed">
                <thead>
                    <tr>
                        <th>Barangay</th>
                        <th>Evacuation Center Type</th>
                        <th>Maximum Capacity</th>
                        <th>Families</th>
                        <th>Males</th>
                        <th>Females</th>
                        <th>PWDs</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Anonang</td>
                        <td>Multi-purpose Center</td>
                        <td>50</td>
                        <td>15</td>
                        <td>10</td>
                        <td>20</td>
                        <td>2</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection