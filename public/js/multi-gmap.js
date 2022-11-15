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