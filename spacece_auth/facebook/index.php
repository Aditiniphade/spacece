<?php


include 'config.php';
//include './db.php';
$facebook_output='';
$facebook_helper=$facebook->getRedirectLoginHelper();
if(isset($_GET['code'])){
	if(isset($_SESSION['sccess_token'])){

		$access_token=$_SESSION['sccess_token'];

	}else{

		$access_token=$facebook_helper->getAccessToken();
		$_SESSION['sccess_token']=$access_token;
		$facebook->setDefaultAccessToken($_SESSION['sccess_token']);

	}
	$graph_response=$facebook->get("/me?fields=name,email",$access_token);
	$facebook_user_info=$graph_response->getGraphUser();
	
	
	//$sql="Insert into social_login (email,name) VALUES('".$facebook_user_info['name']."','" .$facebook_user_info['email']."')";
	// if(!empty($facebook_user_info['name'])){
	// 	$_SESSION['user_name']=$facebook_user_info['name'];
	// }
	// if(!empty($facebook_user_info['email'])){
	// 	$_SESSION['user_email_address']=$facebook_user_info['email'];
	// }
	$email=$facebook_user_info['email'];
	$name=$facebook_user_info['name'];

	$check = "SELECT * FROM users WHERE u_email = '$email'";

 $run = mysqli_query($conn, $check);

  
 if (mysqli_num_rows($run) > 0) {
    $check1 = "SELECT * FROM users u INNER JOIN consultant c ON u.u_id = c.u_id WHERE u.u_email ='$email'";

    $run1 = mysqli_query($conn, $check1);
    if (mysqli_num_rows($run1) > 0) {
        $row1 = mysqli_fetch_assoc($run1);
        $_SESSION['current_user_id'] = $row1['u_id'];
    $_SESSION['current_user_email'] = $row1['u_email'];
    $_SESSION['current_user_name'] = $row1['u_name'];
    $_SESSION['current_user_mob'] = $row1['u_mob'];
    $_SESSION['current_user_image'] = $row1['u_image'];
    $_SESSION['current_user_type'] = $row1['u_type'];
    $_SESSION['space_active'] = $row1['space_active'];

    $_SESSION["consultant_category"] = $row1['c_category'];
    $_SESSION["consultant_office"] = $row1['c_office'];
    $_SESSION["consultant_from_time"] = $row1['c_from_time'];
    $_SESSION["consultant_to_time"] = $row1['c_to_time'];
    $_SESSION["consultant_language"] = $row1['c_language'];
    $_SESSION["consultant_fee"] = $row1['c_fee'];
    $_SESSION["consultant_available_from"] = $row1['c_available_from'];
    $_SESSION["consultant_available_to"] = $row1['c_available_to'];
    $_SESSION["consultant_qualification"] = $row1['c_qualification'];
     //echo "Exist";
    }else{
        $row = mysqli_fetch_assoc($run);
        $_SESSION['current_user_id'] = $row['u_id'];
    $_SESSION['current_user_email'] = $row['u_email'];
    $_SESSION['current_user_name'] = $row['u_name'];
    $_SESSION['current_user_mob'] = $row['u_mob'];
    $_SESSION['current_user_image'] = $row['u_image'];
    $_SESSION['current_user_type'] = $row['u_type'];
    $_SESSION['space_active'] = $row['space_active'];

    }
//     //echo json_encode(array('status' => 'error', "message" => "Email already exists!"));
//     //die(); 
// } else {
//     if ($type == 'consultant') {
//         $c_categories = $_POST['c_categories'];
//         $c_office = $_POST['c_office'];
//         $c_from_time = $_POST['c_from_time'];
//         $c_to_time = $_POST['c_to_time'];
//         $c_language = $_POST['c_language'];
//         $c_fee = $_POST['c_fee'];
//         // $c_available_from = $_POST['c_available_from'];
//         // $c_available_to = $_POST['c_available_to'];
//         $c_available_days=$_POST['selectedItem'];
//         $c_qualification = $_POST['c_qualification'];
//         $redirectUrl = '../index.php';
//         $sql = "INSERT INTO users (u_name, u_email, u_password, u_mob, u_image, u_type) VALUES ('$name', '$email', '$hashed_password', '$phone', '$image', '$type')";

//         $result = mysqli_query($conn, $sql);

//         $last_id = mysqli_insert_id($conn);

//         $query = "INSERT INTO consultant (u_id, c_category, c_office, c_from_time, c_to_time, c_language, c_fee, c_available_from,c_aval_days) 
//       VALUES ($last_id, $c_categories, '$c_office', '$c_from_time', '$c_to_time', '$c_language', '$c_fee', '$c_qualification','$c_available_days')";
//     } else if ($type == 'customer') {
//         $query = "INSERT INTO users (u_name, u_email, u_password, u_mob, u_image) VALUES ('$name', '$email', '$hashed_password', '$phone', '$image')";
//         $redirectUrl = '../index.php';
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => "Invalid user type!"));
//         die();
//     }

}else{
    $type="user";

    $sql = "INSERT INTO users (u_name, u_email,  u_type) VALUES ('$name', '$email',  '$type')";
    $result = mysqli_query($conn, $sql);
}
}else{
	$facebook_permissions=['email'];
	$facebook_login_url=$facebook_helper->getLoginUrl('https://spacefoundation.in/test/SpacECE-PHP/',$facebook_permissions);
	//$facebook_login_url='<a href="'.$facebook_login_url.'"></a>';


	echo ' <a id="facebook-button" href="'.$facebook_login_url.'" class="btn btn-block btn-social btn-facebook">
	<i class="fa fa-facebook"></i> Sign in with Facebook
  </a>';
}
?>

