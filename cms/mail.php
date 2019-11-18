<?php 
  	include $_SERVER['DOCUMENT_ROOT'].'config/init.php'; 
  	require $_SERVER['DOCUMENT_ROOT'].'assets/plugins/SMTP.php';
	require $_SERVER['DOCUMENT_ROOT'].'assets/plugins/PHPMailer.php';
	$mails = new PHPMailer(true);

	$total_mail_at_a_time = 10;
	$notice = new notice();
	$latest_notice = $notice->getlatestnotice();
	if ($latest_notice) {
		$latest_notice = $latest_notice[0];
		debugger($latest_notice);
		$notice_time = strtotime((isset($latest_notice->update_date) && !empty($latest_notice->update_date))?$latest_notice->update_date:$latest_notice->created_date);
		$current_time =  date('Y-m-d', strtotime('-1 week'));
		$current_time = strtotime($current_time);
		if ($current_time < $notice_time) {
			$mail = new mail();
			$latest_mail = $mail->getlatestmail();
			debugger($latest_mail);
			if($latest_mail){
				$latest_mail = $latest_mail[0];
				$subscriber_id =null;
				if($latest_mail->notice_id ==$latest_notice->id){
					$subscriber_id = $latest_mail->subscriber_id +1;
				}else{
					$subscriber_id = 1;
				}
				$subscriber = new subscriber();
				$subscriber_list = $subscriber->getSubscriberUsingLimit($subscriber_id,$total_mail_at_a_time);
				debugger($subscriber_list);
				if($subscriber_list){
					if (isset($latest_notice->image) && !empty($latest_notice->image) && file_exists(UPLOAD_DIR.'notice/'.$latest_notice->image)) {
						$thumbnail = UPLOAD_URL.'notice/'.$latest_notice->image;
					}else{
						$thumbnail = IMAGES_PATH.'no_thumbnail.png';
					}
					foreach ($subscriber_list as $key => $subscriber) {
						$message = " Dear! <br>";
						$message .= " You are requested to join Neo Fusion and it's Program. <br>";
						$message .= " <img src=".$thumbnail.">";
						$message .= html_entity_decode($latest_notice->notice);
						$message .= "Regards,<br>";
						$message .= "Neo Fusion School Of Computer Administration";
						$mai = sendMessage($subscriber->email,'Notice',$message,$mails);
						// debugger($mail,true);
						if ($mai) {
							$data = array(
								'notice_id'=>$latest_notice->id,
								'subscriber_id'=>$subscriber->id
							);
							$mail->addMail($data);
						}
					}
				}
			}
		}else{
			//notice is outdated..
		}
	}
?>