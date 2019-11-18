<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES);
	// debugger($_POST);
	$student = new student();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'certificateno' => sanitize($_POST['certificateno']),
					'coursecompletiontime' => $_POST['coursecompletiontime']
				);
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
		if ($students) {
			setFlash('../certified','success','Certificate '.$act.'ed Successfully');
		}else{
			setFlash('../certified','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Gallery-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$data = array(
					'certificateno' => NULL,
				);
				$act = 'delet';
				$students = $student->updatestudent($data,(int)$_GET['id']);
				if ($students) {
					setFlash('../certified','success','student '.$act.'ed Successfully');
				}else{
					setFlash('../certified','error','Error While Adding To Database');
				}
			}else{
				setFlash('../certified','error','Error unknown access to delete');
			}
		}else{
			setFlash('../certified','error','Invalid Id.');
		}
	}
	else{
		setFlash('../certified','error','Unauthorized Access');
	}
?>