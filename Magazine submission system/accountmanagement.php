<?php
include('header.php');
include('session.php');
include('config.php');
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
	$username=$_REQUEST['username'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password']
	$falcultyid=$_REQUEST['falcultyid'];
	$roleid=$_REQUEST['roleid'];
	$insert_query="insert into users(username,email,password,falcultyid,roleid) values('$username','$email','$password', $falcultyid, $roleid)";
	pg_query($dbconn,$insert_query);
	$status = "New Record Inserted Successfully.
    </br></br><a href='accountlisting.php'>View Inserted Record</a>";
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
	<h2>Account creation</h2>
	<div class="container">
		<form name="account" action="accountlisting.php" method="POST">
			<input type="hidden" name="new" value="1" />
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" required>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" required>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" required>
			</div>
			<div class="form-group">
				<label>Falculty(1-Business 2-Education,Health and Sciences 3-Engineering andScience 4-Liberal Arts and Sciences</label>
				<input type="number" name="falcultyid" min="1" max="4" required>
			</div>
			<div class="form-group">
				<label>Role(1-student 2-marketing coordinator 3-marketing manager 4-admin 5-guest</label>
				<input type="number" name="roleid" min="1" max="5" required>
			</div>
		</form>
	</div>
</body>
</html>