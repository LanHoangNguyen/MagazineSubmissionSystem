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
	<?php  include('header.php');
	include('session.php');
	include('config.php');
	 ?>
	<a href="logout.php">Logout</a>
	<p>Please click the following button</p>
	<button><a href="./studentview.php">View your contributions</a></button>
	<button><a href="./contributionupload.php">Upload your contributions</a></button>
</body>
</html>