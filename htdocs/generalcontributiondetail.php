<?php  
include('header.php');
include('session.php');
include('config.php');
if(isset($_GET['id'])){
	$contributionid= $_GET['id'];
	$sql=pg_query($dbconn,"SELECT * FROM contributions WHERE contributionid=".$contributionid." limit 1");
	$contributionCount=pg_num_rows($sql);
	if($contributionCount>0){
		while($row=pg_fetch_array($sql)){
			$contributionname=$row['contributionname'];
			$releasedate=strftime("%b,%d,%Y",strtotime($row['releasedate']));
			$duedate=$row['duedate'];
			$destination="uploads/$contributionname";
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $contributionname ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./bootstrap-5.0.0-beta2-dist/css/bootstrap.css">
    <script src="./bootstrap-5.0.0-beta2-dist/js/bootstrap.js"></script>
</head>
<body>
	<h1><?php echo $contributionname ?></h1>
	<strong>Posted date: <?php echo $releasedate ?></strong>
	<br>
	<strong>Due date: <?php echo $duedate ?></strong>
	<iframe src="<?php echo $destination ?>" width="100%" height="500"></iframe>
</body>
</html>