<?php
include('header.php');
include('session.php');
include('config.php');
$query0="SELECT * FROM contributions";
$result0=pg_query($dbconn,$query0);
$total=pg_num_rows($result0);

$query1="SELECT * FROM cbf where falcultyid=1";
$result1=pg_query($dbconn,$query1);
$contributionCount1=pg_num_rows($result1);
$percentage1=($contributionCount1*100)/$total;

$query2="SELECT * FROM cbf where falcultyid=2";
$result2=pg_query($dbconn,$query2);
$contributionCount2=pg_num_rows($result2);
$percentage2=($contributionCount2*100)/$total;

$query3="SELECT * FROM cbf where falcultyid=3";
$result3=pg_query($dbconn,$query3);
$contributionCount3=pg_num_rows($result3);
$percentage3=($contributionCount3*100)/$total;

$query4="SELECT * FROM cbf where falcultyid=4";
$result4=pg_query($dbconn,$query4);
$contributionCount4=pg_num_rows($result4);
$percentage4=($contributionCount4*100)/$total;

$sql1="SELECT * FROM users WHERE falcultyid=1 and roleid=1";
$r1=pg_query($dbconn,$sql1);
$studentCount1=pg_num_rows($r1);

$sql2="SELECT * FROM users WHERE falcultyid=2 and roleid=1";
$r2=pg_query($dbconn,$sql2);
$studentCount2=pg_num_rows($r2);

$sql3="SELECT * FROM users WHERE falcultyid=3 and roleid=1";
$r3=pg_query($dbconn,$sql3);
$studentCount3=pg_num_rows($r3);

$sql4="SELECT * FROM users WHERE falcultyid=4 and roleid=1";
$r4=pg_query($dbconn,$sql4);
$studentCount4=pg_num_rows($r4);

$q="SELECT * FROM users where roleid=1";
$res=pg_query($dbconn,$q);
$q0="SELECT * FROM ubc ";
$res0=pg_query($dbconn,$q0);
$exceptionCount=pg_num_rows($res)-pg_num_rows($res0);
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
		<li>Business:<?php  echo $contributionCount1 ?></li>
		<li>Education, Health and Human Sciences:<?php echo $contributionCount2 ?></li>
		<li>Engineering and Science:<?php echo $contributionCount3 ?></li>
		<li>Liberal Arts and Sciences:<?php echo $contributionCount4 ?></li>
	</ul>
	<p>The percentage of contributions per falculty are:<p>
	<ul>
		<li>Business:<?php echo "$percentage1%" ?></li>
		<li>Education, Health and Human Sciences:<?php echo "$percentage2%" ?></li>
		<li>Engineering and Science:<?php echo "$percentage3%" ?></li>
		<li>Liberal Arts and Sciences:<?php echo "$percentage4%" ?></li>
	</ul>
	<p>Number of contributors in each falculty:</p>
	<ul>
		<li>Business:<?php echo $studentCount1 ?></li>
		<li>Education, Health and Human Sciences:<?php echo $studentCount2 ?></li>
		<li>Engineering and Science:<?php echo $studentCount3 ?></li>
		<li>Liberal Arts and Sciences:<?php echo $studentCount4 ?></li>
	</ul>
	<h2>Exceptional data</h2>
	<p>The number of contributors without contributions:<?php echo $exceptionCount ?></p>
</body>
</html>