<?php  
include('header.php');
include('session.php');
include('config.php');
include('contributionupload.php);
?>
<?php
if(isset($_GET['contributionid'])){
	$contributionid=preg_replace('#[^0-9]', '', $_GET['contributionid']);
	$sql=pg_query("select * from contributions where contributionid=".$contributionid." limit 1");
	$contributionCount=pg_num_rows($sql);
	if($contributionCount>0){
		while($row=pg_fetch_array($sql)){
			$contributionname=$row['contributionname'];
			$releasedate=strftime("%b,%d,%Y",strtotime($row['releasedate']));
			$contributionfile=$row['contributionfile'];
			$duedate=$row['duedate'];
		}
		$document=pg_fetch_assoc($sql);

		$commentqueryresult=pg_query($dbconn,"select from comments where contributionid=$contributionid");
		$comments=pg_fetch_all($commentqueryresult, PGSQL_ASSOC);

		function getUsernameById($userid){
			global $dbconn;
			$result=pg_query($dbconn,"select username from users where userid=".$userid."limit 1");
			return pg_fetch_assoc($result)['username'];
		}

		function getRepliesByCommentId($commentid){
			global $dbconn;
			$result=pg_query($dbconn,"select * from replies where commentid=$commentid");
			$replies=pg_fetch_all($result,PGSQL_ASSOC);
			return $replies
		}

		function getCommentCountByContributionId($contributionid){
			global $dbconn;
			$result=pg_query($dbconn, "select COUNT(*) as totals from comments");
			$data=pg_fetch_assoc($result);
			return $data['total']
		}

		if (isset($_POST['comment_posted'])){
			global $dbconn;
			$comment_text = $_POST['comment_text'];
			$sql="insert into comments(commentcontent, contributionid, userid) values ('$comment_text',".$loggeduserid.",".$contributionid.") ";
			$result=pg_query($dbconn, $sql);
			$insertedid=$dbconn->insert_id;
			$res=pg_query($dbconn."select * from comments where commentid=$insertedid");
			$inserted_comment=pg_fetch_assoc($res);
			if($result){
				$comment="<div class='comment clearfix'>
				<div class='comment-details'>
				    <span class='comment-name'>" . getUsernameById($inserted_comment['userid']) . "</span>
				    <p>" . $inserted_comment['commentcontent'] . "</p>
				    <a class='reply-btn' href='#' data-id='" . $inserted_comment['commentid'] . "'>reply</a>
				</div>
				<form action='post_details.php' class='reply_form clearfix' id='comment_reply_form_" . $inserted_comment['commentid'] . "' data-id='" . $inserted_comment['commentid'] . "'>
				<textarea class='form-control' name='reply_text' id='reply_text' cols='30' rows='2'></textarea>
				<button class='btn btn-primary btn-xs pull-right submit-reply'>Submit reply</button>
				</form>
				</div>";
				$comment_info=array(
					'comment' => $comment,
					'comments_count' => getCommentsCountByContributionId($contributionid)
				);
				echo json_encode($comment_info);
				exit();
			} else{
				echo "error";
				exit();
			}
		}
		if(isset($_POST['reply_posted'])){
			global $dbconn;
			$reply_text = $_POST['reply_text'];
			$comment_id=$_POST['comment_id'];
			$sql="insert into replies(userid,commentid,replycontent) values (".$loggeduserid.",$comment_id,'$reply_text)";
			$result=pg_query($dbconn,$sql);
			$insertedid=$dbconn->insert_id;
			$res=pg_query($dbconn, "select * from replies where replyid=$insertedid ");
			$inserted_reply=pg_fetch_assoc($res);
			if($result){
				$reply="<div class='comment reply clearfix'>
				<div class='comment-details'>
				<span class='comment-name'>" . getUsernameById($inserted_reply['userid']) . "</span>
				<p>" . $inserted_reply['replycontent'] . "</p>
				<a class='reply-btn' href='#'>reply</a>
				</div>
				</div>";
				echo $reply;
				exit();
			} else{
				echo "error";
				exit();
			}
		}
	}
	else
	{
		echo "The contribution does not exist";
		exit();
	}
}
else
{
	echo "Data to render this page is missing";
	exit();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="comment.css">
</head>
<body>
	<h1><?php echo $contributionname ?></h1>
	<strong>>Posted date: <?php echo $releasedate ?></strong>
	<strong>Due date: <?php echo $duedate ?></strong>
	<iframe src="<?php echo $destination  ?>" style="width: 90% height=500px"></iframe>
	<div class="col-md-6 col-md-offset-3 comments-section">
		<form class="clearfix" action="contributiondetail.php" method="POST" id="comment_form">
			<textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3" ></textarea>
			<button class="btn btn-primary btn-sm pull-right" id="submit_comment">Submit comment</button>
		</form>
		<h2><span id="comments_count"><?php echo count($comments) ?></span> Comment(s)</h2>
		<div id="comments-wrapper">
			<?php if (isset($comments)): ?>
				<?php foreach ($comments as $comment): ?>
					<div class="comment clearfix">
						<div class="comment-details">
							<span class="comment-name"><?php echo getUsernameById($comment['userid']) ?></span>
							<p><?php echo $comment['commentcontent']; ?></p>
							<a href="#" class="reply-btn" data-id="<?php echo $comment['commentid']; ?>">reply</a>
						</div>
						<form action="post_details.php" class="reply_form clearfix" id="comment_reply_form_<?php echo $comment['commentid'] ?>" data-id="<?php echo $comment['commentid']; ?>">
							<textarea class="form-control" name="reply_text" id="reply_text" cols="30" rows="2"></textarea>
							<button class="btn btn-primary btn-xs pull-right submit-reply">Submit reply</button>
						</form>
						<?php $replies = getRepliesByCommentId($comment['commentid']) ?>
						<div class="replies_wrapper_<?php echo $comment['commentid']; ?>">
							<?php if (isset($replies)): ?>
								<?php foreach ($replies as $reply): ?>
									<div class="comment reply clearfix">
										<div class="comment-details">
											<span class="comment-name"><?php echo getUsernameById($reply['userid']) ?></span>
											<p><?php echo $reply['replycontent']; ?></p>
										</div>
									</div>
								<?php endforeach ?>
							<?php endif ?>
						</div>
					</div>
				<?php endforeach ?>
			<?php else ?>
			    <h2>Be the first to comment on this post</h2>
			<?php endif ?>
		</div>
	</div>
	<script src="scripts.js"></script>
</body>
</html>
