<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="sb-nav-fixed">
    <div id="app">
        @include('layouts.nav')

        <div @auth() id="layoutSidenav" @endauth class="py-4">
            @auth()
            @include('layouts.side_nav')
            @endauth
            <div id="layoutSidenav_content" style="position:relative; top: 56px;">
                <main>
                    @yield('content')
                    <div class="container mb-4">
                        <div id="map"></div>
                    </div>
                </main>
            </div>
        </div>
    </div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/chart.min.js') }}"></script>
<script src="{{ asset('js/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/weather.js') }}"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCswO_df1SesOd8uViwi5VkgT2tQ6H6Cto"></script>
<script src="{{ asset('js/jquery.googlemap.js') }}"></script>
<script type="text/javascript">
    $(function() {
        BindMarkers();
        // setInterval(function () { BindMarkers() }, 3000);
        function BindMarkers() {
            window.axios.get('/barangays/all/locations').then(response => {
                let markers = response.data;
                let mapOptions = {
                    center: new google.maps.LatLng(10.0314, 124.0674),
                    zoom: 11,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                let infoWindow = new google.maps.InfoWindow();
                let map = new google.maps.Map(document.getElementById("map"), mapOptions);
                for (i = 0; i < markers.length; i++) {
                    let data = markers[i]
                    let myLatlng = new google.maps.LatLng(markers[i].lat, markers[i].long);
                    let marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: `Brgy. ${markers[i].name}`,
                        icon: '../img/e-marker.png'
                    });
                    (function (marker, data) {
                        google.maps.event.addListener(marker, "click", function (e) {
                            let info = `Brgy. ${data.name}`
                            infoWindow.setContent(info);
                            infoWindow.open(map, marker);
                        });
                    })(marker, data);
                }
            })
        }
    })
</script>
@yield('scripts')
</body>
</html>
