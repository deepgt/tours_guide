<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Demo: map</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />

<link rel="stylesheet" type="text/css" href="css/homepage.css">
<link rel="stylesheet" type="text/css" href="css/category.css">
<link rel="stylesheet" type="text/css" href="css/subcategory.css">
<link rel="stylesheet" type="text/css" href="css/detail.css">
<script src="js\popup.js" ></script>

<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
<link
href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css"
rel="stylesheet"
/>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<!-- icons -->
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

<!-- mail -->
<script src=
    "https://smtpjs.com/v3/smtp.js">
  </script>
<!-- Import Mapbox GL Directions -->
<script src=https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.js></script>
<link rel="stylesheet" href=https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.css type="text/css" />

<!-- Load the `mapbox-gl-geocoder` plugin. -->
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css">
 
<!-- Promise polyfill script is required -->
<!-- to use Mapbox GL Geocoder in IE 11. -->
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
 
<!-- Import Mapbox GL Draw -->
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.0.9/mapbox-gl-draw.js"></script>
<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.0.9/mapbox-gl-draw.css"
type="text/css"
/>
<!-- Import jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>
<body>
    <div class="container">
    <navbar>
        <a href="category.php"><div class="logo"><img src="images/logo_mapbox_project.png" alt="logo"></div></a>
        <div class="exit-intent-popup">
            <div class="newsletter">
                <b style="padding: 10px">was our site helpful, please review us? 📬</b>
                <p style="padding: 10px">Rate us!</p>
                <input style="padding: 15px" type="text" placeholder="your comment" class="email" id="comment" />
                <button style="margin-top: 15px" class="submit" onclick='sentmail(<?php echo(json_encode($_SESSION["username"])) ?>)'>submit</button>
                <div onclick="exit()" style="cursor: pointer" class="close">x</div>
            </div>
            <div style="cursor: pointer" class="skipnlogout"><a href="logout.php">skip and logout >>></a></div>
        </div>

        <div onclick="popup()" class="logoutbutton">
            <ul class="navbar" style="cursor: pointer" >
                <li><a>Logout</a></li>
            </ul>
        </div> 
        
    </navbar>