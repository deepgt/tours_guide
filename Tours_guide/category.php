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

$con=mysqli_connect ("localhost", 'root', '','mapboxproject');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // get category
    $sqldata = mysqli_query($con,"select id from category");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;
    }
    
?>
<script defer> 
  window.onload = function() {
    var category = <?= getCategory() ?>;
    var title = document.getElementsByClassName("news-card__title");
    var description = document.getElementsByClassName("news-card__excerpt");
    var image = document.getElementsByClassName("news-card__image");
    for (var i =0 ; i<category.length; i++){
        title[i].innerHTML = category[i][1];
        description[i].innerHTML = category[i][2];
        image[i].src = category[i][3];
        }
}
</script>

<div class="content-wrapper">
  
<?php
  for($x=0;$x<count($rows);$x++){
  ?>

  <div class="news-card">
    <a href="subcategory.php?myid=<?= $x+1 ?>" class="news-card__card-link"></a>
    <img src="images/temple.jpg" alt="" class="news-card__image">
    <div class="news-card__text-wrapper">
      <h2 class="news-card__title">Amazing First Title</h2>
      <div class="news-card__details-wrapper">
        <p class="news-card__excerpt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est pariatur nemo tempore repellat? Ullam sed officia iure architecto deserunt distinctio, pariatur&hellip;</p>
      </div>
    </div>
  </div>
  
  <?php
  }
  ?>
</div>


<?php 
include 'footer.php';
?>