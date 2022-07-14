<?php
require_once("../../includes/dbconn.php");
$distance=$_GET['distance'];
    $ret = "SELECT * from pm_hotel;";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    $cnt = 1;
    $locationarray = array();
    while ($row = $res->fetch_object()) {
        $locationarray[] = $row;
    }
    $hosteldata = json_encode($locationarray);

?>

<script>
    var hostelid= new Array();
var distance=<?php echo $distance; ?>;
     function distanceCalculator(mk1, mk2) {
            var R = 3958.8; 
            var rlat1 = mk1[0] * (Math.PI / 180); 
            var rlat2 = mk2[0] * (Math.PI / 180); 
            var difflat = rlat2 - rlat1; 
            var difflon = (mk2[1] - mk1[1]) * (Math.PI / 180); 

            var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat / 2) * Math.sin(difflat / 2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.sin(difflon / 2) * Math.sin(difflon / 2)));
          if(Math.ceil(d * 1.6)<=distance){
            return 1;
          }else{
            return 0;
          }
            
        }


var hosteldata = <?php echo $hosteldata; ?>;
var myposition= new Array();            
const options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

function success(pos) {
  const crd = pos.coords;
  myposition.push(crd.latitude);
  myposition.push(crd.longitude);
  for (x in hosteldata) {
    let hostelposition= new Array();
    hostelposition.push(hosteldata[x].lat)
    hostelposition.push(hosteldata[x].lng)
    let flag=distanceCalculator(myposition, hostelposition) 
    if(flag==1){
        hostelid.push(hosteldata[x].id)
        document.write(hosteldata[x].id)
        
    }  
}
// document.write(hostelid)
if(hostelid.length==0){
    window.location.href='../rooms.php?message=There is no Hostel witin this area of search'; 
}else{
var arrStr = encodeURIComponent(JSON.stringify(hostelid));
window.location.href='../rooms.php?rooms='+ arrStr; 
}

 
}

function error(err) {
  document.write(`Error: ${err.message}`);
}

navigator.geolocation.getCurrentPosition(success, error, options);



    </script>







<!-- if ($res->num_rows > 0) {
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


        }
    }
} else {
    echo "Sorry No Hostel Found ";
} -->