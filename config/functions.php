<?php 
function debugger($data, $is_die=false){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	if ($is_die) {
		exit;
	}
}
function getFileName(){
	return pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME);
}
function setFlash($location, $key="", $message=""){
	$_SESSION[$key]=$message;
	@header('location: '.$location.'');
	exit;
}
function flashMessage(){
	if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
		echo "<span class='alert alert-danger'>".$_SESSION['error']."</span>";	
		unset($_SESSION['error']);	
	}
	if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
		echo "<span class='alert alert-success'>".$_SESSION['success']."</span>";		
		unset($_SESSION['success']);	
	}
	if (isset($_SESSION['warning']) && !empty($_SESSION['warning'])) {
		echo "<span class='alert alert-warning'>".$_SESSION['warning']."</span>";		
		unset($_SESSION['warning']);	
	}
	?>
	<script type="text/javascript">
		setTimeout(function(){
			$('.alert').slideUp('slow');
		},3000);
	</script>
	<?php
}
function setToken($length = 100){
	$char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$len = strlen($char);
	$token ="";
	for ($i=0; $i < $length ; $i++) { 
		$token .= $char[rand(0,$len-1)];
	}
	return $token;
}
function sendMessage($to,$sub,$message,$mail){
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = '	smtp.mailtrap.io';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ac17418a9b37e9';                 // SMTP username
    $mail->Password = '6cd9911f67539d';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 2525;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('no-reply@hamropasal.com', 'NO-Reply');
    $mail->addAddress($to);               // Name is optional

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $sub;
    $mail->Body    = $message;
    return $mail->send();
}
function sanitize($str){
	$str = strip_tags($str);
	$str = stripslashes($str);
	$str = rtrim($str);
	return $str;
}
function uploadImage($data=array(),$loc=''){
	if ($data) {
		if (!$data['error']) {
			if ($data['size']<5000000) {
				$ext = pathinfo($data['name'],PATHINFO_EXTENSION);
				if (in_array(strtolower($ext), ALLOWED_EXT)) {
					$destination = UPLOAD_PATH.(strtolower((!empty($loc)?$loc.'/':'')));
					if (!is_dir($destination)) {
						mkdir($destination,0777,true);
					}
					$filename = ucfirst(strtolower((!empty($loc)?$loc:'Image'))).'-'.date('Ymdhis').rand(0,999).'.'.$ext;
					$success = move_uploaded_file($data['tmp_name'], $destination.$filename);
					if ($success) {
						return $filename;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}else{
		return false;
	}
}
function uploadFile($data=array(),$loc=''){
	if ($data) {
		if (!$data['error']) {
			if ($data['size']<5000000) {
				$ext = pathinfo($data['name'],PATHINFO_EXTENSION);
				echo "$ext";
				if (in_array(strtolower($ext), ALLOWED_EXT)) {
					$destination = UPLOAD_PATH.(strtolower((!empty($loc)?$loc.'/':'')));
					if (!is_dir($destination)) {
						mkdir($destination,0777,true);
					}
					$filename = ucfirst(strtolower((!empty($loc)?$loc:'Image'))).'-'.date('Ymdhis').rand(0,999).'.'.$ext;
					$success = move_uploaded_file($data['tmp_name'], $destination.$filename);
					if ($success) {
						return $filename;
					}else{
						echo "string1";
						return false;
					}
				}else{
						echo "string2";

					return false;
				}
			}else{
						echo "string3";

				return false;
			}
		}else{
						echo "string4";

			return false;
		}
	}else{
						echo "string5";

		return false;
	}
}
function api_response($data = array(),$status = false ,$message = ""){
	$model = new stdClass();
	$model->body= $data;
	$model->status = $status;
	$model->message = $message;
	return $model;
}
function uploadMultipleImage($data=array(),$loc=''){
	$filenames = array();
	if ($data) {
		$count = sizeof($data['name']);
		for($i=0;$i<$count;$i++){
			if (!$data['error'][$i]) {
				if ($data['size'][$i]<5000000) {
					$ext = pathinfo($data['name'][$i],PATHINFO_EXTENSION);
					if (in_array(strtolower($ext), ALLOWED_EXT)) {
						$destination = UPLOAD_PATH.(strtolower((!empty($loc)?$loc.'/':'')));
						if (!is_dir($destination)) {
							mkdir($destination,0777,true);
						}
						$filename = ucfirst(strtolower((!empty($loc)?$loc:'Image'))).'-'.date('Ymdhis').rand(0,999).'.'.$ext;
						$success = move_uploaded_file($data['tmp_name'][$i], $destination.$filename);
						if ($success) {
							$filenames[]=$filename;
						}else{
							return false;
						}
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		return $filenames;
	}else{
		return false;
	}
}

function sendMessagethroughsmpt($to,$sub,$message,$mail){
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.neofusionsoc.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'neofusio';                 // SMTP username
    $mail->Password = '4YJqUr-807Ifw-';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 2525;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@hamropasal.com', 'Info');
    $mail->addAddress($to);               // Name is optional

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $sub;
    $mail->Body    = $message;
    return $mail->send();
}