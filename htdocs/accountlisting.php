<?php
include('header.php');
include('session.php');
include('config.php');
function getFalcultyById($id){
	global $dbconn;
	$sql="select falcultyname from falculties where falcultyid=$id";
	$result=pg_query($dbconn,$sql);
	echo $result['falcultyname'];
}
function getRoleById($id){
	global $dbconn;
	$sql="select rolename from roles where roleid=$id";
	$result=pg_query($dbconn,$sql);
	echo $result['rolename'];
}

$sql="select * from users";
$result=pg_query($dbconn,$sql);
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
	<table width = "100%" border = "1" cellspacing = "1" cellpadding = "1">
		<tr>
			<td>Userid</td>
			<td>Username</td>
			<td>Email</td>
			<td>Password</td>
			<td>Falculty</td>
			<td>Role</td>
			<td colspan = "2">Action</td>
		</tr>
		<?php while ($row=pg_fetch_assoc($result)){ ?>
			<tr>
				<td><?php echo $row['userid'] ?></td>
				<td><?php echo $row['username'] ?></td>
				<td><?php echo $row['email'] ?></td>
				<td><?php echo $row['password'] ?></td>
				<td><?php getFalcultyById($row['falcultyid']) ?></td>
				<td><?php getRoleById($row['roleid']) ?></td>
				<td><a href="deleteaccount.php?userid = <?php echo $row['userid'] ?>" onclick="return confirm('Are You Sure')">Delete</a> | 
					<a href="editaccount.php?userid =  <?php echo $row['userid'];?>">Edit</a>
				</td>
			</tr>
		<?php } ?>
	</table>
</body>
</html>