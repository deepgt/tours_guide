<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php
include_once 'header.php';
include 'locations_model.php';

function get_location(){
    $lat = $_GET["lat"];
    $lng = $_GET["lng"];
    $categoryid = $_GET["categoryid"];
    $con=mysqli_connect ("localhost", 'root', '','mapboxproject');
        if (!$con) {
            die('Not connected : ' . mysqli_connect_error());
        }
        // update location with location_status if admin location_status.
        $sqldata = mysqli_query($con,"select * from subcategory where $categoryid = categoryid " );
        $geojson = array();
        
        while($row = mysqli_fetch_assoc($sqldata)) {
            $marker = array(
                'type' => 'Feature',
                "geometry" => array(
                    'type' => 'Point',
                    'coordinates' => array(
                        $row['lng'],
                        $row['lat']
                    )
                ),
                "properties" =>  array(
                    "name" => $row['name'],
                    "description" => $row["description"],
                    "image" => $row["image"],
                )
                );
        array_push($geojson, $marker);
        }

        echo json_encode($geojson);
}

function get_lat(){
    $lat = $_GET["lat"];
    echo ($lat);
}

function get_lng(){
    $lng = $_GET["lng"];
    echo ($lng);
}

?>

<style>
    .geocoder {
        position: absolute;
        z-index: 1;
        width: 50%;
        left: 50%;
        margin-left: -25%;
        top: 70px;
    }
    .mapboxgl-ctrl-geocoder {
        min-width: 100%;
    }
    .mapboxgl-ctrl-geocoder input[type="text"] {
        margin: 0 0 0 20px;
    }
    

    #floatingmenu {
        width:30%;
        height: 100%;
        position:absolute;
        left:-30%;
        z-index:4;
        background:#000;
        -webkit-transition: all 700ms ease;
        -moz-transition: all 700ms ease;
        -ms-transition: all 700ms ease;
        -o-transition: all 700ms ease;
        transition: all 700ms ease;
        background-color:white;
}

    #floatingmenu:hover {
        width: 30%;
        left: 0%;
        -webkit-transition: all 700ms ease;
        -moz-transition: all 700ms ease;
        -ms-transition: all 700ms ease;
        -o-transition: all 700ms ease;
        transition: all 700ms ease;
    } 

    .container_floatingmenu{
        display:flex;

    }
    .icon{
        position: absolute;
        top: 50%;
        left: 100%;
        background: white;
        border-radius: 0 30px 34px 0;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;
    }

    .icon .fa{
        font-size:50px
    }
</style>
 


<div class="mapbody">
    <div class="map_body_top">
        <div id="map" class="map"></div>
        <div id="geocoder" class="geocoder"></div>
    </div>
            <div id="floatingmenu">
                <div class="container_floatingmenu"> 
                     <div class="sidebar">
                        <div class="heading">
                            <h4>locations</h4>
                        </div>      
                        <div id="listings" class="listings"></div>
                        <div class="icon"><i class="fa fa-angle-right"></i></div>
                </div>
            </div>
    </div>


        
    <!-- <div class="detail_location">
        <div id="listings" class="listings"></div>
    </div>     -->
    <!-- </div> -->
</div>

<script>
            
            //FILTERS RESET
    $('.magic-button').click(function(event) {
    event.preventDefault;
        $('.magic-content').toggleClass('on');
    });

    var lat;
    var log;

    /* This will let you use the .remove() function later on */
    if (!('remove' in Element.prototype)) {
        Element.prototype.remove = function () {
        if (this.parentNode) {
        this.parentNode.removeChild(this);
        }
        };
    }

    var locationlat =  <?= get_lat() ?>;
    var locationlng =  <?= get_lng() ?>;

    var locations = <?= get_location()?>;
    mapboxgl.accessToken = 'pk.eyJ1IjoiZGVlcDAwNyIsImEiOiJja3FraTUzY3YwaDhvMnJwaHR3cjAwajA4In0.-U5use8WURevACWoqgI7eQ';
    
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [85.314087, 27.700125],
        zoom: 10
    });

    // Add the control to the map.
    var geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
    mapboxgl: mapboxgl
    });
 
    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

    // initialize the map canvas to interact with later
    var canvas = map.getCanvasContainer();

    //stores
    var stores = {
        'type': 'FeatureCollection',
        'features': locations
    };
 
    // initialize the map canvas to interact with later
    var canvas = map.getCanvasContainer();

    /**
    * Assign a unique id to each store. You'll use this `id`
    * later to associate each point on the map with a listing
    * in the sidebar.
    */
    stores.features.forEach(function (store, i) {
        store.properties.id = i;
    });

    /**
    * Wait until the map loads to make changes to the map.
    */
    map.on('load', function (e) {

        /**
        * This is where your '.addLayer()' used to be, instead
        * add only the source without styling a layer
        */
        map.addSource('places', {
            'type': 'geojson',
            'data': stores
        });

          /**
        * Add all the things to the page:
        * - The location listings on the side of the page
        * - The markers onto the map
        */
        buildLocationList(stores);
        addMarkers();

        // Initialize the geolocate control.
        var geolocate = new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
            trackUserLocation: true
        });

        // Add the control to the map.
        map.addControl(geolocate);

         // Add zoom and rotation controls to the map.   
        map.addControl(new mapboxgl.NavigationControl());
        map.addControl(new mapboxgl.FullscreenControl());

        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(e) {
             lat = e.coords.latitude;
             log =  e.coords.longitude;
            map.fitBounds([
                [locationlng + 0.05,locationlat +0.05], // southwestern corner of the bounds
                [log-0.05,lat-0.05] // northeastern corner of the bounds
            ]); 

            // an arbitrary start will always be the same
            // only the end or destination will change
            var end = [locationlng,locationlat];
            var start = [log,lat];
            // make an initial directions request that
            // starts and ends at the same location
            getRoute(start);

            //userlocation
            map.addLayer({
                id: 'point',
                type: 'circle',
                source: {
                    type: 'geojson',
                    data: {
                    type: 'FeatureCollection',
                    features: [{
                        type: 'Feature',
                        properties: {},
                        geometry: {
                        type: 'Point',
                        coordinates: start
                        }
                    }
                    ]
                    }
                },
                paint: {
                    'circle-radius': 10,
                    'circle-color': '#3887be'
                }
            });

            
            getRoute(end)
            }
        )
    }

    });


    // create a function to make a directions request
    function getRoute(end) {
    // make a directions request using cycling profile
    // an arbitrary start will always be the same
    // only the end or destination will change
    var url = 'https://api.mapbox.com/directions/v5/mapbox/driving/' + log + ',' + lat+ ';' + end[0] + ',' + end[1] + '?alternatives=true&geometries=geojson&overview=full&steps=true&access_token=pk.eyJ1IjoiZGVlcDAwNyIsImEiOiJja3FraTJjOXYwMnU3MnVvNHV0NmdrenZqIn0.NFcuQzZXwz3vX2DQ4CAleQ';

    // make an XHR request https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
    var req = new XMLHttpRequest();
    req.open('GET', url, true);
    req.onload = function() {
        var json = JSON.parse(req.response);
        var data = json.routes[0];
        var route = data.geometry.coordinates;
        var geojson = {
        type: 'Feature',
        properties: {},
        geometry: {
            type: 'LineString',
            coordinates: route
        }
        };
        // if the route already exists on the map, reset it using setData
        if (map.getSource('route')) {
        map.getSource('route').setData(geojson);
        } else { // otherwise, make a new request
        map.addLayer({
            id: 'route',
            type: 'line',
            source: {
            type: 'geojson',
            data: {
                type: 'Feature',
                properties: {},
                geometry: {
                type: 'LineString',
                coordinates: geojson
                }
            }
            },
            layout: {
            'line-join': 'round',
            'line-cap': 'round'
            },
            paint: {
            'line-color': '#3887be',
            'line-width': 5,
            'line-opacity': 0.75
            }
        });
        }
        // add turn instructions here at the end
    };
    req.send();
    }
/**
* Add a marker to the map for every store listing.
**/
function addMarkers() {
    /* For each feature in the GeoJSON object above: */
    stores.features.forEach(function (marker) {
    /* Create a div element for the marker. */
    var el = document.createElement('div');
    /* Assign a unique `id` to the marker. */
    el.id = 'marker-' + marker.properties.id;
    /* Assign the `marker` class to each marker for styling. */
    el.className = 'marker';
    el.style.backgroundImage ='url('+marker.properties.image+')';
    el.style.width = '50px';
    el.style.height = '50px';
    el.style.backgroundSize = '100%';
    /**
    * Create a marker using the div element
    * defined above and add it to the map.
    **/
    new mapboxgl.Marker(el, { offset: [0, -23] })
    .setLngLat(marker.geometry.coordinates)
    .addTo(map);
    
    /**
    * Listen to the element and when it is clicked, do three things:
    * 1. Fly to the point
    * 2. Close all other popups and display popup for clicked store
    * 3. Highlight listing in sidebar (and remove highlight for all other listings)
    **/
    el.addEventListener('mouseenter', function (e) {
        createPopUp(marker);
        /* Highlight listing in sidebar */
        var activeItem = document.getElementsByClassName('active');
        e.stopPropagation();
        if (activeItem[0]) {
        activeItem[0].classList.remove('active');
        }
        var listing = document.getElementById(
        'listing-' + marker.properties.id
        );
        listing.classList.add('active');
        });

        
        el.addEventListener('click', function (e) {
            fitmap(marker);
            getRoute(marker.geometry.coordinates);
            });
});
}
 
    /**
    * Add a listing for each store to the sidebar.
    **/
    function buildLocationList(data) {
        data.features.forEach(function (store, i) {
            /**
            * Create a shortcut for `store.properties`,
            * which will be used several times below.
            **/
            var prop = store.properties;
            
            /* Add a new listing section to the sidebar. */
            var listings = document.getElementById('listings');
            var listing = listings.appendChild(document.createElement('div'));
            /* Assign a unique `id` to the listing. */
            listing.id = 'listing-' + prop.id;
            /* Assign the `item` class to each listing for styling. */
            listing.className = 'item';
        
            /* Add the link to the individual listing created above. */
            var link = listing.appendChild(document.createElement('a'));
            link.href = '#';
            link.className = 'title';
            link.id = 'link-' + prop.id;
            link.innerHTML = prop.name;
            
            /* Add details to the individual listing. */
            var details = listing.appendChild(document.createElement('div'));
                details.innerHTML = prop.description;
                if (prop.phone) {
                details.innerHTML += ' &middot; ' + prop.phoneFormatted;
                }
            
            /**
            * Listen to the element and when it is clicked, do four things:
            * 1. Update the `currentFeature` to the store associated with the clicked link
            * 2. Fly to the point
            * 3. Close all other popups and display popup for clicked store
            * 4. Highlight listing in sidebar (and remove highlight for all other listings)
            **/
                link.addEventListener('click', function (e) {
                    for (var i = 0; i < data.features.length; i++) {
                        if (this.id === 'link-' + data.features[i].properties.id) {
                            var clickedListing = data.features[i];
                            getRoute(clickedListing.geometry.coordinates);
                            // flyToStore(clickedListing);
                            fitmap(clickedListing);
                            // createPopUp(clickedListing);
                        }
                    }
                    var activeItem = document.getElementsByClassName('active');
                    if (activeItem[0]) {
                        activeItem[0].classList.remove('active');
                    }
                    this.parentNode.classList.add('active');
                });
        });
    }
 
/**
* Use Mapbox GL JS's `flyTo` to move the camera smoothly
* a given center point.
**/
function flyToStore(currentFeature) {
        map.flyTo({
        center: currentFeature.geometry.coordinates,
        zoom: 15
    });
}
   
function fitmap(currentFeature){
        map.fitBounds([
                [parseFloat(currentFeature.geometry.coordinates[0]) + 0.05,parseFloat(currentFeature.geometry.coordinates[1]) +0.05], // southwestern corner of the bounds
                [log - 0.05,lat -0.05] // northeastern corner of the bounds
            ]);
    };


/**
* Create a Mapbox GL JS `Popup`.
**/
function createPopUp(currentFeature) {
        var popUps = document.getElementsByClassName('mapboxgl-popup');
        if (popUps[0]) popUps[0].remove();
        var popup = new mapboxgl.Popup({ closeOnClick: false })
        .setLngLat(currentFeature.geometry.coordinates)
        .setHTML('<h3>'+ currentFeature.properties.name +'</h3>' +'<h4>' +currentFeature.properties.description +'</h4>')
        .addTo(map);
    }

</script>

<?php include 'footer.php' ?>
</body>
</html>















