<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$subscriber = new subscriber();
	/*if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'email' => filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
				);
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$subscriber_id = $_POST['id'];
		}
		if (isset($subscriber_id) && !empty($subscriber_id)) {
			$act = 'updat';
			$subscribers = $subscriber->updatesubscriber($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$subscribers = $subscriber->addSubscriber($data);
		}
		if ($subscribers) {
			setFlash('/index','success','Subscriber '.$act.'ed Successfully');
		}else{
			setFlash('/index','error','Error While Adding To Database');
		}
	}else */if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Subscriber-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$subscriber_id = (int)$_GET['id'];
				$Subscriber_info = $subscriber->getSubscriberById($subscriber_id);
				debugger($Subscriber_info);
				if ($Subscriber_info) {
					$success = $subscriber->deleteSubscriberbyId($Subscriber_info[0]->id);
					if ($success) {
						setFlash('../subscriber','success','Subscriber Deleted Successfully');
					}else{
						setFlash('../subscriber','error','Error While Deleting Subscriber');
					}
				}else{
					setFlash('../subscriber','error','Subscriber Not found.');
				}

			}else{
				setFlash('../subscriber','error','Error unknown access to delete');
			}
		}else{
			setFlash('../subscriber','error','Invalid Id.');
		}
	}
	else{
		setFlash('../subscriber','error','Unauthorized Access');
	}
?>