<?php
include('config.php');
$contributionid=$_REQUEST['contributionid'];
$query="delete from contributions where contributionid=$contributionid ";
$result=pg_query($dbconn,$query);
?>