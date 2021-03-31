<?php  
include('header.php');
include('session.php');
include('config.php');
$sql="select * from contributions";
$result=pg_query($dbconn,$sql);
while($row=pg_fetch_array($result)){
	$contributionname=$row['contributionname'];
	$releasedate=strftime("%b,%d,%Y",strtotime($row['releasedate']));
	$contributionfile=$row['contributionfile'];
	$duedate=$row['duedate'];
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
	<nav>
		<a href="logout.php">Log out</a>
	</nav>
	<main>
		<?php
		while($row=pg_fetch_assoc($result)){
			?>
			<div class="container">
				<img class="card-img-top" src="uploads/$contributionname">
				<div class="card-body">
					<h4 class="card-title"><?php echo $contributionname ?></h4>
					<p class="card-text"><?php echo $releasedate ?></p>
					<p class="card-text"><?php echo $duedate ?></p>
				</div>
				<div class="card-footer">
					<a class="btn btn-primary" href="generalcontributiondetail.php">Read</a>
				</div>
			</div>
			<?php
		}
		?>
	</main>
</body>
</html>