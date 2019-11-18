<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES);
	// debugger($_POST,true);
	$page = new page();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'title' => sanitize($_POST['title']),
					'summary'	=> sanitize($_POST['summary']),
					'description'	=> htmlentities($_POST['description']),
					'status'=> sanitize($_POST['status']),
					'added_by' => $_SESSION['user_id']
				);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
			$success = uploadImage($_FILES['image'],'page');
			if ($success) {
				$data['image'] = $success;
				if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'page/'.$_POST['old_image'])) {
					unlink(UPLOAD_DIR.'page/'.$_POST['old_image']);
				}
			}else{
				setFlash('../page','error','Error while uploading Image');
			}
		}
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$page_id = $_POST['id'];
		}
		if (isset($page_id) && !empty($page_id)) {
			$act = 'updat';
			$pages = $page->updatepage($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$pages = $page->addPage($data);
		}
		if ($pages) {
			setFlash('../page','success','Page '.$act.'ed Successfully');
		}else{
			setFlash('../page','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Page-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$page_id = (int)$_GET['id'];
				$Page_info = $page->getPageById($page_id);
				debugger($Page_info);
				if ($Page_info) {
					$success = $page->deletePagebyId($Page_info[0]->id);
					if ($success) {
						if (isset($Page_info[0]->image) && !empty($Page_info[0]->image) && file_exists(UPLOAD_DIR.'page/'.$Page_info[0]->image)) {
							unlink(UPLOAD_DIR.'page/'.$Page_info[0]->image);
							setFlash('../page','success','Page Deleted Successfully');
						}else{
							setFlash('../page','error',"File Doesn't Exists");
						}
					}else{
						setFlash('../page','error','Error While Deleting Page');
					}
				}else{
					setFlash('../page','error','Page Not found.');
				}

			}else{
				setFlash('../page','error','Error unknown access to delete');
			}
		}else{
			setFlash('../page','error','Invalid Id.');
		}
	}
	else{
		setFlash('../page','error','Unauthorized Access');
	}
?>