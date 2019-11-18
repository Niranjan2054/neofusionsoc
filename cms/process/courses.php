<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES);
	// debugger($_POST);
	$courses = new courses();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'title' => sanitize($_POST['title']),
					'summary' => htmlentities($_POST['summary']),
					'detail' => htmlentities($_POST['detail']),
					'price' => (int)($_POST['price']),
					'instructor' => sanitize($_POST['instructor']),
					'Duration' => sanitize($_POST['Duration']),
					'status'=> sanitize($_POST['status']),
					'added_by' => $_SESSION['user_id']
				);
		// debugger($data,true);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
			$success = uploadImage($_FILES['image'],'courses');
			if ($success) {
				$data['image'] = $success;
				if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'courses/'.$_POST['old_image'])) {
					unlink(UPLOAD_DIR.'courses/'.$_POST['old_image']);
				}
			}else{
				setFlash('../courses','error','Error while uploading Image');
			}
		}
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$courses_id = $_POST['id'];
		}
		if (isset($courses_id) && !empty($courses_id)) {
			$act = 'updat';
			$coursess = $courses->updatecourses($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$coursess = $courses->addCourses($data);
		}
		if ($coursess) {
			setFlash('../courses','success','Courses '.$act.'ed Successfully');
		}else{
			setFlash('../courses','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Courses-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$courses_id = (int)$_GET['id'];
				$Courses_info = $courses->getCoursesById($courses_id);
				debugger($Courses_info);
				if ($Courses_info) {
					$success = $courses->deleteCoursesbyId($Courses_info[0]->id);
					if ($success) {
						if (isset($Courses_info[0]->image) && !empty($Courses_info[0]->image) && file_exists(UPLOAD_DIR.'courses/'.$Courses_info[0]->image)) {
							unlink(UPLOAD_DIR.'courses/'.$Courses_info[0]->image);
							setFlash('../courses','success','Courses Deleted Successfully');
						}else{
							setFlash('../courses','error',"File Doesn't Exists");
						}
					}else{
						setFlash('../courses','error','Error While Deleting Courses');
					}
				}else{
					setFlash('../courses','error','Courses Not found.');
				}

			}else{
				setFlash('../courses','error','Error unknown access to delete');
			}
		}else{
			setFlash('../courses','error','Invalid Id.');
		}
	}
	else{
		setFlash('../courses','error','Unauthorized Access');
	}
?>