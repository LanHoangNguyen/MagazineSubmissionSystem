<?php
include("config.php");
include("session.php");
if (isset($_POST['save'])){
	 $filename = $_FILES['myfile']['name'];
	 $destination = 'uploads/' . $filename;
	 $extension = pathinfo($filename, PATHINFO_EXTENSION);
	 $file = $_FILES['myfile']['tmp_name'];
	 $size = $_FILES['myfile']['size'];

	 if (!in_array($extension, ['pdf','png','jpg'])){
	 	echo "You file extension must be .pdf, .png or jpg";
	 } elseif ($_FILES['myfile']['size'] > 80000000){
	 	echo "File too large!";
	 } else{
	 	if (move_uploaded_file($file, $destination)){
	 		$sql="insert into contributions(contributionname,releasedate,userid) values ('$filename',now(),$loggeduserid)";
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
	<a href="contributionlist.php">View your contributions</a>
	<div class=container>
		<div class="row">
		    <form method="POST" action="" enctype="multipart/form-data">
		    	<h3>Upload File(PDF or images)</h3>
			    <div class="form-group">
				    <label>File</label>
				    <input type="file" name="myfile">
			    </div>
			    <button type="submit" name="save">Upload</button>
		    </form>
		</div>
	</div>
</body>
</html>