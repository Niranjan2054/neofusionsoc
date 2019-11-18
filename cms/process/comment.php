<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$act_del = substr(md5('Comment-delete'.$_GET['id'].'-'.$_SESSION['token']),3,15);
	$act_publish = substr(md5('comment-publish'.$_GET['id'].'-'.$_SESSION['token']), 3,16);	
	$comment = new comment();
	if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act_del = substr(md5('Comment-delete'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			$act_publish = substr(md5('comment-publish'.$_GET['id'].'-'.$_SESSION['token']), 3,16);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act_del == $_GET['act']) {
				$comment_id = (int)$_GET['id'];
				$Comment_info = $comment->getCommentById($comment_id);
				if ($Comment_info) {
					$success = $comment->deleteCommentbyId($Comment_info[0]->id);
					if ($success) {
						$success = $comment->deleteCommentbyCommentId($comment_id);
						if ($success) {
							setFlash('../comment?c='.$_GET['c'],'success','Comment Deleted Successfully');
						}else{
							setFlash('../comment?c='.$_GET['c'],'error',"File Doesn't Exists");
						}
					}else{
						setFlash('../comment?c='.$_GET['c'],'error','Error While Deleting Comment');
					}
				}else{
					setFlash('../comment?c='.$_GET['c'],'error','Comment Not found.');
				}
			}else if (isset($_GET['act']) && !empty($_GET['act']) && $act_publish == $_GET['act']){
				$comment_id = (int)$_GET['id'];
				$Comment_info = $comment->getCommentById($comment_id);
				if ($Comment_info) {
					$success = $comment->PublishCommentByCommentById($Comment_info[0]->id);
					if ($success) {
						setFlash('../comment?c='.$_GET['c'], 'success','Comment Published Successfully');
					}else{
						setFlash('../comment?c='.$_GET['c'],'error','Error While Deleting Comment');
					}
				}else{
					setFlash('../comment?c='.$_GET['c'],'error','Comment Not found.');
				}
			}else{
				setFlash('../comment?c='.$_GET['c'],'error','Error unknown access to delete or publish');
			}
		}else{
			setFlash('../comment?c='.$_GET['c'],'error','Invalid Id.');
		}
	}
	else{
		setFlash('../comment?c='.$_GET['c'],'error','Unauthorized Access');
	}
?>