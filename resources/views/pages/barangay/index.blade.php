@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        @auth
        <h1 class="mt-4">MDRRMO</h1>

        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active">MDRRMO</li>
        </ol>
        @endauth

        <div class="row">
            <h4 class="mb-3"><i class="fa fa-house"></i> Barangays</h4>
            <div class="col-md-5 scrollable-div">
                @include('pages.barangay.accordions.lists')
            </div>
            <div class="col-md-7">
                <div id="map" class="mb-4" style="height: 400px;">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCswO_df1SesOd8uViwi5VkgT2tQ6H6Cto"></script>
    <script src="{{ asset('js/jquery.googlemap.js') }}"></script>
    <script>
        $(document).ready(function () {
            const first_brgy = $('.toggle-barangay:first-child')
            let url = ''

            function BindMarkers(url) {
                window.axios.get(url).then(response => {
                    let markers = response.data;
                    console.log(markers)
                    let mapOptions = {
                        center: new google.maps.LatLng(markers.lat, markers.long),
                        zoom: 12,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    let infoWindow = new google.maps.InfoWindow();
                    let map = new google.maps.Map(document.getElementById("map"), mapOptions);
                    let data = markers
                    let myLatlng = new google.maps.LatLng(markers.lat, markers.long);
                    let marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: `Brgy. ${markers.name}`,
                        icon: markers.evacuation_center != null ? '../img/e-marker.png' : ''
                    });
                    (function (marker, data) {
                        google.maps.event.addListener(marker, "click", function (e) {
                            let info = `<strong style="margin-bottom: 10px; display: block; ">Brgy. ${data.name}</strong>`
                            if (data.evacuation_center != null) {
                                let family_count = data.evacuation_center.evacuee != null ? data.evacuation_center.evacuee.family_count : 0
                                let male_count = data.evacuation_center.evacuee != null ? data.evacuation_center.evacuee.male_count : 0
                                let female_count = data.evacuation_center.evacuee != null ? data.evacuation_center.evacuee.female_count : 0
                                let pwd_count = data.evacuation_center.evacuee != null ? data.evacuation_center.evacuee.pwd_count : 0

                                info += `Evacuation Center Type: <span class="badge badge-info">${data.evacuation_center.evacuation_center_type.name}</span><br/>
                                    Maximum Capacity: <span class="badge badge-info">${data.evacuation_center.max_capacity}</span><br/>
                                    Family: <span class="badge badge-info mr-1">${family_count}</span>
                                    Male: <span class="badge badge-info mr-1">${male_count}</span><br/>
                                    Female: <span class="badge badge-info mr-1">${female_count}</span>
                                    PWDs: <span class="badge badge-info mr-1">${pwd_count}</span><br/>
                                    Is Evacuation Center Full?: <span class="badge badge-info">${data.evacuation_center.is_evacuation_center_full ? 'Yes' : 'No'}</span>
                                `
                            }
                            infoWindow.setContent(info);
                            infoWindow.open(map, marker);
                        });
                    })(marker, data);
                })
            }

            function openFirstBarangayByDefault() {
                first_brgy.click()
                url = first_brgy.attr('data-url')
                BindMarkers(url)
            }

            openFirstBarangayByDefault()

            $(document).on('click', '.toggle-barangay', function(e) {
                url = $(this).attr('data-url')
                BindMarkers(url)
            })
        })
    </script>
@endsection