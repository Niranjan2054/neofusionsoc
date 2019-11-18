<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	debugger($_FILES);
	$enquiry = new enquiry();
	/*if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'name' => sanitize($_POST['name']),
					'email' => filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
					'contact' => sanitize($_POST['contact']),
					'courses' => sanitize($_POST['courses']),
				);
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$enquiry_id = $_POST['id'];
		}
		if (isset($enquiry_id) && !empty($enquiry_id)) {
			$act = 'updat';
			$enquirys = $enquiry->updateenquiry($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$enquirys = $enquiry->addEnquiry($data);
		}
		if ($enquirys) {
			setFlash('/index','success','Enquiry '.$act.'ed Successfully');
		}else{
			setFlash('/index','error','Error While Adding To Database');
		}
	}else*/ if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Enquiry-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$enquiry_id = (int)$_GET['id'];
				$Enquiry_info = $enquiry->getEnquiryById($enquiry_id);
				debugger($Enquiry_info);
				if ($Enquiry_info) {
					$success = $enquiry->deleteEnquirybyId($Enquiry_info[0]->id);
					if ($success) {
						setFlash('../enquiry','success','Enquiry Deleted Successfully');
					}else{
						setFlash('../enquiry','error','Error While Deleting Enquiry');
					}
				}else{
					setFlash('../enquiry','error','Enquiry Not found.');
				}

			}else{
				setFlash('../enquiry','error','Error unknown access to delete');
			}
		}else{
			setFlash('../enquiry','error','Invalid Id.');
		}
	}
	else{
		setFlash('../enquiry','error','Unauthorized Access');
	}
?>