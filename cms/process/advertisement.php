<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES);
	// debugger($_POST,true);
	$advertisement = new advertisement();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'link'	=> filter_var($_POST['link'],FILTER_VALIDATE_URL),
					'status'=> sanitize($_POST['status']),
					'added_by' => $_SESSION['user_id']
				);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
			$success = uploadImage($_FILES['image'],'advertisement');
			if ($success) {
				$data['image'] = $success;
				if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'advertisement/'.$_POST['old_image'])) {
					unlink(UPLOAD_DIR.'advertisement/'.$_POST['old_image']);
				}
			}else{
				setFlash('../advertisement','error','Error while uploading Image');
			}
		}
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$advertisement_id = $_POST['id'];
		}
		if (isset($advertisement_id) && !empty($advertisement_id)) {
			$act = 'updat';
			$advertisements = $advertisement->updateadvertisement($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$advertisements = $advertisement->addAdvertisement($data);
		}
		if ($advertisements) {
			setFlash('../advertisement','success','Advertisement '.$act.'ed Successfully');
		}else{
			setFlash('../advertisement','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Advertisement-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$advertisement_id = (int)$_GET['id'];
				$Advertisement_info = $advertisement->getAdvertisementById($advertisement_id);
				debugger($Advertisement_info);
				if ($Advertisement_info) {
					$success = $advertisement->deleteAdvertisementbyId($Advertisement_info[0]->id);
					if ($success) {
						if (isset($Advertisement_info[0]->image) && !empty($Advertisement_info[0]->image) && file_exists(UPLOAD_DIR.'advertisement/'.$Advertisement_info[0]->image)) {
							unlink(UPLOAD_DIR.'advertisement/'.$Advertisement_info[0]->image);
							setFlash('../advertisement','success','Advertisement Deleted Successfully');
						}else{
							setFlash('../advertisement','error',"File Doesn't Exists");
						}
					}else{
						setFlash('../advertisement','error','Error While Deleting Advertisement');
					}
				}else{
					setFlash('../advertisement','error','Advertisement Not found.');
				}

			}else{
				setFlash('../advertisement','error','Error unknown access to delete');
			}
		}else{
			setFlash('../advertisement','error','Invalid Id.');
		}
	}
	else{
		setFlash('../advertisement','error','Unauthorized Access');
	}
?>