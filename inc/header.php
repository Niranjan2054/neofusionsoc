<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php'; 
	include $_SERVER['DOCUMENT_ROOT'].'inc/view.php'; 
	$office_detail = new institute();
	$office = $office_detail->getInstituteById(1);
	if ($office) {
		$office = $office[0];
	}
	// debugger($office);
	if (isset($office->image) && !empty($office->image) && file_exists(UPLOAD_DIR.'institute/'.$office->image)) {
		$thumbnail = UPLOAD_URL.'institute/'.$office->image;
	}else{
		$thumbnail = "assets/images/logo.png";
	}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Neo Fusion  <?php echo (isset($header) && !empty($header))?(' || '.$header):''; ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="manifest" href="site">
	<link rel="apple-touch-icon" href="icon">
	<!-- Place favicon.ico in the root directory -->

	<!-- bootstrap v4.0.0 -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- fontawesome-icons css -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- themify-icons css -->
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<!-- elegant css -->
	<link rel="stylesheet" href="assets/css/elegant.css">
	<!-- meanmenu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- venobox css -->
	<link rel="stylesheet" href="assets/css/venobox.css">
	<!-- jquery-ui.min css -->
	<link rel="stylesheet" href="assets/css/jquery-ui.min.css">
	<!-- slick css -->
	<link rel="stylesheet" href="assets/css/slick.css">
	<!-- slick-theme css -->
	<link rel="stylesheet" href="assets/css/slick-theme.css">
	<!-- helper css -->
	<link rel="stylesheet" href="assets/css/helper.css">
	<!-- style css -->
	<link rel="stylesheet" href="style.css">
	<!-- main css -->
	<link rel="stylesheet" href="main.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="assets/css/responsive.css">
	<!-- Plugins css -->
	<link rel="stylesheet" href="assets/css/plugins.css">
</head>

<body>
	<!-- 
  [if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]
 -->
  	<!--header-area start-->
  	<header class="header-area">
		<!--header-top-->
	  	<div class="header-top d-none d-sm-block">
	  		<div class="container">
	  			<div class="row align-items-center">
	  				<div class="col-sm-10 col-md-10">
	  					<div class="contact-info">
	  						<ul>
	  							<li><i class="fa fa-phone"></i>(+977) 9843 025 317 <span>|</span></li>
	  							<li><i class="fa fa-home"></i>Neo Fusion, Liwali Bhaktapur Nepal <span>|</span></li>
	  							<li><i class="fa fa-time"></i>Sunday - Friday: 6.AM - 8.PM</li>
	  						</ul>
	  					</div>
	  				</div>
	  				<div class="col-sm-2 col-md-2">
						<div class="social-icons pull-right">
							<a href="https://www.facebook.com/Neo-Fusion-School-Of-Computer-675537205892072/" target="_blank"><i class="fa fa-facebook"></i></a>
							<a href="https://www.youtube.com/channel/UCIxn9waZdvlhSDHdH1xLnXw" target="_blank"><i class="fa fa-youtube"></i></a>
							<a href="<?php echo (isset($office->map) && !empty($office->map))?$office->map:""; ?>" target="_blank"><i class="fa fa-map-marker"></i></a>
						</div>
					</div>
	  			</div>
	  		</div>
	  	</div>
		<!--header-bottom-->

		<div id="sticker" class="header-bottom">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-sm-2">
						<div class="logo">
							<a href="index"><img src="<?php echo $thumbnail; ?>" alt="logo" width="40" height="29.34"></a>
						</div>
					</div>
					<div class="col-sm-10">
						<div class="mainmenu text-center">
							<nav>
								<ul>
									<li><a href="index">Home</a>
									</li>
									<li><a href="all-course">Course</a>
										<ul class="submenu">
											<li><a href="all-course">All Course</a></li>
											<?php 
												$courses = new Courses();
												$all_course = $courses->getallCourses();
												if ($all_course) {
													foreach ($all_course as $key => $course) {
														// debugger($course);
												?>
													<li><a href="course-detail?c=<?php echo($course->id); ?>"><?php echo $course->title; ?></a></li>
												<?php
													}
												}

											?>
											<!-- <li><a href="404">Error 404</a></li> -->
										</ul>
									</li>
									<li><a href="enquiry">Join Course</a></li>

									<!-- <li><a href="#">Services</a>
										<ul class="submenu">
											<li><a href="service-1">Wedding PhotoGraphy</a></li>
											<li><a href="service-2">Art Workshop</a></li>
											<li><a href="service-3">Computer Workshop</a></li>
										</ul>
									</li> -->
									<li><a href="#">Gallery</a>
										<ul class="submenu">
											<li><a href="gallery">Photo Gallery</a></li>
											<li><a href="successgallery">Success Gallery</a></li>
											<!-- <li><a href="gallery-details">Gallery Details</a></li> -->
										</ul>
									</li>
									<li><a href="blog">Blog</a>
									</li>
									<li><a href="contact">Contact</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
  	</header>
  	<!--header-area end-->
  	<?php 
  		flashMessage();
  	 ?>

	