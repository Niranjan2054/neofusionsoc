<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_SERVER,true);
	// debugger($_POST);
	if ($_POST) {
		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
			if ($email) {
				$data = array();
				$data['email'] = $email;
				$sub = new subscriber();
				$return_data = $sub->getSubscriberByEmail($email);
				if (!$return_data) {
					$success = $sub->addSubscriber($data);
					if ($success) {
						setFlash('../registered','success' ,'Subscribed...');
					}
				}else{
					setFlash('../registered','warning','Already Subscribed');
				}
				
			}
		}
	}else{
		setFlash('../index');
	}
?>