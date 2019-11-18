<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES);
	// debugger($_POST,true);
	$notice = new notice();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'notice' => htmlentities($_POST['notice']),
				);
		// debugger($data,true);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
			$success = uploadImage($_FILES['image'],'notice');
			if ($success) {
				$data['image'] = $success;
				if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'notice/'.$_POST['old_image'])) {
					unlink(UPLOAD_DIR.'notice/'.$_POST['old_image']);
				}
			}else{
				setFlash('../notice','error','Error while uploading Image');
			}
		}
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$notice_id = $_POST['id'];
		}
		if (isset($notice_id) && !empty($notice_id)) {
			$act = 'updat';
			$notices = $notice->updatenotice($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$notices = $notice->addNotice($data);
		}
		if ($notices) {
			setFlash('../notice','success','Notice '.$act.'ed Successfully');
		}else{
			setFlash('../notice','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Notice-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act = $_GET['act']) {
				$notice_id = (int)$_GET['id'];
				$Notice_info = $notice->getNoticeById($notice_id);
				debugger($Notice_info);
				if ($Notice_info) {
					$success = $notice->deleteNoticebyId($Notice_info[0]->id);
					if ($success) {
						if (isset($Notice_info[0]->image) && !empty($Notice_info[0]->image) && file_exists(UPLOAD_DIR.'notice/'.$Notice_info[0]->image)) {
							unlink(UPLOAD_DIR.'notice/'.$Notice_info[0]->image);
							setFlash('../notice','success','Notice Deleted Successfully');
						}else{
							setFlash('../notice','error',"File Doesn't Exists");
						}
					}else{
						setFlash('../notice','error','Error While Deleting Notice');
					}
				}else{
					setFlash('../notice','error','Notice Not found.');
				}

			}else{
				setFlash('../notice','error','Error unknown access to delete');
			}
		}else{
			setFlash('../notice','error','Invalid Id.');
		}
	}
	else{
		setFlash('../notice','error','Unauthorized Access');
	}
?>