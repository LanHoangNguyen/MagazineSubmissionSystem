<?php
include('header.php');
include('session.php');
include('config.php');
if(isset($_POST['set'])){
	$date=$_POST['date'];
    $sql="ALTER TABLE contributions ALTER COLUMN duedate SET DEFAULT '$date'";
    pg_query($dbconn,$sql);
    echo "closure date is set";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./bootstrap-5.0.0-beta2-dist/css/bootstrap.css">
    <script src="./bootstrap-5.0.0-beta2-dist/js/bootstrap.js"></script>
</head>
<body>
	<form method="POST">
		<label>Closure date</label>
		<input type="date" name="date" placeholder="MM-DD-YYYY">
		<input type="submit" name="set">
	</form>
</body>
</html>