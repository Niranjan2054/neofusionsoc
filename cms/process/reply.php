<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES);
	// debugger($_POST,true);
	$reply = new comment();
	if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act_del = substr(md5('Reply-Deleted'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			$act_publish = substr(md5('Reply-Published'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act_del == $_GET['act']) {
				$reply_id = (int)$_GET['id'];
				$reply_info = $reply->getCommentById($reply_id);
				if ($reply_info) {
					$success = $reply->deleteCommentbyId($reply_info[0]->id);
					if ($success) {
						setFlash('../reply?rep='.$_GET['rep'],'success','Reply Deleted Successfully');
					}else{
						setFlash('../reply?rep='.$_GET['rep'],'error','Error While Deleting Reply');
					}
				}else{
					setFlash('../reply?rep='.$_GET['rep'],'error','Reply Not found.');
				}
			}else if (isset($_GET['act']) && !empty($_GET['act']) && $act_publish == $_GET['act']) {
				$reply_id = (int)$_GET['id'];
				$reply_info = $reply->getCommentById($reply_id);
				if ($reply_info) {
					$success = $reply->PublishCommentByCommentById($reply_info[0]->id);
					if ($success) {
						setFlash('../reply?rep='.$_GET['rep'],'success','Reply Published Successfully');
					}else{
						setFlash('../reply?rep='.$_GET['rep'],'error','Error While Deleting Reply');
					}
				}else{
					setFlash('../reply?rep='.$_GET['rep'],'error','Reply Not found.');
				}

			}else{
				setFlash('../reply?rep='.$_GET['rep'],'error','Error unknown access to delete');
			}
		}else{
			setFlash('../reply?rep='.$_GET['rep'],'error','Invalid Id.');
		}
	}
	else{
		setFlash('../reply?rep='.$_GET['rep'],'error','Unauthorized Access');
	}
?>