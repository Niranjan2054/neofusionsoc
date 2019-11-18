<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_FILES,true);
	// debugger($_POST);
	$gallery = new gallery();
	if (isset($_POST) && !empty($_POST)) {
		$data = array(
					'title' => sanitize($_POST['title']),
					'description' => htmlentities($_POST['description']),
					'type' => sanitize($_POST['type']),
				);
		// debugger($data);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['featured_image']) && $_FILES['featured_image']['error'] == 0) {
			$success = uploadImage($_FILES['featured_image'],'gallery');
			if ($success) {
				$data['featured_image'] = $success;
				if (isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'gallery/'.$_POST['old_image'])) {
					unlink(UPLOAD_DIR.'gallery/'.$_POST['old_image']);
				}
			}else{
				setFlash('../gallery','error','Error while uploading Image');
			}
		}
		// debugger($data,true);
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$gallery_id = $_POST['id'];
		}
		if (isset($gallery_id) && !empty($gallery_id)) {
			$act = 'updat';
			$gallerys = $gallery->updategallery($data,(int)$_POST['id']);
		}else{
			$act = "add";
			$gallerys = $gallery->addGallery($data);
		}
		echo $gallerys;
		if ($gallerys) {
			if ($_FILES['image']) {
				$success = uploadMultipleImage($_FILES['image'],'gallery');
				if ($success) {
					debugger($success);
					$image = new image();
					foreach ($success as $key => $value) {
						$data = array();
						$data['foreign_key'] = $gallerys;
						$data['image'] = $value;
						$image->addImage($data);
					}
				}
			}
			setFlash('../gallery','success','Gallery '.$act.'ed Successfully');
		}else{
			setFlash('../gallery','error','Error While Adding To Database');
		}
	}else if(isset($_GET) && !empty($_GET)){
		if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
			$act = substr(md5('Gallery-'.$_GET['id'].'-'.$_SESSION['token']),3,15);
			if (isset($_GET['act']) && !empty($_GET['act']) && $act == $_GET['act']) {
				$gallery_id = (int)$_GET['id'];
				$Gallery_info = $gallery->getGalleryById($gallery_id);
				if ($Gallery_info) {
					$success = $gallery->deleteGallerybyId($Gallery_info[0]->id);
					if ($success) {
						if (isset($Gallery_info[0]->featured_image) && !empty($Gallery_info[0]->featured_image) && file_exists(UPLOAD_DIR.'gallery/'.$Gallery_info[0]->featured_image)) {
							unlink(UPLOAD_DIR.'gallery/'.$Gallery_info[0]->featured_image);
							

							$image = new image();
							$image_info = $image->getImageByForeign_key($gallery_id);
							foreach ($image_info as $key => $value) {
								debugger($value);
								if (isset($value->image) && !empty($value->image) && file_exists(UPLOAD_DIR.'gallery/'.$value->image)) {
									unlink(UPLOAD_DIR.'gallery/'.$value->image);
								}
							}
							$image->deleteImagebyForeign_key($gallery_id);


							setFlash('../gallery','success','Gallery Deleted Successfully');
						}else{
							setFlash('../gallery','error',"File Doesn't Exists");
						}
					}else{
						setFlash('../gallery','error','Error While Deleting Gallery');
					}
				}else{
					setFlash('../gallery','error','Gallery Not found.');
				}

			}else{
				setFlash('../gallery','error','Error unknown access to delete');
			}
		}else{
			setFlash('../gallery','error','Invalid Id.');
		}
	}
	else{
		setFlash('../gallery','error','Unauthorized Access');
	}
?>