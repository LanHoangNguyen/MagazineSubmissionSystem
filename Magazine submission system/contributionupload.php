<?php
include("config.php");
include("session.php");
if (isset($_POST['save'])){
	 $loggeduserid=$user_check['userid'];
	 $filename = $_FILES['myfile']['name'];
	 $destination = 'uploads/' . $filename;
	 $extension = pathinfo($filename, PATHINFO_EXTENSION);
	 $file = $_FILES['myfile']['tmp_name'];
	 $size = $_FILES['myfile']['size'];

	 if (!in_array($extension, ['zip', 'pdf', 'docx','png','jpeg'])){
	 	echo "You file extension must be .zip, .pdf, .docx, .png or jpeg";
	 } elseif ($_FILES['myfile']['size'] > 1000000){
	 	echo "File too large!";
	 } else{
	 	if (move_uploaded_file($file, $destination)){
	 		$sql="insert into contributions(contributionname,userid) values ('$filename',$loggeduserid)";
	 		if(pg_query($dbconn,$sql)){
	 			echo "File upload successfully";
	 		} else{
	 			echo "Failed to upload file";
	 		}
	 	}

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
	<style type="text/css">
    	form {
            width: 30%;
            margin: 100px auto;
            padding: 30px;
            border: 1px solid #555;
        }
        input {
            width: 100%;
            border: 1px solid #f1e1e1;
            display: block;
            padding: 5px 10px;
        }
        button {
            border: none;
            padding: 10px;
            border-radius: 5px;
        }
        table {
            width: 60%;
            border-collapse: collapse;
            margin: 100px auto;
        }
    </style>
</head>
<body>
	<div class=container>
		<h2>File and image upload</h2>
		<form method="POST" enctype="multipart/form-data">
			<h3>Upload File</h3>
			<div class="form-group">
				<label>File</label>
				<input type="file" name="myfile">
			</div>
			<input type="submit" name="upload" value="upload" class="btn btn-primary">
		</form>
	</div>
</body>
</html>
