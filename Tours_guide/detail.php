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
?>
<?php
    
        $id = $_GET["id"];
        $con=mysqli_connect ("localhost", 'root', '','mapboxproject');
        if (!$con) {
            die('Not connected : ' . mysqli_connect_error());
        }
        // get category
        $sqldata = mysqli_query($con,"select * from subcategory where $id = id");
        $rows = array();
        while($r = mysqli_fetch_assoc($sqldata)) {
            $rows[] = $r;
        }
        
        if (!$rows) {
            return null;
        }

    function getid(){
        $id = $_GET["id"];
        echo $id;
    }

?>

<div class="detail_body">
    <div class="detail_slide">
        <div class="w3-content w3-display-container" style="max-width:800px">
        <img class="mySlides" src="<?= $rows[0]["image"] ?>" alt="image" style="width:100%">
        <img class="mySlides" src="<?= $rows[0]["image02"] ?>" style="width:100%">
        <img class="mySlides" src="<?= $rows[0]["image03"] ?>" style="width:100%">
        <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
            <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
            <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
            <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
            <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
            <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
        </div>
        </div>
    </div>
    <div class="text_body_container">
    <div class="detail_text">
        <div class="detail_name">
            <h3>location : <?= $rows[0]["name"] ?></h3>
            <p>description : <?= $rows[0]["description"] ?></p>
            <p>lat : <?= $rows[0]["lat"] ?></p>
            <p>lng : <?= $rows[0]["lng"] ?></p>
            </div>
    </div>
    <div class="showmapbutton">
        <a href="homepage.php?lat=<?= $rows[0]["lat"] ?>&lng=<?= $rows[0]["lng"] ?>&categoryid=<?= $rows[0]["categoryid"] ?>">
        <button>show on map</button>
        </a>
    </div>
</div>
</div>


<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
    showDivs(slideIndex += n);
    }

    function currentDiv(n) {
    showDivs(slideIndex = n);
    }

    function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" w3-white", "");
    }
    x[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " w3-white";
    }
</script>

<?php 
include 'footer.php';
?>