<?php include('indexDB.php');
include_once './includes/header1.php'; ?>
<?php
$user = '';
if(isset($_SESSION['current_user_email'])){
    $email = $_GET['current_user_email'];
    $user= $_SESSION['current_user_name'];
} else{
    header('location:../spacecce_auth/login.php');
    exit();
}


 ?>
<html>
    <head>
        <title>appointment-HOME PAGE</title>
        <link rel="stylesheet"  href="css/admin.css">
    </head>
    <body style="background: linear-gradient(to bottom right, #ffcc99 0%, #ffffff 100%);">
        <! ... menu section starts...>
        <!-- <div class="menu text-center" style="background-color:orange;">
            <div class="wrapper">
<img src="img/space.jpg" alt="" style="width:6%;"><br><br>
                <ul>
                    <li><a href="index2.php?user=<?php // $user ?>">HOME</a></li>
                    <li><a href="alldoc.php?user=<?php// echo $user ?>">CONSULTANT</a></li>
                </ul>
            </div>
        </div> -->

                <table class="tb-full">
                    <tr>
                        <th>S.NO.</th>
                        <th>CID:</th>
                        <th>CATEGORY:</th>
                        <th>USERNAME:</th>
                        <th>CONSULTANT NAME</th>
                        <th>CONSULTANT MOB</th>
                        <th>A_DATE:</th>
                        <th>A_TIME:</th>
                        <th>STATUS:</th>
                        <th>EMAIL:</th>
                        <th>MOBILE NUMBER:</th>
                        <th>UID:</th>
                        <th>ACTION:</th>
                    </tr>
                    <?php
                    error_reporting(0);
                    // showing admin added from database
                    $sql = "SELECT * FROM `appointment` where `username`='$user'";
                    $res = mysqli_query($conn,$sql);


                    //checking whether query is excuted or not
                    if($res){
                        // count that data is there or not in database
                        $count= mysqli_num_rows($res);
                        $sno =1;
                        if($count>0){
                            // we have data in database
                            while($row = mysqli_fetch_assoc($res))
                            {
                                // extracting values from dATABASE

                                $id=$row['cid'];
                                $full_name=$row['username'];
                                $category=$row['category'];
                                $cname=$row['cname'];
                                $cmob=$row['com_mob'];
  
                                $date_appointment=$row['date_appointment'];
                                $time_appointment=$row['time_appointment'];
                                $email=$row['email'];
                                $mobile=$row['mobile'];
                                $uid=$row['bid'];
                                $status = $row['status'];
                                

                                
                                // displaying value in table
                        ?>
                        <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $cname; ?></td>
                         <td><?php echo $cmob; ?></td>
                        <td><?php echo $date_appointment; ?></td>
                        <td><?php echo $time_appointment; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $mobile; ?></td>
                        <td><?php echo $uid; ?></td>
                        <td><a href="<?php echo SITEURL;?>delete_appointment.php?id=<?php echo $uid;?>&user=<?php echo $user;?>" class="btn-three">DELETE APPOINTMENT</a>
                            <br><br><br>
                            <a href="<?php echo SITEURL;?>chatbot/room.php?roomname=bid<?php echo $uid;?>" class="btn-primary">CHAT</a>
                        </td>

                    </tr>

                    <?php
                    }
                }
                        else{
                            echo "sorry no appointment found";
                        }
                    }
                    ?>

                </table>     
            </div>
        </div>
      <?php
                 include_once './includes/header1.php';
?>
                 </body>


</html>