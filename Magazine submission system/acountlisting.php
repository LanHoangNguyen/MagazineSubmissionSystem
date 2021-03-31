<?php
include('header.php');
include('session.php');
include('config.php');
function getFalcultyById($id){
	global $dbconn;
	$sql="select falcultyname where falcultyid=$id";
	$result=pg_query($dbconn,$sql);
	return $result['falcultyname'];
}
function getRoleById($id){
	global $dbconn;
	$sql="select rolename where roleid=$id";
	$result=pg_query($dbconn,$sql);
	return $result['rolename'];
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
			<td>Username</td>
			<td>Email</td>
			<td>Password</td>
			<td>Falculty</td>
			<td>Role</td>
			<td colspan = "2">Action</td>
		</tr>
		<?php ($row=pg_fetch_assoc($result)){
			?>
			<tr>
				<td><?php echo $row['username'] ?></td>
				<td><?php echo $row['email'] ?></td>
				<td><?php echo $row['password'] ?></td>
				<td><?php echo getFalcultyById($row['falcultyid']) ?></td>
				<td><?php echo getRoleById($row['roleid']) ?></td>
				<td><a href="deleteaccount.php?id = <?php echo $row['userid'] ?>" onclick="return confirm('Are You Sure')">Delete</a> | 
					<a href="editaccount.php?id =  <?php echo $row['userid'];?>">Edit</a>
				</td>
			</tr>
		} ?>
	</table>
</body>
</html>