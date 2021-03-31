<?php
include('session.php');
include('config.php');
$sql = "SELECT * FROM contributions";
$result = pg_query($dbconn, $sql);
$files = pg_fetch_all($result, PGSQL_ASSOC);
function getUsernameById($userid){
	global $dbconn;
	$result=pg_query($dbconn,"select username from users where userid=".$userid."limit 1");
	return pg_fetch_assoc($result)['username'];
}
if (isset($_GET['file_id'])){
	$id = $_GET['file_id'];
	$sql = "SELECT * FROM contributions WHERE contributionid=$id";
	$result = pg_query($dbconn, $sql);
	$file=pg_fetch_assoc($result);
	$filepath = 'uploads/' . $file['contributionname'];
	if(file_exists($filepath)){
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . basename($filepath));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize('uploads/' . $file['contributionname']));
		readfile('uploads/' . $file['name']);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8" />
	<style type="text/css">
		table {
			width: 60%;
            border-collapse: collapse;
            margin: 100px auto;
		}
		th, td{
			height: 50px;
			vertical-align: center;
			border:1px solid black;
		}
	</style>
</head>
<body>
	<table>
		<thead>
			<th>ID</th>
			<th>Filename</th>
			<th>Release date</th>
			<th>Writer</th>
			<th>Download</th>
		</thead>
		<tbody>
			<?php foreach ($files as $file): ?>
			<tr>
				<td><?php echo $file['contributionid']; ?></td>
				<td><?php echo $file['contributionname']; ?></td>
				<td><?php echo $file['releasedate']?></td>
				<td><?php echo getUsernameById($file['userid']) ?></td>
				<td href="downloads.php?file_id=<?php echo $file['contributionid'] ?>">Download</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</body>
</html>