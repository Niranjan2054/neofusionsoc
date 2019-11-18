<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES);
	// debugger($_POST,true);
	$banner = new banner();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'title' => sanitize($_POST['title']),
					'link'	=> filter_var($_POST['link'],FILTER_VALIDATE_URL),
					'status'=> sanitize($_POST['status']),
					'added_by' => $_SESSION['user_id']
				);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
			$success = uploadImage($_FILES['image'],'banner');
			if ($success) {
				$data['image'] = $success;
				if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'banner/'.$_POST['old_image'])) {
					unlink(UPLOAD_DIR.'banner/'.$_POST['old_image']);
				}
			}else{
				setFlash('../banner','error','Error while uploading Image');
			}
		}
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$banner_id = $_POST['id'];
		}
		if (isset($banner_id) && !empty($banner_id)) {
			$act = 'updat';
			$banners = $banner->updatebanner($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$banners = $banner->addBanner($data);
		}
		if ($banners) {
			setFlash('../banner','success','Banner '.$act.'ed Successfully');
		}else{
			setFlash('../banner','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Banner-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$banner_id = (int)$_GET['id'];
				$Banner_info = $banner->getBannerById($banner_id);
				debugger($Banner_info);
				if ($Banner_info) {
					$success = $banner->deleteBannerbyId($Banner_info[0]->id);
					if ($success) {
						if (isset($Banner_info[0]->image) && !empty($Banner_info[0]->image) && file_exists(UPLOAD_DIR.'banner/'.$Banner_info[0]->image)) {
							unlink(UPLOAD_DIR.'banner/'.$Banner_info[0]->image);
							setFlash('../banner','success','Banner Deleted Successfully');
						}else{
							setFlash('../banner','error',"File Doesn't Exists");
						}
					}else{
						setFlash('../banner','error','Error While Deleting Banner');
					}
				}else{
					setFlash('../banner','error','Banner Not found.');
				}

			}else{
				setFlash('../banner','error','Error unknown access to delete');
			}
		}else{
			setFlash('../banner','error','Invalid Id.');
		}
	}
	else{
		setFlash('../banner','error','Unauthorized Access');
	}
?>