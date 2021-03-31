<?php
include('header.php');
include('session.php');
include('config.php');
$date=$_REQUEST['date']
$sql="alter table ucontributions alter column duedate set default $date";
pg_query($dbconn,$sql)
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
	<form>
		<label>Closure date</label>
		<input type="date" name="date" placeholder="MM-DD-YYYY">
	</form>
	<?php echo "duedate:'".$date."'"  ?>
</body>
</html>