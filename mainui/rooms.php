<?php 
require_once("../includes/dbconn.php");
$city="";
if(isset($_POST["city"])){
$city=$_POST['city'];}
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
        <form method="POST" id="myForm" style="float: right;
padding-right: 50px;
padding-top: 50px;" >
        <input type="text" name="city" class="form-control field required" placeholder="Search Hostel by city">
        <button type="submit" class="bg-info" class="form-control field " style="padding: 15px;
background: #5eba7d;
color: white;
border-radius: 20px;"  onclick="
                            submitform()">Search</button>
                </form>
                <script>
function submitform() {
   
    form=document.getElementById('myForm');
    const submitFormFunction = Object.getPrototypeOf(form).submit;
    submitFormFunction.call(form);
}

</script>
        <main class="rooms section">
            <div class="container">
                <ul class="rooms_list">

                <?php 
                        if($city!=NULL){
                        $ret="SELECT * from pm_hotel where city like '%$city%';";
                        }else{
                            $ret="SELECT * from pm_hotel;";
                        }
                        $stmt= $mysqli->prepare($ret) ;
                        $stmt->execute() ;//ok
                        $res=$stmt->get_result();
                        $cnt=1;
                        if($res->num_rows>0){
                        while($row=$res->fetch_object())
                            {

                                $room="SELECT * from `rooms` where `hostel_id`='$row->id' limit 1;";
                                $result= $mysqli->prepare($room) ;
                                $result->execute() ;//ok
                                $result=$result->get_result();
                                $room=$result->fetch_object();
                                if($room){


                                $hostel_images="SELECT * FROM `hostel_images` where `hostel_id`='$row->id' limit 1;";
                                $hostel_images= $mysqli->prepare($hostel_images) ;
                                $hostel_images->execute() ;//ok
                                $hostel_images=$hostel_images->get_result();
                                $hostel_images=$hostel_images->fetch_object();
                                
                
                        ?>

                    <li class="rooms_list-item" data-order="1" data-aos="fade-up">
                        <div class="item-wrapper d-md-flex">
                            <div class="media">
                                <picture>
                                    <source data-srcset="<?php
                                    echo $hostel_images->image_url;
                                    ?>" srcset="<?php
                                    echo $hostel_images->image_url;
                                    ?>" />
                                    <img class="lazy" data-src="<?php
                                    echo $hostel_images->image_url;
                                    ?>" src="<?php
                                    echo $hostel_images->image_url;
                                    ?>" alt="No IMage FOund" />
                                </picture>
                            </div>
                            <div class="main d-md-flex justify-content-between">
                                <div class="main_info d-md-flex flex-column justify-content-between">
                                    <a class="main_title h4" href="room.php?id=<?php echo $row->id?>"><?php 
                                   echo $row->title;
                                    ?></a>
                                    <p class="main_description"><?php 
                                    echo substr($row->subtitle,0,100);
                                    
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
                                    <a class="theme-element theme-element--accent btn" href="registerroom.php?id=<?php echo $row->id?>">Book now</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php 
                                }
                            }
                            }else{
                                echo "Sorry No Hostel Found ";
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
    </body>
</html>
