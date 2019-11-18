<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES);
	// debugger($_POST,true);
	$video = new video();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'link'	=> filter_var($_POST['link'],FILTER_VALIDATE_URL),
					'added_by' => $_SESSION['user_id']
				);
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$video_id = $_POST['id'];
		}
		if (isset($video_id) && !empty($video_id)) {
			$act = 'updat';
			$videos = $video->updatevideo($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$videos = $video->addVideo($data);
		}
		if ($videos) {
			setFlash('../banner_video','success','Video '.$act.'ed Successfully');
		}else{
			setFlash('../banner_video','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Video-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$video_id = (int)$_GET['id'];
				$Video_info = $video->getVideoById($video_id);
				if ($Video_info) {
					$success = $video->deleteVideobyId($Video_info[0]->id);
					if ($success) {
						setFlash('../banner_video','success','Video Deleted Successfully');
					}else{
						setFlash('../banner_video','error','Error While Deleting Video');
					}
				}else{
					setFlash('../banner_video','error','Video Not found.');
				}

			}else{
				setFlash('../banner_video','error','Error unknown access to delete');
			}
		}else{
			setFlash('../banner_video','error','Invalid Id.');
		}
	}
	else{
		setFlash('../banner_video','error','Unauthorized Access');
	}
?>