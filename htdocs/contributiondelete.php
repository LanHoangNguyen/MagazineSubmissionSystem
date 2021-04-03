<?php
include('config.php');
if(isset($_GET['id'])){
	$contributionid=$_GET['id'];
    $query="delete from contributions where contributionid= $contributionid ";
    $result=pg_query($dbconn,$query);
    header("Location:contributionlist.php");
} else{
	echo "contribution deletion failed";
}

?>