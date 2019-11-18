<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	debugger($_FILES);
	// debugger($_POST,true);
	$category = new category();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'title' => sanitize($_POST['title']),
					'summary'	=> sanitize($_POST['summary']),
					'show_in_menu'	=> (isset($_POST['show_in_menu']) && !empty($_POST['show_in_menu'])?1:0),
					'is_parent'	=> (isset($_POST['is_parent']) && !empty($_POST['is_parent'])?1:0),
					'parent_id'	=> (isset($_POST['parent_cat_id']) && !empty($_POST['parent_cat_id'])?$_POST['parent_cat_id']:0),
					'status'=> sanitize($_POST['status']),
					'added_by' => $_SESSION['user_id']
				);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
			$success = uploadImage($_FILES['image'],'category');
			if ($success) {
				$data['image'] = $success;
				if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'category/'.$_POST['old_image'])) {
					unlink(UPLOAD_DIR.'category/'.$_POST['old_image']);
				}
			}else{
				setFlash('../category','error','Error while uploading Image');
			}
		}
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$category_id = $_POST['id'];
		}
		if (isset($category_id) && !empty($category_id)) {
			$act = 'updat';
			$categories = $category->updatecategory($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$categories = $category->addCategory($data);
		}
		if ($categories) {
			setFlash('../category','success','Category '.$act.'ed Successfully');
		}else{
			setFlash('../category','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Category-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$category_id = (int)$_GET['id'];
				$Category_info = $category->getCategoryById($category_id);
				debugger($Category_info);
				if ($Category_info) {
					$success = $category->deleteCategorybyId($Category_info[0]->id);
					if ($success) {
						if (isset($Category_info[0]->image) && !empty($Category_info[0]->image) && file_exists(UPLOAD_DIR.'category/'.$Category_info[0]->image)) {
							unlink(UPLOAD_DIR.'category/'.$Category_info[0]->image);
							setFlash('../category','success','Category Deleted Successfully');
						}else{
							setFlash('../category','error',"File Doesn't Exists");
						}
					}else{
						setFlash('../category','error','Error While Deleting Category');
					}
				}else{
					setFlash('../category','error','Category Not found.');
				}

			}else{
				setFlash('../category','error','Error unknown access to delete');
			}
		}else{
			setFlash('../category','error','Invalid Id.');
		}
	}
	else{
		setFlash('../category','error','Unauthorized Access');
	}
?>