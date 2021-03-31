<?php
require('config.php');
$userid=$_REQUEST['userid'];
$query="delete form users where userid=$userid";
$result=pg_query($dbconn,$query);
header("Location: accountlisting.php")
?>