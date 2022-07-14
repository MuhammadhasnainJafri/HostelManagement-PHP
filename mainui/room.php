<?php
require_once("../includes/dbconn.php");
$id = $_GET['id'];


?>
<?php
$room = "SELECT * from `rooms` where `hostel_id`='$id';";
$result = $mysqli->prepare($room);
$result->execute(); //ok
$result = $result->get_result();
$room = $result->fetch_object();
$hostel = "SELECT * from `pm_hotel` where `id`='$id' limit 1;";
$result = $mysqli->prepare($hostel);
$result->execute(); //ok
$result = $result->get_result();
$hostel = $result->fetch_object();
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Superior Double Bed Private Ensuite | Hosteller</title>
    <script id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>
    <script src="https://www.youtube.com/player_api"></script>
    <link rel="stylesheet preload" as="style" href="css/preload.min.css" />
    <link rel="stylesheet preload" as="style" href="css/libs.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="css/room.min.css" />
</head>

<body>
    <?php
    include 'partials/header.php';
    ?>
    <header class="page">
        <div class="container">
            <ul class="breadcrumbs d-flex flex-wrap align-content-center">
                <li class="list-item">
                    <a class="link" href="index.html">Home</a>
                </li>

                <li class="list-item">
                    <a class="link" href="rooms.html">Rooms</a>
                </li>
                <li class="list-item">
                    <a class="link" href="#"><?php
                                                echo $hostel->title
                                                ?></a>
                </li>
            </ul>
            <h1 class="page_title"><?php
                                    echo $hostel->title
                                    ?></h1>
        </div>
    </header>
    <!-- single room content start -->
    <main>
        <!-- room section start -->
        <div class="room section">
            <div class="container">
                <div class="room_main d-lg-flex flex-wrap align-items-start">
                    <div class="room_main-slider col-12 d-lg-flex">
                        <div class="room_main-slider_view col-lg-8">
                            <div class="swiper-wrapper">
                                <?php


                                $ret = "SELECT * from `hostel_images` where `hostel_id`='$id' ";
                                $stmt = $mysqli->prepare($ret);
                                //$stmt->bind_param('i',$aid);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                $cnt = 1;
                                if ($res->num_rows == 0) {
                                ?>

                                    <div class="swiper-slide">
                                        <picture>
                                            <source data-srcset="../hostel_images/081351pmroom2.jpg" srcset="../hostel_images/081351pmroom2.jpg" />
                                            <img class="lazy" data-src="../hostel_images/081351pmroom2.jpg" src="../hostel_images/081351pmroom2.jpg" alt="media" />
                                        </picture>
                                    </div>
                                <?php

                                }
                                while ($row = $res->fetch_object()) {
                                ?>


                                    <div class="swiper-slide">
                                        <picture>
                                            <source data-srcset="<?php
                                                                    echo $row->image_url;
                                                                    ?>" srcset="<?php
                                                                                echo $row->image_url;
                                                                                ?>" />
                                            <img class="lazy" data-src="<?php
                                                                        echo $row->image_url;
                                                                        ?>" src="<?php
                                                                                    echo $row->image_url;
                                                                                    ?>" alt="media" />
                                        </picture>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="swiper-controls d-flex align-items-center justify-content-between">
                                <a class="swiper-button-prev d-inline-flex align-items-center justify-content-center" href="#">
                                    <i class="icon-arrow_left icon"></i>
                                </a>
                                <a class="swiper-button-next d-inline-flex align-items-center justify-content-center" href="#">
                                    <i class="icon-arrow_right icon"></i>
                                </a>
                            </div>
                        </div>
                        <div class="room_main-slider_thumbs">
                            <div class="swiper-wrapper">
                                <?php


                                $ret = "SELECT * from `hostel_images` where `hostel_id`='$id' ";
                                $stmt = $mysqli->prepare($ret);
                                //$stmt->bind_param('i',$aid);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                $cnt = 1;
                                while ($row = $res->fetch_object()) {
                                ?>

                                    <div class="swiper-slide">
                                        <picture>
                                            <source data-srcset="<?php
                                                                    echo $row->image_url;
                                                                    ?>" srcset="<?php
                                                                                echo $row->image_url;
                                                                                ?>" />
                                            <img class="lazy" data-src="<?php
                                                                        echo $row->image_url;
                                                                        ?>" src="<?php
                                                                                    echo $row->image_url;
                                                                                    ?>" alt="media" />
                                        </picture>
                                    </div>
                                <?php
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                    <div class="room_main-info col-lg-8">

                        <div class="description">
                            <p class="description_text">
                                <?php
                                echo $hostel->subtitle;
                                ?>
                            </p>

                        </div>


                        <?php



                        $ret = "SELECT * from mess where hostel_id='$id' ";
                        $stmt = $mysqli->prepare($ret);
                        //$stmt->bind_param('i',$aid);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        $cnt = 1;
                        if ($res->num_rows > 0) {
                        ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <hr>
                                            <h4 class="text-center">Mess Schedules</h4>
                                            <div class="table-responsive">

                                                <table class="table table-striped table-hover table-bordered no-wrap" border="1">
                                                    <thead class="thead-dark">
                                                        <tr>

                                                            <th>Day</th>
                                                            <th>Breakfast</th>
                                                            <th>Lunch</th>
                                                            <th>Dinner</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($row = $res->fetch_object()) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $row->day; ?></td>
                                                                <td><?php echo $row->recipy_morning; ?></td>
                                                                <td><?php echo $row->recipy_noon; ?></td>
                                                                <td><?php echo $row->recipy_eve; ?></td>



                                                            </tr>
                                                        <?php
                                                            $cnt = $cnt + 1;
                                                        } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        }
                        ?>


                        <section class="facilities">

                            <div class="">
                                <div class="row">
                                    <?php
                                    $ret = "SELECT * from facilities where `hostel_id`='$id' ";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    $cnt = 1;
                                    $checkbox = array();
                                    $i = 0;
                                    if ($res->num_rows > 0) {
                                        echo '<h4 class="facilities_header">Room facilities</h4>';
                                    }
                                    while ($row = $res->fetch_object()) {


                                    ?>
                                        <span class="col-4 align-items-center">
                                            <span class="icon">

                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 415.859 415.859" style="enable-background:new 0 0 415.859 415.859;" xml:space="preserve" width="32" height="32">
                                                    <g>
                                                        <g>
                                                            <path style="fill:#73D0F4;" d="M172.743,243.39c-2.166,2.568-5.309,4.111-8.666,4.254c-3.363,0.141-6.617-1.129-8.994-3.504    l-32.221-32.219h-81.02l120.965,116.045L377.425,82.533h-69.031L172.743,243.39z" />
                                                            <path style="fill:#3D6889;" d="M414.786,65.572c-1.947-4.287-6.219-7.039-10.928-7.039H302.815c-3.537,0-6.895,1.561-9.174,4.264    L162.817,217.933l-26.498-26.498c-2.252-2.25-5.303-3.514-8.486-3.514H12.001c-4.898,0-9.307,2.977-11.135,7.521    c-1.826,4.547-0.709,9.746,2.826,13.137l151.568,145.406c2.24,2.148,5.219,3.34,8.307,3.34c0.176,0,0.352-0.004,0.527-0.012    c3.275-0.143,6.35-1.621,8.508-4.088L412.892,78.431C415.991,74.888,416.731,69.859,414.786,65.572z M162.808,327.967    L41.843,211.922h81.02l32.221,32.219c2.377,2.375,5.631,3.645,8.994,3.504c3.357-0.143,6.5-1.686,8.666-4.254l135.65-160.857    h69.031L162.808,327.967z" />
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <script xmlns="" />
                                                </svg>


                                                <!-- <svg
                                                    width="32"
                                                    height="32"
                                                    viewBox="0 0 32 32"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M27.9997 14.7341V7.33329C27.9997 7.15648 27.9294 6.98691 27.8044 6.86189C27.6794 6.73686 27.5098 6.66663 27.333 6.66663H4.66634C4.48953 6.66663 4.31996 6.73686 4.19494 6.86189C4.06991 6.98691 3.99967 7.15648 3.99967 7.33329V14.7341C3.24737 14.8887 2.57136 15.2979 2.0856 15.8928C1.59985 16.4877 1.33405 17.2319 1.33301 18V26C1.33301 26.1768 1.40325 26.3463 1.52827 26.4714C1.65329 26.5964 1.82286 26.6666 1.99967 26.6666H4.66634C4.84315 26.6666 5.01272 26.5964 5.13775 26.4714C5.26277 26.3463 5.33301 26.1768 5.33301 26V22.6666H26.6663V26C26.6663 26.1768 26.7366 26.3463 26.8616 26.4714C26.9866 26.5964 27.1562 26.6666 27.333 26.6666H29.9997C30.1765 26.6666 30.3461 26.5964 30.4711 26.4714C30.5961 26.3463 30.6663 26.1768 30.6663 26V18C30.6654 17.2319 30.3996 16.4877 29.9138 15.8928C29.4281 15.2979 28.752 14.8886 27.9997 14.7341ZM5.33301 7.99996H26.6663V14.6666H23.9997V11.3333C23.9997 11.1565 23.9294 10.9869 23.8044 10.8619C23.6794 10.7369 23.5098 10.6666 23.333 10.6666H17.9997C17.8229 10.6666 17.6533 10.7369 17.5283 10.8619C17.4032 10.9869 17.333 11.1565 17.333 11.3333V14.6666H14.6663V11.3333C14.6663 11.1565 14.5961 10.9869 14.4711 10.8619C14.3461 10.7369 14.1765 10.6666 13.9997 10.6666H8.66634C8.48953 10.6666 8.31996 10.7369 8.19494 10.8619C8.06991 10.9869 7.99967 11.1565 7.99967 11.3333V14.6666H5.33301V7.99996ZM22.6663 14.6666H18.6663V12H22.6663V14.6666ZM13.333 14.6666H9.33301V12H13.333V14.6666ZM29.333 25.3333H27.9997V22C27.9997 21.8231 27.9294 21.6536 27.8044 21.5286C27.6794 21.4035 27.5098 21.3333 27.333 21.3333H4.66634C4.48953 21.3333 4.31996 21.4035 4.19494 21.5286C4.06991 21.6536 3.99967 21.8231 3.99967 22V25.3333H2.66634V18C2.66692 17.4697 2.87782 16.9613 3.25277 16.5864C3.62772 16.2114 4.13609 16.0005 4.66634 16H27.333C27.8633 16.0005 28.3716 16.2114 28.7466 16.5864C29.1215 16.9613 29.3324 17.4697 29.333 18V25.3333Z"
                                                        fill="currentColor"
                                                    />
                                                </svg> -->
                                            </span>
                                            <?php
                                            echo $row->facilityName;
                                            ?>
                                        </span>
                                    <?php
                                    }
                                    ?>


                                </div>

                            </div>
                        </section>
                        <!-- <section class="rules">
                                <h4 class="rules_header">Hostel rules</h4>
                                <div class="rules_list d-md-flex flex-lg-wrap">
                                    <div class="rules_list-block">
                                        <p class="rules_list-block_item d-flex align-items-baseline">
                                            <i class="icon-check icon"></i>
                                            Time of arrival is after 14-00. Time of departure is to 12-00
                                        </p>
                                        <p class="rules_list-block_item d-flex align-items-baseline">
                                            <i class="icon-check icon"></i>
                                            Does a settlement take place only at complete payment
                                        </p>
                                        <p class="rules_list-block_item d-flex align-items-baseline">
                                            <i class="icon-check icon"></i>
                                            Is there a settlement in hostel only after the presence of passport
                                        </p>
                                    </div>
                                    <div class="rules_list-block">
                                        <p class="rules_list-block_item d-flex align-items-baseline">
                                            <i class="icon-check icon"></i>
                                            Cum sociis natoque penatibus et. Sed elementum tempus egestas sed
                                        </p>
                                        <p class="rules_list-block_item rules_list-block_item--highlight d-flex align-items-start">
                                            <i class="icon-check icon"></i>
                                            Volutpat odio facilisis mauris sit amet massa vitae tortor condimentum. Quam elementum pulvinar
                                            etiam non quam lacus suspendisse. Eget gravida cum sociis natoque
                                        </p>
                                    </div>
                                </div>
                            </section>
                            <div class="rating">
                                <span class="rating_summary">
                                    <span class="h2">4.25</span>
                                    <sup class="h4">/5</sup>
                                </span>
                                <div class="rating_list d-flex flex-wrap">
                                    <div class="rating_list-item d-sm-flex align-items-center justify-content-between" data-order="1">
                                        <span class="label">Location</span>
                                        <span class="progressLine" id="location" data-value="4.7" data-fill="#0DA574"></span>
                                    </div>
                                    <div class="rating_list-item d-sm-flex align-items-center justify-content-between" data-order="2">
                                        <span class="label">Comfort</span>
                                        <span class="progressLine" id="comfort" data-value="4.5" data-fill="#0DA574"></span>
                                    </div>
                                    <div class="rating_list-item d-sm-flex align-items-center justify-content-between" data-order="3">
                                        <span class="label">Pricing</span>
                                        <span class="progressLine" id="pricing" data-value="4.9" data-fill="#0DA574"></span>
                                    </div>
                                    <div class="rating_list-item d-sm-flex align-items-center justify-content-between" data-order="4">
                                        <span class="label">Service</span>
                                        <span class="progressLine" id="service" data-value="4.8" data-fill="#0DA574"></span>
                                    </div>
                                </div>
                            </div>  -->
                    </div>
                    <div class="room_main-cards col-lg-4">
                        <div class="room_main-cards_card"style="width:100%" >
                      
                                            <?php
                                           
                                            $ret = "SELECT * from hostel_prices where hostel_id='$id' ";
                                            $stmt = $mysqli->prepare($ret);
                                            //$stmt->bind_param('i',$aid);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            $cnt = 1;
                                            if($res->num_rows > 0){?>
  <table id="zero_config" class="table table-striped table-hover table-bordered no-wrap">
                                        <thead class="thead-dark">
                                            <tr>
                                                

                                                <th>Seater</th>

                                                <th>Fees Per Month</th>

                                               
                                            </tr>
                                        </thead>
                                        <tbody>

<?php
                                            while ($row = $res->fetch_object()) {
                                            ?>
                                                <tr>
                                                    
                                                    <td><?php echo $row->seater; ?></td>
                                                    <td>RS <?php echo $row->price; ?></td>
                                                    

                                                </tr>
                                            <?php
                                                $cnt = $cnt + 1;
                                            }?>
                                        </tbody>
                                    </table>
                                        
                                        
                                        
                                   <?php     }else{
                                                echo "<h3 class='d-inline'>Price  </h3><h5 class='float-right;d-inline'>RS-".$room->fees."</h5>";
                                            } ?>
                                        


                            
                            <!-- <form class="booking" action="#" method="post" autocomplete="off" data-type="booking">
                                    <div class="booking_group d-flex flex-column">
                                        <label class="booking_group-label h5" for="checkIn">Check-in</label>
                                        <div class="booking_group-wrapper">
                                            <i class="icon-calendar icon"></i>
                                            <input
                                                class="booking_group-field field required"
                                                data-type="date"
                                                data-start="true"
                                                type="text"
                                                id="checkIn"
                                                name="contactsDate"
                                                placeholder="Add arrival date"
                                                readonly
                                            />
                                            <i class="icon-chevron_down icon"></i>
                                        </div>
                                    </div>
                                    <div class="booking_group d-flex flex-column">
                                        <label class="booking_group-label h5" for="checkOut">Check-out</label>
                                        <div class="booking_group-wrapper">
                                            <i class="icon-calendar icon"></i>
                                            <input
                                                class="booking_group-field field required"
                                                data-type="date"
                                                data-end="true"
                                                type="text"
                                                id="checkOut"
                                                name="contactsDate"
                                                placeholder="Add departure date"
                                                readonly
                                            />
                                            <i class="icon-chevron_down icon"></i>
                                        </div>
                                    </div>
                                    <button class="booking_btn btn theme-element theme-element--accent" type="submit">Book now</button>
                                </form> -->
                            <button class="booking_btn btn theme-element theme-element--accent" type="submit" onclick="window.location.href='registerroom.php?id=<?php
                                                                                                                                                                    echo $id;
                                                                                                                                                                    ?>'">Book now</button>

                        </div>

                    </div>
                </div>


            </div>
        </div>
        <!-- room section start -->
        <!-- recommendation section start -->

        <!-- recommendation section end -->
        <!-- stages section start -->

        <!-- stages section end -->
        <!-- rooms section start -->
        <section class="rooms section--blockbg section">
            <div class="block"></div>
            <div class="container">
                <div class="rooms_header d-sm-flex justify-content-between align-items-center">
                    <h2 class="rooms_header-title" data-aos="fade-right">Other rooms</h2>
                    <div class="wrapper" data-aos="fade-left">
                        <a class="btn theme-element theme-element--light" href="rooms.html">View all Hostels</a>
                    </div>
                </div>




                <ul class="rooms_list d-md-flex flex-wrap">
                    <?php
                    $ret = "SELECT * from pm_hotel limit 3;";
                    $stmt = $mysqli->prepare($ret);
                    $stmt->execute(); //ok
                    $res = $stmt->get_result();
                    $cnt = 1;
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
                            <li class="rooms_list-item col-md-6 col-xl-4" data-order="1" data-aos="fade-up">
                                <div class="item-wrapper d-md-flex flex-column">
                                    <div class="media">
                                        <picture>

                                            <img class="lazy" src="<?php
                                                                    echo $hostel_images->image_url;
                                                                    ?>" alt="media" />
                                        </picture>
                                        <span class="media_label media_label--pricing">
                                            <span class="price h4"> <?php echo $room->fees; ?></span>
                                            / 1 month
                                        </span>
                                    </div>
                                    <div class="main d-md-flex flex-column justify-content-between flex-grow-1">
                                        <a class="main_title h4" href="room.php?id=<?php echo $row->id; ?>" data-shave="true">
                                            <?php echo $row->title; ?>
                                        </a>
                                        <div class="main_amenities">

                                            <span class="main_amenities-item d-inline-flex align-items-center">
                                                <!-- <i class="icon-bunk_bed icon"></i> -->
                                                <!-- <?php // echo $room->seater;
                                                        ?> Seater -->
                                            </span>
                                        </div>
                                        <a class="link link--arrow d-inline-flex align-items-center" href="room.php?id=<?php echo $row->id; ?>">
                                            Book room
                                            <i class="icon-arrow_right icon"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                    <?php
                        }
                    }
                    ?>


                </ul>
            </div>
        </section>
        <!-- rooms section end -->
        <div class="container-fluid">

            <!-- Table Starts -->


            <!-- Table Ends -->

        </div>
        <!-- single room content start -->
    </main>
    <footer class="footer accent">
        <div class="container">
            <div class="footer_main d-sm-flex flex-wrap flex-lg-nowrap justify-content-between">
                <div class="footer_main-block footer_main-block--about col-sm-7 col-lg-auto d-flex flex-column">
                    <a class="brand d-flex align-items-center" href="index.html">
                        <span class="brand_logo theme-element">
                            <svg id="brandFooter" width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.03198 3.80281V7.07652L3.86083 9.75137L0.689673 12.4263L0.667474 6.56503C0.655304 3.34138 0.663875 0.654206 0.686587 0.593579C0.71907 0.506918 1.4043 0.488223 3.87994 0.506219L7.03198 0.529106V3.80281ZM21.645 4.36419V5.88433L17.0383 9.76316C14.5046 11.8966 11.2263 14.6552 9.75318 15.8934L7.07484 18.145V20.3225V22.5H3.85988H0.64502L0.667303 18.768L0.689673 15.036L2.56785 13.4609C3.60088 12.5946 6.85989 9.85244 9.81009 7.36726L15.1741 2.84867L18.4096 2.8464L21.645 2.84413V4.36419ZM21.645 15.5549V22.5H18.431H15.217V18.2638V14.0274L15.4805 13.7882C15.8061 13.4924 21.5939 8.61606 21.6236 8.61248C21.6353 8.61099 21.645 11.7351 21.645 15.5549Z" fill="currentColor" />
                            </svg>
                        </span>
                        <span class="brand_name">Hosteller</span>
                    </a>
                    <p class="footer_main-block_text">
                        Ut tellus elementum sagittis vitae et leo duis ut. Sit amet consectetur adipiscing elit duis. Ultrices gravida
                        dictum fusce ut placer orci nulla pellentesque
                    </p>
                </div>
                <div class="footer_main-block footer_main-block--nav col-sm-6 col-lg-auto">
                    <h4 class="footer_main-block_header">Quick links</h4>
                    <ul class="footer_main-block_nav d-flex flex-lg-column">
                        <li class="list-item">
                            <a class="link underlined underlined--white nav-item" data-page="home" href="index.html">Home</a>
                        </li>
                        <li class="list-item">
                            <a class="link underlined underlined--white nav-item" data-page="about" href="about.html">About</a>
                        </li>
                        <li class="list-item">
                            <a class="link underlined underlined--white nav-item" data-page="rooms" href="rooms.html">Rooms</a>
                        </li>
                        <li class="list-item">
                            <a class="link underlined underlined--white nav-item" data-page="news" href="news.html">News</a>
                        </li>
                    </ul>
                </div>
                <div class="footer_main-block footer_main-block--contacts col-sm-5 col-lg-auto">
                    <h4 class="footer_main-block_header">Contact Us</h4>
                    <ul class="footer_main-block_contacts">
                        <li class="list-item d-flex">
                            <i class="icon-location icon"></i>
                            <p class="wrapper">
                                <span class="linebreak"> 54826 Fadel Circles </span>
                                <span class="linebreak"> Darrylstad, AZ 90995 </span>
                            </p>
                        </li>
                        <li class="list-item d-flex">
                            <span class="icon-call icon">
                                <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M26.9609 19.75L21 17.1797C20.7812 17.125 20.5625 17.0703 20.3438 17.0703C19.7969 17.0703 19.3047 17.2891 19.0312 17.6719L16.625 20.625C12.7969 18.7656 9.73438 15.7031 7.875 11.875L10.8281 9.46875C11.2109 9.19531 11.4297 8.70312 11.4297 8.15625C11.4297 7.9375 11.375 7.71875 11.3203 7.5L8.75 1.53906C8.47656 0.9375 7.875 0.5 7.21875 0.5C7.05469 0.5 6.94531 0.554688 6.83594 0.554688L1.3125 1.86719C0.546875 2.03125 0 2.6875 0 3.50781C0 17.3438 11.2109 28.5 24.9922 28.5C25.8125 28.5 26.4688 27.9531 26.6875 27.1875L27.9453 21.6641C27.9453 21.5547 27.9453 21.4453 27.9453 21.2812C27.9453 20.625 27.5625 20.0234 26.9609 19.75ZM24.9375 26.75C12.1406 26.75 1.75 16.3594 1.75 3.5625L7.16406 2.30469L9.67969 8.15625L5.6875 11.4375C8.36719 17.0703 11.4297 20.1328 17.1172 22.8125L20.3438 18.8203L26.1953 21.3359L24.9375 26.75Z" fill="currentColor" />
                                </svg>
                            </span>
                            <p class="wrapper d-flex flex-column">
                                <a class="link" href="tel:+1234567890">(329) 580-7077</a>
                                <a class="link" href="tel:+1234567890">(650) 382-5020</a>
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="footer_main-block footer_main-block--follow col-sm-5 col-lg-auto d-flex flex-column">
                    <h4 class="footer_main-block_header">Follow Us</h4>
                    <p class="footer_main-block_text">Venenatis urna cursus eget nunc scelerisque</p>
                    <ul class="socials d-flex align-items-center">
                        <li class="list-item">
                            <a class="link" href="">
                                <i class="icon-facebook"></i>
                            </a>
                        </li>
                        <li class="list-item">
                            <a class="link" href="">
                                <i class="icon-instagram"></i>
                            </a>
                        </li>
                        <li class="list-item">
                            <a class="link" href="">
                                <i class="icon-twitter"></i>
                            </a>
                        </li>
                        <li class="list-item">
                            <a class="link" href="">
                                <i class="icon-whatsapp"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer_copyright">
            <div class="container">
                <p class="footer_copyright-text">
                    <span class="linebreak">Merkulove &copy; Hosteller Template</span>
                    <span class="linebreak">All rights reserved Copyrights 2021</span>
                </p>
            </div>
        </div>
    </footer>
    <script src="js/common.min.js"></script>
    <script src="js/room.min.js"></script>
</body>

</html>