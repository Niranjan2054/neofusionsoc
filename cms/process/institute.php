<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES);
	// debugger($_POST,true);
	$institute = new institute();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'Name' => sanitize($_POST['Name']),
					'abbr' => sanitize($_POST['abbr']),
					'estd' => sanitize($_POST['estd']),
					'location' => sanitize($_POST['location']),
					'phone' => sanitize($_POST['phone']),
					'map'	=> filter_var($_POST['map'],FILTER_VALIDATE_URL),
					'gmail'	=> filter_var($_POST['gmail'],FILTER_VALIDATE_EMAIL),
					'status'=> sanitize($_POST['status']),
					'ishead'=> sanitize($_POST['ishead']),
					'director'=> sanitize($_POST['director']),
					'added_by' => $_SESSION['user_id']
				);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
			$success = uploadImage($_FILES['image'],'institute');
			if ($success) {
				$data['image'] = $success;
				if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'institute/'.$_POST['old_image'])) {
					unlink(UPLOAD_DIR.'institute/'.$_POST['old_image']);
				}
			}else{
				setFlash('../institute','error','Error while uploading Image');
			}
		}
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$institute_id = $_POST['id'];
		}
		if (isset($institute_id) && !empty($institute_id)) {
			$act = 'updat';
			$institutes = $institute->updateinstitute($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$institutes = $institute->addInstitute($data);
		}
		if ($institutes) {
			setFlash('../institute','success','Institute '.$act.'ed Successfully');
		}else{
			setFlash('../institute','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Institute-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$institute_id = (int)$_GET['id'];
				$Institute_info = $institute->getInstituteById($institute_id);
				debugger($Institute_info);
				if ($Institute_info) {
					$success = $institute->deleteInstitutebyId($Institute_info[0]->id);
					if ($success) {
						if (isset($Institute_info[0]->image) && !empty($Institute_info[0]->image) && file_exists(UPLOAD_DIR.'institute/'.$Institute_info[0]->image)) {
							unlink(UPLOAD_DIR.'institute/'.$Institute_info[0]->image);
							setFlash('../institute','success','Institute Deleted Successfully');
						}else{
							setFlash('../institute','error',"File Doesn't Exists");
						}
					}else{
						setFlash('../institute','error','Error While Deleting Institute');
					}
				}else{
					setFlash('../institute','error','Institute Not found.');
				}

			}else{
				setFlash('../institute','error','Error unknown access to delete');
			}
		}else{
			setFlash('../institute','error','Invalid Id.');
		}
	}
	else{
		setFlash('../institute','error','Unauthorized Access');
	}
?>