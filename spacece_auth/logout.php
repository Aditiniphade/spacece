<?php
session_start();
if (isset($_SESSION['current_user_id']))
    unset($_SESSION['current_user_id']);
if (isset($_SESSION['current_user_email']))
    unset($_SESSION['current_user_email']);
if (isset($_SESSION['current_user_name']))
    unset($_SESSION['current_user_name']);
if (isset($_SESSION['current_user_mob']))
    unset($_SESSION['current_user_mob']);
if (isset($_SESSION['current_user_image']))
    unset($_SESSION['current_user_image']);
if (isset($_SESSION['current_user_type']))
    unset($_SESSION['current_user_type']);
// $google_client->revokeToken();
$redirect_url = $_SERVER['HTTP_REFERER'];
session_destroy();
header('Location:./index.php');
//header("Location: " . $redirect_url);
