<?php
require_once("../includes/dbconn.php");
$city = $disthostel =$messageErr= "";
if (isset($_POST["city"])) {
    $city = $_POST['city'];
}
if (isset($_GET["rooms"])) {
    $disthostel = $_GET["rooms"];
    $disthostel = json_decode($disthostel);
}
if (isset($_GET["message"])) {
    $messageErr = $_GET["message"];
    $messageErr = $messageErr;
    // echo " <script>alert('There is no Hostel witin this area of search');window.location.href='rooms.php'</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Rooms | Hosteller</title>
    <script id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>
    <script src="https://www.youtube.com/player_api"></script>
    <link rel="stylesheet preload" as="style" href="css/preload.min.css" />
    <link rel="stylesheet preload" as="style" href="css/libs.min.css" />

    <link rel="stylesheet" href="css/rooms.min.css" />
</head>

<body>
    <?php
    include 'partials/header.php';
    ?>
    <header class="page">
        <div class="container">
            <ul class="breadcrumbs d-flex flex-wrap align-content-center">
                <li class="list-item">
                    <a class="link" href="index.php">Home</a>
                </li>

                <li class="list-item">
                    <a class="link" href="#">Hostel</a>
                </li>
            </ul>
            <h1 class="page_title">Hostel</h1>

        </div>
    </header>
    <!-- rooms page content start -->
    <select name="distance" onchange="distance(this.value)" class="form-control field required" style="margin-top: 50px;
    margin-left:20px">
        <option value="0">Search Hostel by distance</option>
        <option value="5">5 KM</option>
        <option value="10">10 KM</option>
        <option value="15">15 KM</option>
        <option value="20">20 KM</option>
    </select>
    <form method="POST" id="myForm" style="float: right;
padding-right: 50px;
padding-top: 50px;">
        <input type="text" name="city" class="form-control field required" placeholder="Search Hostel by city">
        <button type="submit" class="bg-info" class="form-control field " style="padding: 15px;
background: #5eba7d;
color: white;
border-radius: 20px;" onclick="
                            submitform()">Search</button>
    </form>
    <script>
        function submitform() {

            form = document.getElementById('myForm');
            const submitFormFunction = Object.getPrototypeOf(form).submit;
            submitFormFunction.call(form);
        }
    </script>
    <main class="rooms section">
        <div class="container">
            <ul class="rooms_list" id="rooms_list">

                <?php
                if($messageErr==""){
                if ($city != NULL) {
                    $ret = "SELECT * from pm_hotel where city like '%$city%';";
                } else if ($disthostel != NULL ) {
                    // $ret = "SELECT * from pm_hotel where `id` IN $disthostel";
                    $ret = 'SELECT * 
                    FROM `pm_hotel` 
                   WHERE `id` IN (' . implode(',', array_map('intval', $disthostel)) . ')';
                } else {
                    $ret = "SELECT * from pm_hotel;";
                }
                $stmt = $mysqli->prepare($ret);
                $stmt->execute(); //ok
                $res = $stmt->get_result();
                $cnt = 1;

                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_object()) {

                        $room = "SELECT * from `rooms` where `hostel_id`='$row->id' limit 1;";
                        $result = $mysqli->prepare($room);
                        $result->execute(); //ok
                        $result = $result->get_result();
                        $room = $result->fetch_object();
                        if ($room) {


                            $hostel_images = "SELECT * FROM `hostel_images` where `hostel_id`='$row->id' limit 1;";
                            $hostel_images = $mysqli->prepare($hostel_images);
                            $hostel_images->execute(); //ok
                            $hostel_images = $hostel_images->get_result();
                            $hostel_images = $hostel_images->fetch_object();



                ?>

                            <li class="rooms_list-item" data-order="1" data-aos="fade-up">
                                <div class="item-wrapper d-md-flex">
                                    <div class="media">
                                        <picture>

                                            <img class="lazy" src="<?php
                                            if($hostel_images==""){
                                                echo "../hostel_images/121932pm083908pmDSC2341.jpg";
                                            }else{
                                                 echo $hostel_images->image_url;
                                            }
                                                                   
                                                                    ?>" alt="IMAGE IS LOADING ..." />
                                        </picture>
                                    </div>
                                    <div class="main d-md-flex justify-content-between">
                                        <div class="main_info d-md-flex flex-column justify-content-between">
                                            <a class="main_title h4" href="room.php?id=<?php echo $row->id ?>"><?php
                                                                                                                echo $row->title;
                                                                                                                ?></a>
                                            <p class="main_description"><?php
                                                                        echo substr($row->subtitle, 0, 100);

                                                                        ?></p>
                                            <div class="main_amenities">

                                                <span class="main_amenities-item d-inline-flex align-items-center">
                                                    <i class="icon-location icon"></i>
                                                    <?php
                                                    echo $row->address
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="main_pricing d-flex flex-column align-items-md-end justify-content-md-between">
                                            <div class="wrapper d-flex flex-column">
                                                <span class="main_pricing-item">
                                                    <span class="h2"><?php
                                                                        echo $room->fees
                                                                        ?></span>
                                                    / 1 month
                                                </span>

                                            </div>
                                            <a class="theme-element theme-element--accent btn" href="registerroom.php?id=<?php echo $row->id ?>">Book now</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                <?php
                        }
                    }
                } else {
                    echo "Sorry No Hostel Found ";
                }}else {
                    echo $messageErr;
                }
                ?>

            </ul>
        </div>
    </main>
    <!-- rooms page content end -->
    <?php
    include 'partials/footer.php';
    ?>
    <script src="js/common.min.js"></script>
    <script>
        function distanceCalculator(mk1, mk2) {
            var R = 3958.8; // Radius of the Earth in miles
            var rlat1 = mk1.position.lat * (Math.PI / 180); // Convert degrees to radians
            var rlat2 = mk2.position.lat * (Math.PI / 180); // Convert degrees to radians
            var difflat = rlat2 - rlat1; // Radian difference (latitudes)
            var difflon = (mk2.position.lng - mk1.position.lng) * (Math.PI / 180); // Radian difference (longitudes)

            var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat / 2) * Math.sin(difflat / 2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.sin(difflon / 2) * Math.sin(difflon / 2)));
            return d * 1.6;
        }
        // distanceCalculator({
        //     "position": {
        //         "lat": 32.082466,
        //         "lng": 72.669128
        //     }
        // }, {
        //     "position": {
        //         "lat": 33.626057,
        //         "lng": 73.071442
        //     }
        // })

        function distance(value) {
            if (value != 0) {
                window.location.href="partials/searchbydistance.php?distance=" + value;
                
            }
        }
    </script>
    <?php 
    if (isset($_GET["message"])) {
      
        echo ' <script>window.history.pushState({}, document.title, "/" + "HostelManagement-PHP/mainui/rooms.php");</script>';
    }
    ?>

</body>

</html>