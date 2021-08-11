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
function getSubCategory(){
    $id = $_GET["myid"];
    $con=mysqli_connect ("localhost", 'root', '','mapboxproject');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // get category
    $sqldata = mysqli_query($con,"select * from subcategory where $id = categoryid");
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

function getid(){
	$id = $_GET["myid"];
	echo $id;
}

$id = $_GET["myid"];
    $con=mysqli_connect ("localhost", 'root', '','mapboxproject');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // get category
    $sqldata = mysqli_query($con,"select * from subcategory where $id = categoryid");
    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;
    }

?>
<script defer> 
	var lat=[]; 
	var lng=[]; 
	var categoryid = <?php getid() ?>;
  var id = [];
  var subcategorys = <?php getSubCategory()?>;
 	window.onload = function() {
		var subcategory = <?php getSubCategory()?>;
		var title = document.getElementsByClassName("news-card__title");
		var description = document.getElementsByClassName("news-card__excerpt");
		var image = document.getElementsByClassName("news-card__image");
    
		for (var i =0 ; i<subcategory.length; i++){
      id[i] = subcategory[i][0];
			title[i].innerHTML = subcategory[i][3];
			description[i].innerHTML = subcategory[i][4];
			lat[i] = subcategory[i][1];
			lng[i] = subcategory[i][2];
			image[i].src = subcategory[i][5];
    }
  }

</script>

<div class="content-wrapper">
<?php 
  for($x=0;$x<count($rows);$x++){
    ?>
    
      <div class="news-card">
        
        <img src="images/temple.jpg" alt="" class="news-card__image">
        <div class="news-card__text-wrapper">
          <h2 class="news-card__title">Amazing First Title</h2>
          <div class="news-card__details-wrapper">
            <p class="news-card__excerpt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est pariatur nemo tempore repellat? Ullam sed officia iure architecto deserunt distinctio, pariatur&hellip;</p>
          </div>
          <a class="btn btn-white btn-animation-1" href="detail.php"
          onclick="location.href=this.href+'?id='+subcategorys[<?= $x ?>][0];return false;">
            show details
          </a>
      </div>

      
  </div>
 
  <?php
  }
?>
</div>
<?php 
include 'footer.php';
?>