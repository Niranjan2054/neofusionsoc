<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES);
	// debugger($_POST,true);
	$blog = new blog();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'title' => sanitize($_POST['title']),
					'description' => htmlentities($_POST['description']),
				);
		// debugger($data,true);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
			$success = uploadImage($_FILES['image'],'blog');
			if ($success) {
				$data['image'] = $success;
				if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'blog/'.$_POST['old_image'])) {
					unlink(UPLOAD_DIR.'blog/'.$_POST['old_image']);
				}
			}else{
				setFlash('../blog','error','Error while uploading Image');
			}
		}
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$blog_id = $_POST['id'];
		}
		if (isset($blog_id) && !empty($blog_id)) {
			$act = 'updat';
			$blogs = $blog->updateblog($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$blogs = $blog->addBlog($data);
		}
		if ($blogs) {
			setFlash('../blog','success','Blog '.$act.'ed Successfully');
		}else{
			setFlash('../blog','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Blog-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$blog_id = (int)$_GET['id'];
				$Blog_info = $blog->getBlogById($blog_id);
				debugger($Blog_info);
				if ($Blog_info) {
					$success = $blog->deleteBlogbyId($Blog_info[0]->id);
					if ($success) {
						if (isset($Blog_info[0]->image) && !empty($Blog_info[0]->image) && file_exists(UPLOAD_DIR.'blog/'.$Blog_info[0]->image)) {
							unlink(UPLOAD_DIR.'blog/'.$Blog_info[0]->image);
							setFlash('../blog','success','Blog Deleted Successfully');
						}else{
							setFlash('../blog','error',"File Doesn't Exists");
						}
					}else{
						setFlash('../blog','error','Error While Deleting Blog');
					}
				}else{
					setFlash('../blog','error','Blog Not found.');
				}

			}else{
				setFlash('../blog','error','Error unknown access to delete');
			}
		}else{
			setFlash('../blog','error','Invalid Id.');
		}
	}
	else{
		setFlash('../blog','error','Unauthorized Access');
	}
?>