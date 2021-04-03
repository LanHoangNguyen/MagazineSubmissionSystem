<?php  
include('header.php');
include('session.php');
include('config.php');
$sql="SELECT * FROM cbf WHERE falcultyid=$loggedfalcultyid";
$result=pg_query($dbconn,$sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<a href="logout.php">Logout</a> 
	<h2>Contribution from your falculties</h2>
	<div class="container">
		<table width="100%" border="1" style="border-collapse:collapse;">
			<tr>
			    <th><strong>Contribution name</strong></th>
			    <th><strong>Release date</strong></th>
			    <th><strong>Due date</strong></th>
		    </tr>
		    <?php while($row=pg_fetch_assoc($result)){ ?>
			<tr>
				<td align="center"><a href="contributiondetail.php?id=<?php echo $row['contributionid'] ?>"><?php echo $row['contributionname'] ?></a></td>
				<td align="center"><?php echo $row['releasedate'] ?></td>
				<td align="center"><?php echo $row['duedate'] ?></td>
			</tr>
		<?php  }  ?>
		</table>
	</div>
</body>
</html>