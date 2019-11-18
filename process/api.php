<?php 
include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'';
if ($act) {
	if ($act == substr(md5("insert-comment"),3,20)) {
		$comment = new comment();
		$data = array(
			'postid' => (int)$_REQUEST['b'],
			'commentid' => (int)$_REQUEST['commentid'],
			'commentor' => sanitize($_REQUEST['commentor']),
			'comment' => sanitize($_REQUEST['comment']),
			'posttitle' => sanitize($_REQUEST['posttitle']),
			'email' => filter_var($_REQUEST['email'],FILTER_VALIDATE_EMAIL)
		);
		$success = $comment->addComment($data);
		if (!$success) {
			$args = api_response([],false,'Error While Adding Comment');
			echo json_encode($args);
			exit;	
		}
		$args = api_response($success,true,'Success');
		echo json_encode($args);
		exit;	
	}else if($act == substr(md5("Hit Like"), 3,10)){
		$like = new like();
		$like_info = $like->getLikeByCommentId($_REQUEST['id']);
		if ($like_info) {
			$data = array(
				'commentid' => $_REQUEST['id'],
				'likes' => $like_info[0]->likes +1
			);
			$success = $like->updatelike($data,$like_info[0]->id);
			if ($success) {
				$args = api_response($success,'true','Liked');
				echo json_encode($args);
				exit();
			}
		}else{
			$data = array(
				'commentid' => $_REQUEST['id'],
				'likes' => 1
			);
			debugger($data);
			$success = $like->addLike($data);
			if ($success) {
				$args = api_response($success,true,'Liked');
				echo json_encode($args);
				exit;
			}
		}
	}else{
		$args = api_response([],false,'Invalid Action');
		echo json_encode($args);
		exit;	
	}
}else{
	$args = api_response([],false,'Invalid Token');
	echo json_encode($args);
	exit;
}