<?php  
include('header.php');
include('session.php');
include('config.php');
include('contributionupload.php');
if(isset($_GET['contributionid'])){
	$contributionid=preg_replace('#[^0-9]', '', $_GET['contributionid']);
	$sql=pg_query($dbconn,"select * from contributions where contributionid=".$contributionid." limit 1");
	$contributionCount=pg_num_rows($sql);
	if($contributionCount>0){
		while($row=pg_fetch_array($sql)){
			$contributionname=$row['contributionname'];
			$releasedate=strftime("%b,%d,%Y",strtotime($row['releasedate']));
			$contributionfile=$row['contributionfile'];
			$duedate=$row['duedate'];
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
	<strong>>Posted date: <?php echo $releasedate ?></strong>
	<strong>Due date: <?php echo $duedate ?></strong>
	<iframe src="<?php echo $destination ?>" style="width: 90% height=500px"></iframe>
</body>
</html>