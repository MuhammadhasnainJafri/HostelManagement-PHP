<?php
require_once("../includes/dbconn.php");
$ret = "SELECT pm_hotel.title,pm_hotel.lat,pm_hotel.lng,pm_hotel.id,pm_hotel.address,hostel_images.image_url from pm_hotel,hostel_images  where pm_hotel.id=hostel_images.hostel_id  and hostel_images.brand!=''";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
$cnt = 1;
$locationarray = array();
while ($row = $res->fetch_object()) {
    $locationarray[] = $row;
}

$location = json_encode($locationarray);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>About | Hosteller</title>
    <script id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>
    <script src="https://www.youtube.com/player_api"></script>
    <link rel="stylesheet preload" as="style" href="css/preload.min.css" />
    <link rel="stylesheet preload" as="style" href="css/libs.min.css" />

    <link rel="stylesheet" href="css/about.min.css" />
    <link rel="stylesheet" href="css/custom.css" />
    
</head>

<body>
    <?php
    include 'partials/header.php';
    ?>
    <!-- <header class="page">
            <div class="container">
                <ul class="breadcrumbs d-flex flex-wrap align-content-center">
                    <li class="list-item">
                        <a class="link" href="index.html">Home</a>
                    </li>

                    <li class="list-item">
                        <a class="link" href="#">About</a>
                    </li>
                </ul>
                <h1 class="page_title">About</h1>
            </div>
        </header> -->
    <!-- about page content start -->
    <main>

        <div id="googleMap" style="width:100%;height:800px;">


        </div>


    </main>
    <div class="video d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="video_frame d-flex align-items-center justify-content-center">
                <i class="icon-close video_frame-close"></i>
                <div id="player"></div>
            </div>
        </div>
    </div>
    <!-- about page content end -->
    <?php
    include 'partials/footer.php';
    ?>






    <script>
        var locationdata = <?php echo $location; ?>;
   
        function detectBrowser() {
            var useragent = navigator.userAgent;
            var mapdiv = document.getElementById("map");

            if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1) {
                mapdiv.style.width = '100%';
                mapdiv.style.height = '100%';
            } else {
                mapdiv.style.width = '600px';
                mapdiv.style.height = '800px';
            }
        }

        var myLatLng;
        var latit;
        var longit;

        function geoSuccess(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;

            myLatLng = {
                lat: latitude,
                lng: longitude
            };
            var mapProp = {
                // center: new google.maps.LatLng(latitude, longitude), // puts your current location at the centre of the map,
                zoom: 8,
                mapTypeId: 'roadmap',

            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
           
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;

            //call renderer to display directions
            directionsDisplay.setMap(map);

            var bounds = new google.maps.LatLngBounds();
           
           
let icon = {
   url: 'img/location.png',
}

            var mymarker = new google.maps.Marker({

                position: myLatLng,
                map: map,
                title: 'Your Location',
                icon:icon
                
            });
         
           

            // Info Window Content
            var infoWindowContent = [
                ['<div class="info_content">' +
                    '<h3>3fe</h3>' +
                    '<p>32 Grand Canal Street Lower, Grand Canal Dock, Dublin 2</p>' +
                    '<img src="images/3fe.jpg" width="200" height="200">' +
                    '</div>'
                ]
            ];
           
            // Display multiple markers on a map
            var infoWindow = new google.maps.InfoWindow(),
                marker, i=0;


var z=0;

                for (x in locationdata) {
                    var position = new google.maps.LatLng(locationdata[x].lat,locationdata[x].lng);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: locationdata[x].title
                    
                });

                // Allow each marker to have an info window
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        console.info(marker);
                        infoWindow.setContent('<div class="info_content"><a href="room.php?id='+locationdata[z].id+'">' +
                    '<h3>'+locationdata[z].title+'</h3>' +
                    '<p><b>Address: </b>'+locationdata[z].address+'</p>' +
                    '<img src="'+locationdata[z].image_url+'" width="200" height="200">' +
                    '<button class="learn-more" onclick="trackpath()"><span class="circle" aria-hidden="true"><span class="icon arrow"></span></span><span class="button-text">View Hostel</span></button></a>');
                    z=z+1;
                        infoWindow.open(map, marker);

                        latit = marker.getPosition().lat();
                        longit = marker.getPosition().lng();
                        // console.log("lat: " + latit);
                        // console.log("lng: " + longit);
                    }
                })(marker, i));

                marker.addListener('click', function() {
                    directionsService.route({
                        // origin: document.getElementById('start').value,
                        origin: myLatLng,

                        // destination: marker.getPosition(),
                        destination: {
                            lat: latit,
                            lng: longit
                        },
                        travelMode: 'DRIVING'
                    }, function(response, status) {
                        if (status === 'OK') {
                            directionsDisplay.setDirections(response);
                        } else {
                            window.alert('Directions request failed due to ' + status);
                        }
                    });

                });
                // Automatically center the map fitting all markers on the screen
                // map.fitBounds(bounds);
                map.setZoom(16); 
                map.setCenter(new google.maps.LatLng(latitude, longitude));
       
    }

            // Loop through our array of markers & place each one on the map
           
        }

        // function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        //     directionsService.route({
        //         // origin: document.getElementById('start').value,
        //         origin: myLatLng,
        //         destination: marker.getPosition(),
        //         travelMode: 'DRIVING'
        //     }, function(response, status) {
        //         if (status === 'OK') {
        //             console.log('all good');
        //             directionsDisplay.setDirections(response);
        //         } else {
        //             window.alert('Directions request failed due to ' + status);
        //         }
        //     });
        // }

        function geoError() {
            alert("Geocoder failed.");
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
                // alert("Geolocation is supported by this browser.");
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>

    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkdyai5-p_kXTroX-gSz_mz-xeQ8Ht1iY&callback=getLocation"></script>












    <script src="js/common.min.js"></script>
</body>

</html>