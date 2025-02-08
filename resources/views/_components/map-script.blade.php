<script>
    function initCustomMap(mapId, latInputId, lngInputId, initialLat = 43.238949, initialLng = 76.889709) {
        const mapElement = document.getElementById(mapId);
        const latInput = document.getElementById(latInputId);
        const lngInput = document.getElementById(lngInputId);

        const currentLat = parseFloat(latInput.value);
        const currentLng = parseFloat(lngInput.value);

        const map = new google.maps.Map(mapElement, {
            center: { lat: currentLat || initialLat, lng: currentLng || initialLng },
            zoom: 13,
            mapTypeControl: false,
            streetViewControl: false,
        });

        const marker = new google.maps.Marker({
            position: currentLat && currentLng ? { lat: currentLat, lng: currentLng } : null,
            map: currentLat && currentLng ? map : null,
            draggable: true,
        });

        map.addListener('click', function (event) {
            marker.setPosition(event.latLng);
            marker.setMap(map);
            updateLatLng(event.latLng);
        });

        marker.addListener('dragend', function (event) {
            updateLatLng(event.latLng);
        });

        function updateLatLng(location) {
            latInput.value = location.lat();
            lngInput.value = location.lng();
        }
    }
</script>
