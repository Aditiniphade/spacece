<?php
  //bug Id-0000030-0000031  

if (isset($_COOKIE['error_msg'])) {
    echo "
        <div class='alert alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>". $_COOKIE['error_msg'] . "</b>
        </div>
    ";
}
include('indexDB.php');
include("main.php");
$name = $_GET['fullname'];
$email = $_GET['email'];
$feed = $_GET['feedback'];

$sql= "INSERT INTO `feedback`(`user_name`, `feedback`, `email`) VALUES ('$name','$feed','$email')";
// echo $sql;die;
$res = mysqli_query($conn,$sql);
$feedback=mysqli_fetch_assoc($res);
if (!mysqli_error($conn)){
  //  bug Id-0000030-0000031  
    setcookie('success_msg', 'Your feedback is successfully submitted', time()+3, "/");

    header('Location:contact.php' );
}
else{
      //bug Id-0000030-0000031  

    setcookie('success_msg', 'YOUR FEEDBACK WAS NOT SENT', time() + 3, "/");

    header('Location:contact.php' );
}




?>