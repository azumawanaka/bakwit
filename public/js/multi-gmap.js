
$(function() {
    BindMarkers();
    // setInterval(function () { BindMarkers() }, 3000);
    function BindMarkers() {
        window.axios.get('/barangays/all/locations').then(response => {
            let markers = response.data;
            console.log(markers)
            let mapOptions = {
                center: new google.maps.LatLng(10.1000, 124.0999),
                zoom: 12,
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
                    icon: markers[i].evacuation_center != null ? '../img/e-marker.png' : ''
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
            }
        })
    }
})