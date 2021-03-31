<?php
include('header.php');
include('session.php');
include('config.php');
function getContributionCountByFalculty($id){
	global $dbconn;
	$sql="select count(*) as totalContribution from contributions inner join users on contributions.userid=users.userid where falcultyid=$id ";
	$result=pg_query($dbconn, $sql);
	return $result['totalContribution'];
}
function getContributionPercentageByFalculty($id){
	global $dbconn;
	$sql="select count(*) as totalContribution from contributions inner join users on contributions.userid=users.userid where falcultyid=$id ";
	$result=pg_query($dbconn, $sql);
	$sql2="select count(*) as allContributions from contributions";
	$total=pg_query($dbconn, $sql2);
	$percentage=($result*100)/$total;
	return $percentage
}
function getStudentCountByFalculty($id){
	global $dbconn;
	$sql="select count(*) as totalContributors from users where roleid=1 and falcultyid=$id";
	$result=pg_query($dbconn, $sql);
	return $result['totalContributors'];
}
function getPostWithoutComment(){
	global $dbconn;
	$sql="select count(*) as commentedContributions from comments inner join contributions on comments.contributionid = contributions.contributionid ";
	$result=pg_query($dbconn, $sql);
	$sql2="select count(*) as totalComments from comments"
	$total=pg_query($dbconn, $sql);
	return $total-$result;
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
	<h2>Statistics</h2>
	<p>The number of contributions per falculty are: </p>
	<ul>
		<li>Business:<?php echo getContributionCountByFalculty(1) ?></li>
		<li>Education, Health and Human Sciences:<?php echo getContributionCountByFalculty(2) ?></li>
		<li>Engineering and Science:<?php echo getContributionCountByFalculty(3) ?></li>
		<li>Liberal Arts and Sciences:<?php echo getContributionCountByFalculty(4) ?></li>
	</ul>
	<p>The percentage of contributions per falculty are:<p>
	<ul>
		<li>Business:<?php echp getContributionPercentageByFalculty(1) ?></li>
		<li>Education, Health and Human Sciences:<?php echp getContributionPercentageByFalculty(2) ?></li>
		<li>Engineering and Science:<?php echp getContributionPercentageByFalculty(3) ?></li>
		<li>Liberal Arts and Sciences:<?php echp getContributionPercentageByFalculty(4) ?></li>
	</ul>
	<p>Number of contributors in each falculty:</p>
	<ul>
		<li>Business:<?php echo getStudentCountByFalculty(1) ?></li>
		<li>Education, Health and Human Sciences:<?php echo getStudentCountByFalculty(2) ?></li>
		<li>Engineering and Science:<?php echo getStudentCountByFalculty(3) ?></li>
		<li>Liberal Arts and Sciences:<?php echo getStudentCountByFalculty(4) ?></li>
	</ul>
	<h2>Exceptional data</h2>
	<p>The number of contributions without comments:<?php echo getPostWithoutComment() ?>
</body>
</html>