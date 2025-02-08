<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Карта</title>
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>
<body>

<h1 style="text-align:center;">Пример Google Maps</h1>
<div id="map"></div>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6yaViYQNiZ3SvGvqCJxeGEe9LuoF7mv4&callback=initMap"
    async defer>
</script>

<script>
    function initMap() {
        const center = { lat: 43.238949, lng: 76.889709 }; // Алматы
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: center
        });

        new google.maps.Marker({
            position: center,
            map: map,
            title: "Центр города"
        });
    }
</script>

</body>
</html>
