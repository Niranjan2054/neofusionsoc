<?php 
include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'';
if ($act) {
	if ($act == substr(md5("get-page-id".$_SESSION['token']),3,20)) {
		$page_id =(int)$_POST['pid'];
		if ($page_id<=0) {
			$args = api_response([],false,'Invalid Page Id');
			echo json_encode($args);
			exit;
		}
		$page = new page();
		$Page_info = $page->getPageById($page_id);
		if (!$Page_info) {
			$args = api_response([],false,'Page Not Found');
			echo json_encode($args);
			exit;	
		}
		$Page_info[0]->description = html_entity_decode($Page_info[0]->description);
		$args = api_response($Page_info,true,'Success');
		echo json_encode($args);
		exit;	
	}else if($act == substr(md5('get-child-cat-by-parent-id'.$_SESSION['token']), 3,18)){
		$parent_cat_id = (int)$_POST['cat_id'];
		if ($parent_cat_id<=0) {
			$args = api_response([],false,'Invalid Parent Category Id');
			echo json_encode($args);
			exit;
		}
		$Category = new category();
		$category_info = $Category->getchildcategorybyparentid($parent_cat_id);
		if (!$category_info) {
			$args = api_response([],false,'Category Not Found');
			echo json_encode($args);
			exit;
		}	
		$args = api_response($category_info,true,'Success');
		echo json_encode($args);
		exit;
	}else if($act == substr((md5('Search-Student-Using-Email'.$_SESSION['token'].'email')), 3,15)){
		$email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
		if($email){
			$Student = new student();
			$student = $Student->getStudentBygmail($email);
			if($student){
				$args = api_response($student,true,'Success');
				echo json_encode($args);
				exit;
			}else{
				$args = api_response([],false,'Email doesnot Match');
				echo json_encode($args);
				exit;
			}
		}else{
			$args = api_response([],false,'Invalid Email Id');
			echo json_encode($args);
			exit;
		}
	}else{
		$args = api_response([],false,'Invalid Action');
		echo json_encode($args);
		exit;	
	}
}else{
	$args = api_response([],false,'Invalid Token');
	echo json_encode($args);
	exit;
}