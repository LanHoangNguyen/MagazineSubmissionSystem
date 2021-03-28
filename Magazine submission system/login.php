<?php
include("config.php");
session_start();
if(isset($_POST['submit'])&&!empty($_POST['submit'])){
	$loginusername=pg_escape_string($_POST['username']);
	$loginpassword= md5($_POST['password']);
	$sql="select * from public.users where username='"$loginusername"' and password='"$loginpassword"' ";
	$data = pg_query($dbconn,$sql); 
    $login_check = pg_num_rows($data);
    if($login_check > 0){ 
        echo "Login Successfully";
        session_register("loginusername");
        $_SESSION["login_user"]=$loginusername;
        $row=pg_fetch_assoc($data);
        switch ($row[roleid]) {
           	case 1:
           		header("location:./student.php");
           		break;
           	
           	case 2:
           		header("location:./coordinator.php");
           		break;
           	case 3:
           		header("location:./manager.php");
           		break;
           	case 4:
           		header("location:./admin.php");
           		break;
           	case 5:
           		header("location:./guest.php");
           		break;
           }   
    }else{
        
        echo "Invalid Details, try again";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Magazine login</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./bootstrap-5.0.0-beta2-dist/css/bootstrap.css">
    <script src="./bootstrap-5.0.0-beta2-dist/js/bootstrap.js"></script>
</head>
<body>
	<div class="container" style="text-align:center;border:solid;margin-top: 150px; ">
		<h2>Login</h2>
		<form method="POST">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" placeholder="username">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" placeholder="password">
			</div>
			<input type="submit" name="submit" class="btn btn-primary">
		</form>
	</div>
</body>
</html>