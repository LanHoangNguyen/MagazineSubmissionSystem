<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php  include('header.php');
	include('session.php');
	include('config.php');
	function getFalcultyById($id){
		global $dbconn;
		$result=pg_query($dbconn, "select falcultyname from falculties where falcultyid=$id");
		return pg_fetch_assoc($result)['falcultyname'];
	}
	$loggedfalcultyid=$user_check['falcultyid'];
	$sql="select * from contribution where falcultyid=$loggedfalcultyid";
	$result=pg_query($dbconn,$sql);
	while($row=pg_fetch_assoc($result)){
			$contributionname=$row['contributionname'];
			$releasedate=strftime("%b,%d,%Y",strtotime($row['releasedate']));
			$contributionfile=$row['contributionfile'];
			$duedate=$row['duedate'];
		}
	?>
	<a href="logout.php">Logout</a> 
	<main>
		<?php
		while($row=pg_fetch_assoc($result)){
			?>
			<div class="container">
				<img class="card-img-top" src="data:image/jpg;base64,$row['contributionfile']">
				<div class="card-body">
					<h4 class="card-title"><?php echo $contributionname ?></h4>
					<p class="card-text"><?php echo $releasedate ?></p>
					<p class="card-text"><?php echo $duedate ?></p>
				</div>
				<div class="card-footer">
					<a class="btn btn-primary" href="contributiondetail.php">Read</a>
				</div>
			</div>
			<?php
		}
		?>
	</main>
</body>
</html>