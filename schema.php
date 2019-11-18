<?php 
	include_once $_SERVER['DOCUMENT_ROOT'].'config/init.php';

	$schema = new schema();
	$table = array(
		"users" => "CREATE TABLE  IF NOT EXISTS users
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			username varchar(50),
			email varchar(150),
			password text not null,
			activate_token text,
			password_reset_token text,
			session_token text,
			role enum('Admin','Staff') default 'Staff',
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on update current_timestamp
		)",
		"user_unique" => "ALTER TABLE users ADD UNIQUE(email)",
		'alter_user'	=> "ALTER TABLE `users` ADD `last_login` DATETIME NULL DEFAULT NULL AFTER `session_token`, ADD `last_ip` VARCHAR(100) NULL DEFAULT NULL AFTER `last_login`",
		'banners' => "CREATE TABLE  IF NOT EXISTS banners
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			title text,
			link text,
			status enum('Active','Inactive') default 'Active',
			image varchar(100),
			added_by int,
			created_date datetime default current_timestamp,
			updated_date datetime on update current_timestamp
		)",
		'studentproject' => "CREATE TABLE  IF NOT EXISTS studentproject
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			studentname varchar(50),
			studentid int,
			toolused varchar(20),
			link text,
			image varchar(100),
			status enum('Active','Inactive') default 'Active',
			added_by int,
			created_date datetime default current_timestamp,
			updated_date datetime on update current_timestamp
		)",
		'advertisement' => "CREATE TABLE  IF NOT EXISTS advertisement
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			link text,
			image varchar(100),
			status enum('Active','Inactive') default 'Active',
			added_by int,
			created_date datetime default current_timestamp,
			updated_date datetime on update current_timestamp
		)",
		'view' => "CREATE TABLE  IF NOT EXISTS view
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			remote_addr text,
			request_url text,
			http_user_agent text,
			logitude text,
			latitude text,
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on update current_timestamp
		)",
		'video' => "CREATE TABLE  IF NOT EXISTS video
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			link text,
			status enum('Active','Inactive') default 'Active',
			added_by int,
			created_date datetime default current_timestamp,
			updated_date datetime on update current_timestamp
		)",
		"institute" => "CREATE TABLE  IF NOT EXISTS institute
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			Name text,
			abbr varchar(30),
			location varchar(200),
			map text,
			status enum('Active','Inactive') default 'Active',
			ishead enum('Head','Branch'),
			estd varchar(50),
			gmail varchar(50),
			image varchar(100),
			director varchar(50),
			phone varchar(10),
			added_by int,
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"courses" => "CREATE TABLE  IF NOT EXISTS courses
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			title text,
			summary text,
			detail text,
			price int,
			instructor varchar(100),
			Duration varchar(30),
			status enum('Active','Inactive') default 'Active',
			added_by int,
			image varchar(200),
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"enquiry" => "CREATE TABLE  IF NOT EXISTS enquiry
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			name varchar(50),
			email varchar(50),
			contact varchar(15),
			courses varchar(50),
			message text,
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"gallery" => "CREATE TABLE  IF NOT EXISTS gallery
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			title varchar(50),
			featured_image varchar(50),
			type enum('excursion','event','classes','participation'),
			description text,
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"image" => "CREATE TABLE  IF NOT EXISTS image
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			foreign_key varchar(50),
			image varchar(50),
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"transaction" => "CREATE TABLE  IF NOT EXISTS transaction
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			studentid int not null,
			name varchar(50),
			school varchar(50),
			courses varchar(50),
			amount varchar(10),
			image varchar(50),
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"contact" => "CREATE TABLE  IF NOT EXISTS contact
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			name varchar(50),
			email varchar(50),
			subject varchar(50),
			message text,
			web varchar(50),
			contact varchar(15),
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"comment" => "CREATE TABLE  IF NOT EXISTS comment
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			commentid int,
			postid int,
			posttitle varchar(100),
			commentor varchar(50),
			comment	text,
			email varchar(50),
			status enum('Active','Inactive') default 'Inactive',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"notice" => "CREATE TABLE  IF NOT EXISTS notice
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			notice text,
			image varchar(50),
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"subscriber" => "CREATE TABLE  IF NOT EXISTS subscriber
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			email varchar(50),
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"blog" => "CREATE TABLE  IF NOT EXISTS blog
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			title varchar(250),
			description text,
			image varchar(50),
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"mail" => "CREATE TABLE  IF NOT EXISTS mail
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			notice_id int,
			subscriber_id int,
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"likes" => "CREATE TABLE  IF NOT EXISTS likes
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			commentid int,
			likes int,
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"busfair" => "CREATE TABLE  IF NOT EXISTS busfair
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			yourplace varchar(50),
			destination varchar(50),
			fee int,
			status enum('Active','Inactive') default 'Active',
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)",
		"student" => "CREATE TABLE  IF NOT EXISTS student
		(
			id int not null AUTO_INCREMENT PRIMARY KEY,
			name varchar(50),
			gender enum('Male','Female','Other'),
			dob varchar(20),
			guardian varchar(50),
			address varchar(100),
			contact varchar(10),
			gmail varchar(50),
			school varchar(200),
			academicLevel varchar(50),
			dateofadmission varchar(20),
			courses varchar(50),
			testimonials text,
			istestimonials enum('yes','no') default 'no',
			workat text,
			issuccess enum('yes','no') default 'no',
			isblacklisted enum('yes','no') default 'no',
			grade enum('A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D+'),
			certificateno varchar(20),
			hasid enum('yes','no') default 'no',
			idnumber varchar(10),
			time varchar(20),
			coursecompletiontime varchar(20),
			price int,
			paid int,
			discount int,
			image varchar(50),
			status enum('Active','Inactive') default 'Active',
			added_by int default 1,
			created_date datetime default current_timestamp,
			updated_date datetime on UPDATE current_timestamp
		)"

	);
	foreach ($table as $key => $sql) {
		try{
			$success = $schema->create($sql);
			if ($success) {
				echo "<em>Query".$key." Executed Successfully.</em><br>";
			}else{
				echo "<em>Problem while Executing Query ".$key."<br>";
			}
		}catch (PDOException $e){
			error_log(date('M d, Y h:i:s A')." : ( run Query) : ".$e->getMEssage()."\r\n",3,ERROR_PATH.'error.log');
			return false;
		}catch(Exception $e){
			error_log(date('M d, Y h:i:s A')." : ( run Query) : ".$e->getMessage()."\r\n",3,ERROR_PATH.'error.log');
		}
	}