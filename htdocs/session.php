<?php 
include('config.php');
session_start();
$user_check=$_SESSION['login_user'];
$sql="select * from public.users where username='$user_check' ";
$ses_sql=pg_query($dbconn,$sql);
$row=pg_fetch_assoc($ses_sql);
$login_session=$row['username'];
$loggeduserid=$row['userid'];
$loggedfalcultyid=$row['falcultyid'];
if(!isset($_SESSION['login_user'])){
	header("Location:login.php");
	die();
}
?>