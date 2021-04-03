<?php
include('header.php');
include('session.php');
include('config.php');
$userid=$_REQUEST['userid'];
$query="select * from users where userid='".$userid."'";
$result=pg_query($dbconn,$query);
$row=pg_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2>Update account</h2>
	<?php
	$status = "";
    if(isset($_POST['new']) && $_POST['new']==1){
    	$userid=$_REQUEST['userid'];
    	$username=$_REQUEST['username'];
	    $email=$_REQUEST['email'];
	    $password=$_REQUEST['password'];
	    $falcultyid=$_REQUEST['falcultyid'];
	    $roleid=$_REQUEST['roleid'];
	    $update="update users set username='".$username."',email='".$email."',password='".$password."',falcultyid =$falcultyid, roleid=$roleid where userid=$userid";
	    pg_query($dbconn,$update);
	    $status = "Record Updated Successfully. </br></br><a href='accountlisting.php'>View Updated Record</a>";
        echo '<p style="color:#FF0000;">'.$status.'</p>';
    } else{
	 ?>
	<div class="container">
		<form method="POST" action="" name="updateform">
			<input type="hidden" name="new" value="1" />
			<input name="userid" type="hidden" value="<?php echo $row['userid'];?>" />
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" required value="<?php echo $row['username'];?>" />
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" required value="<?php echo $row['email'] ?>">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" required value="<?php echo $row['password'] ?>">
			</div>
			<div class="form-group">
				<label>Falculty(1-Business 2-Education,Health and Sciences 3-Engineering andScience 4-Liberal Arts and Sciences</label>
				<input type="number" name="falcultyid" min="1" max="4" required  value="<?php echo $row['falcultyid'] ?>">
			</div>
			<div class="form-group">
				<label>Role(1-student 2-marketing coordinator 3-marketing manager 4-admin 5-guest</label>
				<input type="number" name="roleid" min="1" max="5" required value="<?php echo $row['roleid'] ?>">
			</div>
			<input type="submit" name="update" value="Update">
		</form>
	</div>
    <?php } ?>
</body>
</html>