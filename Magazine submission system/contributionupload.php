<?php
include("config.php");
include("session.php");
if (isset($_POST['upload'])){
	$uploaddir = '/home/postgres/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    $filename = $_POST['filename'];
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
    {
	    echo "File is valid, and was successfully uploaded.\n";
    }
    else   
	{
		echo "Invalid file, please choose another one\n\n";
	}
	$loggeduserid=$user_check['userid'];
	$query="insert into contributions(contributionname, contributionfile, userid) values ('$filename',pg_lo_import('$uploadfile'),'$loggeduserid')";
	$result=pg_query($dbconn,$query);
	if($result){
		echo "File is successfully upload";
	}
	else
	{
		echo "Upload failed, try again";
	}
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
	<div class=container>
		<h2>File and image upload</h2>
		<form method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="filename" id="filename">
			</div>
			<div class="form-group">
				<label>File</label>
				<input type="file" name="userfile" id="userfile">
			</div>
			<input type="submit" name="upload" value="upload" class="btn btn-primary">
		</form>
	</div>
</body>
</html>