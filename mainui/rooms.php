<?php 
require_once("../includes/dbconn.php");
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
        <main class="rooms section">
            <div class="container">
                <ul class="rooms_list">

                <?php 
                        $ret="SELECT * from pm_hotel;";
                        $stmt= $mysqli->prepare($ret) ;
                        $stmt->execute() ;//ok
                        $res=$stmt->get_result();
                        $cnt=1;
                        while($row=$res->fetch_object())
                            {

                                $room="SELECT * from `rooms` where `hostel_id`='$row->id' limit 1;";
                                $result= $mysqli->prepare($room) ;
                                $result->execute() ;//ok
                                $result=$result->get_result();
                                $room=$result->fetch_object();
                                if($room){
                                   
                                
                
                        ?>

                    <li class="rooms_list-item" data-order="1" data-aos="fade-up">
                        <div class="item-wrapper d-md-flex">
                            <div class="media">
                                <picture>
                                    <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" />
                                    <img class="lazy" data-src="img/placeholder.jpg" src="img/placeholder.jpg" alt="media" />
                                </picture>
                            </div>
                            <div class="main d-md-flex justify-content-between">
                                <div class="main_info d-md-flex flex-column justify-content-between">
                                    <a class="main_title h4" href="room.php?id=<?php echo $row->id?>"><?php 
                                   echo $row->title;
                                    ?></a>
                                    <p class="main_description"><?php 
                                    echo $row->subtitle;
                                    ?></p>
                                    <div class="main_amenities">
                                       
                                        <span class="main_amenities-item d-inline-flex align-items-center">
                                            <i class="icon-bunk_bed icon"></i>
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
                                    <a class="theme-element theme-element--accent btn" href="#">Book now</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php 
                                }}
                    ?>
                   
                </ul>
            </div>
        </main>
        <!-- rooms page content end -->
        <?php 
        include 'partials/footer.php';
        ?>
        <script src="js/common.min.js"></script>
    </body>
</html>
