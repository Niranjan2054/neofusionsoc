<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	debugger($_GET);
	debugger($_POST);
	$student = new student();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'paid' => (int)$_POST['paid'] + (int)$_POST['oldpaid'],
				);
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$student_id = $_POST['id'];
		}
		$student = new student();
		$student_info = $student->getStudentById($student_id);
		$student_info = $student_info[0];
		// debugger($student_info);
		$nextdata = array(
					'studentid'=>$student_info->id,
					'name'=>$student_info->name,
					'school'=>$student_info->school,
					'courses'=>$student_info->courses,
					'amount'=>$_POST['paid'],
					'image'=>$student_info->image
				);
		// debugger($nextdata,true);
		if (isset($student_id) && !empty($student_id)) {
			$act = 'updat';
			$students = $student->updatestudent($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$students = $student->addstudent($data);
		}
		$transaction = new transaction();
		$transactions = $transaction->addTransaction($nextdata);
		if ($students && $transaction) {
			setFlash('../transaction','success','Transaction Added Successfully');
		}else{
			setFlash('../transaction','error','Error While Adding To Database');
		}
		exit();
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('student-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$student_id = (int)$_GET['id'];
				$data = array(
					'transaction' => "",
					'istransaction' => 'no'
				);
				if (isset($_GET['id']) && !empty($_GET['id'])) {
					$student_id = $_GET['id'];
				}
				if (isset($student_id) && !empty($student_id)) {
					$act = 'delet';
					$students = $student->updatestudent($data,(int)$_GET['id']);
				}else{
					$act = "add";
					$students = $student->addstudent($data);
				}
				if ($students) {
					setFlash('../transaction','success','student '.$act.'ed Successfully');
				}else{
					setFlash('../transaction','error','Error While Adding To Database');
				}
			}else{
				setFlash('../transaction','error','Error unknown access to delete');
			}
		}else{
			setFlash('../transaction','error','Invalid Id.');
		}
	}else{
		// setFlash('../student-detail','error','Unauthorized Access');
	}

?>