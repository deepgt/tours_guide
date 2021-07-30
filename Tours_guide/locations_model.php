<?php
require("db.php");

// Gets data from URL parameters.
if(isset($_GET['add_location'])) {
    add_location();
}

function getCategory(){
    $con=mysqli_connect ("localhost", 'root', '','mapboxproject');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // get category
    $sqldata = mysqli_query($con,"select * from category");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;
    }
    $indexed = array_map('array_values', $rows);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
}


function add_location(){
    $con=mysqli_connect ("localhost", 'root', '','mapboxproject');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    $name = $_GET['name'];
    $address = $_GET['address'];
    $type= $_GET['type'];
    // Inserts new row with place data.
    $query = sprintf("INSERT INTO locations " .
        " (id,name, address, lat, lng, type) " .
        " VALUES (NULL, '%s', '%s', '%s', '%s', '%s');",
        mysqli_real_escape_string($con,$name),
        mysqli_real_escape_string($con,$address),
        mysqli_real_escape_string($con,$lat),
        mysqli_real_escape_string($con,$lng),
        mysqli_real_escape_string($con,$type),
    
    );

    $result = mysqli_query($con,$query);
    echo json_encode("Inserted Successfully");
    if (!$result) {
        die('Invalid query: ' . mysqli_error($con));
    }
}
function get_saved_locations(){
    $con=mysqli_connect ("localhost", 'root', '','mapboxproject');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // update location with location_status if admin location_status.
    $sqldata = mysqli_query($con,"select lng,lat from locations ");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }
    $indexed = array_map('array_values', $rows);

    //  $array = array_filter($indexed);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
}

// function get_location_detail(){
//     $con=mysqli_connect ("localhost", 'root', '','mapboxproject');
//     if (!$con) {
//         die('Not connected : ' . mysqli_connect_error());
//     }
//     // update location with location_status if admin location_status.
//     $sqldata = mysqli_query($con,"select * from locations ");

//     $geojson = array();
    
//     while($row = mysqli_fetch_assoc($sqldata)) {
//         $marker = array(
//             'type' => 'Feature',
//             "geometry" => array(
//                 'type' => 'Point',
//                 'coordinates' => array(
//                     $row['lng'],
//                     $row['lat']
//                 )
//             ),
//             "properties" =>  array(
//                 "name" => $row['name'],
//                 "description" => $row["description"],
//                 "image" => $row["image"],
//             )
//             );
//       array_push($geojson, $marker);
//     }

//     echo json_encode($geojson); 
// }
