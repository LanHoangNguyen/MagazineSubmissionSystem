<?php
include('config.php');
if (isset($_GET['del'])) {
	$userid=$_GET['del'];
    $query="delete form users where userid=$userid";
    $result=pg_query($dbconn,$query);
    header("Location: accountlisting.php");
} else
{
	"Account deletion failed";
}
?>