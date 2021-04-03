<?php  
include('header.php');
include('session.php');
include('config.php');
?>
<?php
if(isset($_GET['id'])){
	$contributionid=$_GET['id'];
	$sql=pg_query($dbconn,"select * from contributions where contributionid=".$contributionid." limit 1");
	$contributionCount=pg_num_rows($sql);
	if($contributionCount>0){
		while($row=pg_fetch_array($sql)){
			$contributionname=$row['contributionname'];
			$releasedate=strftime("%b,%d,%Y",strtotime($row['releasedate']));
			$duedate=$row['duedate'];
			$destination="uploads/$contributionname";
		}
		function getUsernameById($id){
	        global $dbconn;
	        $sql="SELECT username FROM users WHERE userid=$id ";
	        $result=pg_query($dbconn, $sql);
	        return $result['username'];
        }
        
	}
	else
	{
		echo "The contribution does not exist";
		exit();
	}
	if(isset($_POST['save'])){
            $q="INSERT INTO comments(contributionid,userid,commentcontent) VALUES ('".$contributionid."','".$loggeduserid."','".$_POST['msg']."')";
		    $r=pg_query($dbconn,$q);
		    header("Location:contributiondetail.php");
        }

}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $contributionname ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./bootstrap-5.0.0-beta2-dist/css/bootstrap.css">
    <script src="./bootstrap-5.0.0-beta2-dist/js/bootstrap.js"></script>
    <style type="text/css">
    	#wrap .row{
	border: 1px solid #e4d9d9;
    margin: 10px 0;
}
#wrap .head{
	margin-bottom: 10px;
}
#wrap .name{
	color: #e88b66;
    font-weight: bold;
}
#wrap .time{
	color: #aaa;
    font-size: 0.95em;
}
#wrap .msg{
	font-size: 1.1em;
}
#add{
	background: #f2f2f2;
    border: 1px solid #ccc;
    padding: 15px;
}
#add h1{
	font-size: 1.3em;
}
#add textarea{
	box-sizing: border-box;
    width: 100%;
    margin: 5px 0;
    padding: 10px;
    resize: none;
}
#add button[type=submit]{
	background: #db4104;
    border: 0;
    color: #fff;
    padding: 10px;
    cursor: pointer;
}
    </style>
</head>
<body>
	<h1><?php echo $contributionname ?></h1>
	<strong>Posted date: <?php echo $releasedate ?></strong>
	<br>
	<strong>Due date: <?php echo $duedate ?></strong>
	<br>
	<iframe src="<?php echo $destination ?>" width="100%" height="500"></iframe>
	<form id="add">
		<h2>Leave a reply</h2>
		<textarea id="msg" placeholder="comment" required></textarea>
		<button type="submit" id="save">Post</button>
	</form>
	<h2>Comments</h2>
	<div id="wrap">
		<?php
		$query="SELECT userid, timestamp,commentcontent FROM comments WHERE contributionid=$contributionid ORDER BY  timestamp ASC";
		$result=pg_query($dbconn,$query);
		while($row=pg_fetch_assoc($result)){ ?>
			<div class="row">
				<div class="head">
					<div class="name"><?php echo getUsernameById($row['userid']) ?></div>
					<div class="time"><?php echo $result['timestamp'] ?></div>
				</div>
				<div class="message">><?php echo $result['commentcontent'] ?></div>
			</div>
	<?php	}
		?>
	</div>
</body>
</html>