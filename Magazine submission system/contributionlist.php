<?php
include('header.php');
include('session.php');
include('config.php');
$sql="select * from contributions where userid=$loggeduserid";
$result=pg_query($dbconn,$sql)
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
	<h2>Your contributions</h2>
	<table width="100%" border="1" style="border-collapse:collapse;">
		<tr>
			<th><strong>Contribution name</strong></th>
			<th><strong>Release date</strong></th>
			<th><strong>Due date</strong></th>
			<th><strong>Delete</strong></th>
		</tr>
		<?php while($row=pg_fetch_assoc($result)){ ?>
			<tr>
				<td align="center"><?php echo $row['contributionname'] ?></td>
				<td align="center"><?php echo $row['releasedate'] ?></td>
				<td align="center"><?php echo $row['duedate'] ?></td>
				<td href="contributiondelete.php?id=<?php echo $row['contributionid'] ?>">Delete</td>
			</tr>
		<?php}?>
	</table>
</body>
</html>