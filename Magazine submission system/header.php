<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./bootstrap-5.0.0-beta2-dist/css/bootstrap.css">
    <script src="./bootstrap-5.0.0-beta2-dist/js"></script>
</head>
<body>
	<header>
		<img src="banner.PNG" alt="magazine banner">
	</header>
	<nav>
		<ul list-style-type:none>
			<li>Welcome <?php echo $login_session; ?></li>
			<li><a href = "logout.php">Sign Out</a></li>
		</ul>
	</nav>
</body>
</html>