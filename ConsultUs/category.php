<?php

include_once './header_local.php';
include_once '../common/header_module.php';

// $servername = "localhost";
// $username = "root";
// $password = "";
$servername = "3.109.14.4";
$username = "ostechnix";
$password = "Password123#@!";
$dbname = "spaceece";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$check = "SELECT * FROM consultant_category ";

$run = mysqli_query($conn, $check);
if($run ){


while($row=mysqli_fetch_assoc($run)){
 
?>

<div class="col-lg-4 col-md-6 blog-item">

				<a href="cdetails.php?category=<?php echo $row['cat_name']  ?>">
					<img src='<?php echo "../img/consult_category/".$row['cat_img']?>' style="" alt=""></a>
				<h5><a href="#"> </a></h5>
				<div class="blog-meta">
					<!--<span><i class="fa fa-user"></i>Parth Thosani</span>
						<span><i class="fa fa-clock-o"></i>04 Feb 2019</span>-->
				</div>
				<p> </p>
			</div>

<?php
}

}
