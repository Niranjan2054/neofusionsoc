<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	debugger($_POST);
	if ($_POST) {
		if (isset($_POST) && !empty($_POST)) {
			$data = array();
			$data['name'] = (isset($_POST['name']) && !empty($_POST['name']))?sanitize($_POST['name']):'' ; 
			$data['email'] = (isset($_POST['email']) && !empty($_POST['email']))?filter_var($_POST['email'],FILTER_VALIDATE_EMAIL):''; 
			$data['subject'] =(isset($_POST['subject']) && !empty($_POST['subject']))?sanitize($_POST['subject']):''; 
			$data['message'] = (isset($_POST['message']) && !empty($_POST['message']))?sanitize($_POST['message']):''; 
			$data['web'] = (isset($_POST['web']) && !empty($_POST['web']))?filter_var($_POST['web'],FILTER_VALIDATE_URL):''; 
			$data['contact'] = ($_POST['contact']>0)?$_POST['contact']:''; 
			debugger($data);
			$contact = new contact();
			$success = $contact->addContact($data);
			if ($success) {
				setFlash('../contact','success','Thank You... Be with us');
			}
		}
	}
 ?>