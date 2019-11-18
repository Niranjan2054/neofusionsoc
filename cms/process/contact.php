<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$contact = new contact();
	/*if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'name' => sanitize($_POST['name']),
					'email' => filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
					'contact' => sanitize($_POST['contact']),
					'courses' => sanitize($_POST['courses']),
				);
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$contact_id = $_POST['id'];
		}
		if (isset($contact_id) && !empty($contact_id)) {
			$act = 'updat';
			$contacts = $contact->updatecontact($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$contacts = $contact->addContact($data);
		}
		if ($contacts) {
			setFlash('/index','success','Contact '.$act.'ed Successfully');
		}else{
			setFlash('/index','error','Error While Adding To Database');
		}
	}else */if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Contact-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$contact_id = (int)$_GET['id'];
				$Contact_info = $contact->getContactById($contact_id);
				debugger($Contact_info);
				if ($Contact_info) {
					$success = $contact->deleteContactbyId($Contact_info[0]->id);
					if ($success) {
						setFlash('../contact','success','Contact Deleted Successfully');
					}else{
						setFlash('../contact','error','Error While Deleting Contact');
					}
				}else{
					setFlash('../contact','error','Contact Not found.');
				}

			}else{
				setFlash('../contact','error','Error unknown access to delete');
			}
		}else{
			setFlash('../contact','error','Invalid Id.');
		}
	}
	else{
		setFlash('../contact','error','Unauthorized Access');
	}
?>