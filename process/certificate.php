<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	if ($_POST) {
		if (isset($_POST['certificateno']) && !empty($_POST['certificateno'])) {
			$certificateno = $_POST['certificateno'];
			$student = new student();
			$student_info = $student->getStudentByCertificateNo($certificateno);
			if ($student_info) {
				setFlash('../certificate?id='.$student_info[0]->id);
			}else{
				setFlash('../certificate?id=345sdfkljl1');
			}
		}else{
			setFlash('../certificate');
		}
	}else{
		setFlash('../certificate');
	}
?>