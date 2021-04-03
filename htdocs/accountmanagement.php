<?php
include('header.php');
include('session.php');
include('config.php');
$username="";
$email="";
$password="";
$falcultyid=0;
$roleid=0;
$userid=0;
$update=false;

if (isset($_POST['save'])){
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$falcultyid=$_POST['falcultyid'];
	$roleid=$_POST['roleid'];

	pg_query($dbconn,"INSERT INTO users(username, email, password, falcultyid, roleid) VALUES ('$username','$email','$password',$falcultyid,$roleid)");
	$_SESSION['message'] = "User saved";
	header("Location: accountmanagement.php");
}
if (isset($_GET['edit'])){
	$userid=$_GET['edit'];
	$update=true;
	$record=pg_query($dbconn,"SELECT * FROM users WHERE userid=$userid");

	if (count($record) == 1 ){
		$u=pg_fetch_array($record);
		$username=$u['username'];
		$email=$u['email'];
		$password=$u['password'];
		$falcultyid=$u['falcultyid'];
		$roleid=$u['roleid'];
	}
}
if (isset($_POST['update'])){
	$userid=$_POST['userid'];
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$falcultyid=$_POST['falcultyid'];
	$roleid=$_POST['roleid'];

	pg_query($dbconn,"UPDATE users SET username='$username', email='$email',password='$password', falcultyid=$falcultyid, roleid=$roleid WHERE userid=$userid");
	$_SESSION['message'] = "User updated!";
	header("Location: accountmanagement.php");
}
if (isset($_GET['del'])){
	$userid=$_GET['del'];
	pg_query($dbconn,"DELETE FROM users WHERE userid=$userid");
	$_SESSION['message'] = "User deleted!";
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
    <link rel="stylesheet" type="text/css" href="account.css">
</head>
<body>
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
			    echo $_SESSION['message']; 
			    unset($_SESSION['message']);
		    ?>
		</div>
	<?php endif ?>
	<?php $results=pg_query($dbconn, "SELECT * FROM users"); ?>
	<table>
		<thead>
			<th>Username</th>
			<th>Email</th>
			<th>Password</th>
			<th>Falculty ID</th>
			<th>Role ID</th>
			<th colspan = "2">Action</th>
		</thead>
		<?php while ($row = pg_fetch_array($results)) { ?>
			<tr>
				<td><?php echo $row['username'] ?></td>
				<td><?php echo $row['email'] ?></td>
				<td><?php echo $row['password'] ?></td>
				<td><?php echo $row['falcultyid'] ?></td>
				<td><?php echo $row['roleid'] ?></td>
				<td>
					<a href="accountmanagement.php?edit=<?php echo $row['userid']; ?>" class="edit_btn">Edit</a>
				</td>
				<td>
					<a href="accountmanagement.php?del=<?php echo $row['userid']; ?>" class="del_btn">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</table>
	<h2 style="text-align:center">Account creation</h2>
	<div class="container">
		<form name="account" action="accountmanagement.php" method="POST">
			<input type="hidden" name="userid" value="<?php echo $userid; ?>">
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" value="<?php echo $password; ?>" required>
			</div>
			<div class="form-group">
				<label>Falculty(1-Business 2-Education,Health and Sciences 3-Engineering andScience 4-Liberal Arts and Sciences</label>
				<input type="number" name="falcultyid" min="1" max="4" value="<?php echo $falcultyid; ?>" required>
			</div>
			<div class="form-group">
				<label>Role(1-student 2-marketing coordinator 3-marketing manager 4-admin 5-guest</label>
				<input type="number" name="roleid" min="1" max="5" value="<?php echo $roleid; ?>" required>
			</div>
			<div class="form-group">
				<?php if ($update == true): ?>
					<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
				<?php else: ?>
					<button name="save" type="submit" class="btn">Save</button>
				<?php endif ?>
			</div>
		</form>
	</div>
</body>
</html>