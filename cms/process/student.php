<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES);
	// debugger($_POST,true);
	$student = new student();
	$courses = new courses();
	$course = $courses->getCoursesById($_POST['courses']);
	// debugger($course);
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
			'name'=> sanitize($_POST['name']),
    		'gender'=> sanitize($_POST['gender']),
    		'dob'=> sanitize($_POST['dob']),
    		'guardian'=> sanitize($_POST['guardian']),
    		'address'=> sanitize($_POST['address']),
    		'contact'=> sanitize($_POST['contact']),
    		'gmail'=> filter_var($_POST['gmail'], FILTER_VALIDATE_EMAIL),
    		'school'=> sanitize($_POST['school']),
    		'academiclevel'=> sanitize($_POST['academiclevel']),
    		'dateofadmission'=> date("d F Y",time()),
    		'courses'=> $course['0']->title,
    		'price'=>$course['0']->price,
    		'time'=> sanitize($_POST['time']),
		    'discount' => (int)$_POST['discount'],
		    'status' => sanitize($_POST['status'])
				);
		// debugger($data,true);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
			$success = uploadImage($_FILES['image'],'student');
			if ($success) {
				$data['image'] = $success;
				if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'student/'.$_POST['old_image'])) {
					unlink(UPLOAD_DIR.'student/'.$_POST['old_image']);
				}
			}else{
				setFlash('../student','error','Error while uploading Image');
			}
		}
		// debugger($data,true);
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$student_id = $_POST['id'];
		}
		if (isset($student_id) && !empty($student_id)) {
			$act = 'updat';
			$students = $student->updatestudent($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$students = $student->addStudent($data);
		}
		// if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'][0] == 0) {
		// 	$success = uploadMultipleImage($_FILES['image'],'student');
		// 	// debugger($success,true);
		// 	if ($success) {
		// 		$image_info=array();
		// 		foreach ($success as $key => $value) {
		// 			$image_info['student_id'] = $students;
		// 			$image_info['image']=$value;
		// 			$student_obj = new student_image();
		// 			$succ = $student_obj->addStudent_image($image_info);
		// 			if (!$succ) {
		// 				$_SESSION['error'] ="All Image(s) Are not Uploaded.";
		// 			}
		// 		}
		// 		// if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'student/'.$_POST['old_image'])) {
		// 		// 	unlink(UPLOAD_DIR.'student/'.$_POST['old_image']);
		// 		// }
		// 	}else{
		// 		setFlash('../student','error','Error while uploading Image');
		// 	}
		// }
		if ($students) {
			setFlash('../student-list','success','Student '.$act.'ed Successfully');
		}else{
			setFlash('../student','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Student-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$student_id = (int)$_GET['id'];
				$Student_info = $student->getStudentById($student_id);
				// debugger($Student_info);
				if ($Student_info) {
					$success = $student->deleteStudentbyId($Student_info[0]->id);
					if ($success) {
						if (isset($Student_info[0]->image) && !empty($Student_info[0]->image) && file_exists(UPLOAD_DIR.'student/'.$Student_info[0]->image)) {
							unlink(UPLOAD_DIR.'student/'.$Student_info[0]->image);
							setFlash('../student-list','success','Student Deleted Successfully');
						}else{
							setFlash('../student-list','success',"Image Doesn't Exists and student deleted Successfully");
						}
					}else{
						setFlash('../student-list','error','Error While Deleting Student');
					}
				}else{
					setFlash('../student-list','error','Student Not found.');
				}

			}else{
				setFlash('../student-list','error','Error unknown access to delete');
			}
		}else{
			setFlash('../student-list','error','Invalid Id.');
		}
	}else{
		setFlash('../student-list','error','Unauthorized Access');
	}
?>