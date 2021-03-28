<?php 
include('config.php');
session_start();
$user_check=$_SESSION['login_user'];
$sql="select username from public.users where username='$user_check' ";
$ses_sql=pg_query($dbconn,$sql);
$row=pg_fetch_array($ses_sql,PGSQL_ASSOC);
$login_session=$row['username'];
if(!isset($_SESSION['login_user'])){
	header("Location:login.php");
	die();
}