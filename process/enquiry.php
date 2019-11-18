<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	if ($_POST) {
		$data = array();
		$data['name'] = sanitize($_POST['name']);
		$data['contact'] = ($_POST['contact']>0)?$_POST['contact']:'';
		$data['email'] = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
		$data['courses'] = sanitize($_POST['courses']);
		$data['message'] = sanitize($_POST['message']);
		// debugger($data,true);
		$enquiry = new enquiry();
		$success = $enquiry->addEnquiry($data);
		if ($success) {
			setFlash('../enquiry','success','Your Data is Registered.. Thank You!!');
		}else{
			setFlash('../enquiry','error','Error Occured...');
		}
	}else{
		setFlash('../enquiry');
	}
 ?>