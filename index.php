<?php
	$header = "Home";
 	include 'inc/header.php'; 
 ?>
 <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
 <?php flashMessage(); ?>
	<!--banner-area start-->
	<?php 
		$banner = new banner();
		$latest_banner = $banner->getlatestbanner();
		if ($latest_banner) {
			$latest_banner = $latest_banner[0];
			if (isset($latest_banner->image) && !empty($latest_banner->image) && file_exists(UPLOAD_DIR.'banner/'.$latest_banner->image)) {
                $thumbnail = UPLOAD_URL.'banner/'.$latest_banner->image;
            }else{
                $thumbnail = 'assets/images/banners/1.jpg';
            }
		}

		$video = new video();
		$latest_video = $video->getlatestvideo();
		if ($latest_video) {
			$latest_video = $latest_video[0];
		}
	?>
	<div class="banner-area bg-1 overlay" style="background: rgba(0, 0, 0, 0) url('<?php echo ((isset($thumbnail) && !empty($thumbnail))?$thumbnail:'assets/images/banners/1.jpg') ?>') no-repeat scroll center center / cover ;">
		<div class="container">
			<div class="row align-items-center height-800 pb-111">
				<div class="col-sm-12">
					<div class="banner-text text-center">
						<h2><?php echo $latest_banner->title; ?></h2>
						<a class="venobox video-play" data-gall="gall-video" data-autoplay="true" data-vbtype="video" href="<?php echo((isset($latest_video->link) && !empty($latest_video->link))?$latest_video->link:"https://www.youtube.com/watch?v=UFUa_4umeT8") ?>">
                        <i class="fa fa-play"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--banner-area end-->
	
	<!--service-area start-->
	<div class="service-area mt-minus-100 sm-mt-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="sin-service">
						<img src="assets/images/promo/1.jpg" alt="promo">
						<h3>Planting & Garden Care</h3>
						<p>Don't be distracted by criticism. Remember the only taste of success some people.</p>
						<a href="#" class="readmore">Read More</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="sin-service">
						<img src="assets/images/promo/2.jpg" alt="promo">
						<h3>Watering Your Garden</h3>
						<p>Don't be distracted by criticism. Remember the only taste of success some people.</p>
						<a href="#" class="readmore">Read More</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 d-lg-block d-md-none">
					<div class="sin-service">
						<img src="assets/images/promo/3.jpg" alt="promo">
						<h3>Design & Renovation</h3>
						<p>Don't be distracted by criticism. Remember the only taste of success some people.</p>
						<a href="#" class="readmore">Read More</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--service-area end-->
	
	<!--about-area start-->
	<!-- <div class="about-area mt-85 sm-mt-30">
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-md-2 col-sm-12">
					<div class="section-title">
						<h2>Little About Us</h2>
						<p>We are professtional gardener It is a long established fact that a reader <br/> will be distracted by the readable content of a page when looking at its layout.</p>
					</div>
				</div>
			</div>
			<div class="row mt-55 sm-mt-37 xs-mt-57">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="sin-service style-2">
						<i class="ti-clipboard"></i>
						<h3>License & Insurance</h3>
						<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="sin-service style-2">
						<i class="ti-truck"></i>
						<h3>License & Insurance</h3>
						<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="sin-service style-2">
						<i class="ti-cup"></i>
						<h3>License & Insurance</h3>
						<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="sin-service style-2">
						<i class="ti-comments"></i>
						<h3>License & Insurance</h3>
						<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="sin-service style-2">
						<i class="ti-calendar"></i>
						<h3>License & Insurance</h3>
						<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="sin-service style-2">
						<i class="ti-thumb-up"></i>
						<h3>License & Insurance</h3>
						<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!--about-area end-->
	
	<!--project-area start-->
	<?php 
		$gallery = new gallery();
		$featured_gallery = $gallery->getGalleryUsingLimit(0,4);
		// debugger($featured_gallery);
	?>
	<div class="project-area mt-40 sm-mt-minus-10">
		<div class="container-fluid">
			<div class="row">
					<div class="col-md-8 offset-md-2 col-sm-12">
					<div class="section-title text-center">
						<h2>Featured Gallery</h2>
					</div>
				</div>
			</div>
			<div class="row mt-65 sm-mt-40">
				<?php 
					if ($featured_gallery) {
						foreach ($featured_gallery as $key => $gal) {
							if (isset($gal->featured_image) && !empty($gal->featured_image) && file_exists(UPLOAD_DIR.'gallery/'.$gal->featured_image)) {
                            	$thumbnail = UPLOAD_URL.'gallery/'.$gal->featured_image;
                          	}else{
                            	$thumbnail = IMAGES_PATH.'no_thumbnail.png';
                          	}
				?>
				<div class="col-lg-3 col-sm-6 p-0">
					<div class="single-project">
						<div class="project-thumb">
							<img src="<?php echo $thumbnail; ?>" alt=""/>
						</div>
						<div class="project-desc">
							<a class="venobox" data-gall="myGallery" href="<?php echo $thumbnail; ?>"><i class="ti-fullscreen"></i></a>
						</div>
					</div>
				</div>
				<?php
						}
					}
				?>
				<!-- <div class="col-lg-3 col-sm-6 p-0">
					<div class="single-project">
						<div class="project-thumb">
							<img src="assets/images/projects/2.jpg" alt=""/>
						</div>
						<div class="project-desc">
							<a class="venobox" data-gall="myGallery" href="assets/images/projects/2.jpg"><i class="ti-fullscreen"></i></a>
							<h3>Stones In Fencing Embankments</h3>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 p-0">
					<div class="single-project">
						<div class="project-thumb">
							<img src="assets/images/projects/3.jpg" alt=""/>
						</div>
						<div class="project-desc">
							<a class="venobox" data-gall="myGallery" href="assets/images/projects/3.jpg"><i class="ti-fullscreen"></i></a>
							<h3>Stones In Fencing Embankments</h3>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 p-0">
					<div class="single-project">
						<div class="project-thumb">
							<img src="assets/images/projects/4.jpg" alt=""/>
						</div>
						<div class="project-desc">
							<a class="venobox" data-gall="myGallery" href="assets/images/projects/4.jpg"><i class="ti-fullscreen"></i></a>
							<h3>Stones In Fencing Embankments</h3>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	<!--project-area end-->
	
	<!--contact-form area-->
	<!-- <div class="contact-area bg-1 mt-83 sm-mt-40">
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-md-2 col-sm-12">
					<div class="section-title">
						<h2>Start Your Project Now</h2>
					</div>
				</div>
			</div>
			<div class="row mt-32 sm-mt-2">
				<div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12">
					<div class="contact-form style-1 text-center">
						<form action="#" method="POST">
							<div class="row">
								<div class="col-sm-6">
									<input type="text" name="name" placeholder="Name" required/>
								</div>
								<div class="col-sm-6">
									<input type="text" name="phone" placeholder="Phone" required/>
								</div>
								<div class="col-sm-6">
									<input type="email" name="email" placeholder="Email" required/>
								</div>
								<div class="col-sm-6">
									<select>
										<option value="">Choose Your Service</option>
										<option value="">Lawn Care</option>
										<option value="">Garden Care</option>
										<option value="">Planting</option>
										<option value="">Landscape</option>
									</select>
								</div>
								<div class="col-sm-12">
									<input type="text" name="website" placeholder="Website" required/>
								</div>
								<div class="col-sm-12">
									<textarea name="message" placeholder="Message"></textarea>
								</div>
								<div class="col-sm-12">
									<button class="btn-common btn-border">Send messages</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!--contact-form end-->
	
	<!--cta-area start-->
	<div class="cta-area mt-100 sm-mt-80">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8">
					<div class="cta-text">
						<h3>Live help number <span>(+977) 9843 025 317 - (01) 6618155</span></h3>
						<p>Call Us Now When You Have Any Question.</p>
					</div>
				</div>
				<div class="col-md-4">
					<a href="contact" class="btn-common cta-btn width-190 pull-right">Contact Now</a>
				</div>
			</div>
		</div>
	</div>
	<!--cta-area end-->
	<!--testimonial-area start-->
	<div class="testimonial-area no-bg mt-60">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 col-sm-12">
					<div class="testimonial-items carousel-one arrow-none">
						<div class="single-testimonial">
							<img src="assets/images/testimonial/1.jpg" alt="" />
							<p>We teach Not in Normal, We Proudly say to all the students, we do all the best on the most Optimistic View. We have included 27 courses for SEE & +2 Students and More Extra Courses too. We have just 500 seats only. Thus hurry up for admit and reserve your seat.</p>
							<h4>Bal Krishna Banmala</h4>
							<small>Managing Director</small>
						</div>
						<!-- <div class="single-testimonial">
							<img src="assets/images/testimonial/1.jpg" alt="" />
							<p>I wanted to mention that these days, when the opposite of good customer and tech support <br/> tends to be the norm, it’s always great having a team like you guys at The Garden! So, be sure <br/> that I’ll always spread the word about how good your product is and the extraordinary level of <br/> support that you provide any time there is any need for it.</p>
							<h4>Nancy Franklin</h4>
							<small>UI/UX  Designer</small>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--testimonial-area end-->
	<!--counterup-area start-->

	<?php 
		$student = new student();
		$all_certified = $student->getallStudentwithCertified();
		$count_certified = count($all_certified);
		$all_success = $student->getallStudentwithSuccess();
		$count_success = count($all_success);
		$subscriber = new subscriber();
		$all_subscriber = $subscriber->getallSubscriber();
		$count_sub = count($all_subscriber);
		$view = new view();
		$all_view = $view->getallview();
		$count_view = count($all_view);
	?>
	<div class="counterUp-area sm-mt-10">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-12">
					<div class="single-counter">
						<p class="count-number count1"><?php echo $count_view; ?></p>
						<h4>Views</h4>
					</div>
				</div>
				<div class="col-md-3 col-sm-12">
					<div class="single-counter">
						<p class="count-number count2"><?php echo $count_certified; ?></p>
						<h4>Certified Student</h4>
					</div>
				</div>
				<div class="col-md-3 col-sm-12">
					<div class="single-counter">
						<p class="count-number count3"><?php echo $count_success; ?></p>
						<h4>Success Student</h4>
					</div>
				</div>
				<div class="col-md-3 col-sm-12">
					<div class="single-counter">
						<p class="count-number count4"><?php echo $count_sub; ?></p>
						<h4>Subscriber</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--counterup-area end-->


	<!--blog-area start-->
	<?php 
		$blog = new blog();
		$latest_blog = $blog->getBlogUsingLimit(0,3);
		// debugger($latest_blog);
	?>
	<div class="blog-area mt-85 sm-mt-60">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 offset-sm-2">
					<div class="section-title">
						<h2>Our Latest Blog</h2>
					</div>
				</div>
			</div>
			<div class="row mt-63 sm-mt-40">
				<?php 
					if ($latest_blog) {
						foreach ($latest_blog as $key => $single_blog) {
				?>

				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="single-blog">
						<?php 
							if (isset($single_blog->image) && !empty($single_blog->image) && file_exists(UPLOAD_DIR.'blog/'.$single_blog->image)) {
                                $thumbnail = UPLOAD_URL.'blog/'.$single_blog->image;
                            }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                            }
						?>
						<div class="blog-thumb">
							<a href="blog-details"><img src="<?php echo $thumbnail; ?>" alt="blog-image"></a>
						</div>
						<div class="blog-desc">
							<h3><a href="blog-details"><?php echo $single_blog->title; ?></a></h3>
							<a href="blog-details?b=<?php echo $single_blog->id ?>" class="readmore">Read More</a>
						</div>
					</div>
				</div>
				<?php
						}
					}
				?>
			</div>
		</div>
	</div>
	<!--blog-area end-->
	
	

	<!--testimonial-area start-->
	<?php 
		$testimonial = new student();
		$latest_test = $testimonial->getallStudentwithTestimonialsUsingLimit(0,5);
		// debugger($latest_test);
	?>
	<div class="testimonial-area bg-1 mt-62 sm-mt-30">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 offset-sm-2">
					<div class="section-title text-center">
						<h2>What Client Say</h2>
					</div>
				</div>
			</div>
			<div class="row mt-35">
				<div class="col-lg-10 offset-lg-1 col-md-12">
					<div class="testimonial-items carousel-one arrow-none">
						<?php 
							if ($latest_test) {
								foreach ($latest_test as $key => $test) {
						?>
						<div class="single-testimonial">
							<?php echo html_entity_decode($test->testimonials); ?>
							<h4><?php echo $test->name; ?></h4>
							<small><?php echo $test->courses; ?></small>
						</div>
						<?php
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--testimonial-area end-->
	
	<!--contact-form area-->
	<div class="contact-area mt-80 sm-mt-50">
		<div class="container-fluid p-0">
			<div class="row mt-35">
				<div class="col-lg-6 p-0 sm-p-lr-30">
					<div id="googleMap" class="gmap-one"></div>
				</div>
				<div class="col-lg-6 p-0 sm-p-lr-30 sm-mt-80">
					<div class="contact-form style-2 overlay">
						<form action="#" method="POST">
							<div class="section-title style-4 text-left text-white">
								<h2>Contact Us</h2>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<input type="text" name="name" placeholder="Name" required/>
								</div>
								<div class="col-lg-6">
									<input type="text" name="contact" placeholder="Phone" required/>
								</div>
								<div class="col-lg-6">
									<input type="email" name="email" placeholder="Email" required/>
								</div>
								<div class="col-lg-6">
									<input type="text" name="web" placeholder="Website" required/>
								</div>
								<div class="col-lg-12">
									<input type="text" name="subject" placeholder="Subject" required/>
								</div>
								<div class="col-lg-12">
									<textarea name="message" placeholder="Message"></textarea>
								</div>
								<div class="col-lg-12">
									<button class="btn-common mt-50">Send messages</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--contact-form end-->
	<?php include 'inc/footer.php'; ?>
	<?php include 'inc/map.php'; ?>


<!-- Modal -->
<?php 
	$notice = new notice();
	$latest_notice = $notice->getlatestnotice();
	if ($latest_notice) {
		$latest_notice = $latest_notice[0];
		$notice_time = strtotime((isset($latest_notice->update_date) && !empty($latest_notice->update_date))?$latest_notice->update_date:$latest_notice->created_date);
		$current_time =  date('Y-m-d', strtotime('-1 week'));
		$current_time = strtotime($current_time);
		if ($current_time < $notice_time) {
			if (isset($latest_notice->image) && !empty($latest_notice->image) && file_exists(UPLOAD_DIR.'notice/'.$latest_notice->image)) {
    			$thumbnail = UPLOAD_URL.'notice/'.$latest_notice->image;
  			}else{
				echo "<script>console.log('hl')</script>";
  				$thumbnail = null;
  			}
        	if ($thumbnail) {
			?>
<div class="modal fade bd-example-modal-lg" id="neoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="position: fixed; top: 100px; padding-top: 300px; z-index: 387843;">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <h5 class="modal-title" id="exampleModalCenterTitle" style="color: green; font-family: 'Open Sans', sans-serif;">Welcome to 
					<span style="color: #1362ad;">Neo Fusion School Of Computer</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
      	<img src="<?php echo($thumbnail) ?>" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
		<p style="color: green; font-size: 12px; text-align: center;">You are encouraged to visit school and feel the environment.</p>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#neoModal').modal('show');
    });
</script>
			<?php
        	}else{
        	?>
<div class="modal fade bd-example-modal-lg" id="neoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <h5 class="modal-title" id="exampleModalCenterTitle" style="color: green; font-family: 'Open Sans', sans-serif;">Welcome to 
					<span style="color: #1362ad;">Neo Fusion School Of Computer</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
		<?php echo html_entity_decode($latest_notice->notice); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
		<p style="color: green; font-size: 12px; text-align: center;">You are encouraged to visit school and feel the environment.</p>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#neoModal').modal('show');
    });
</script>
        	<?php
        	}
        ?>
<?php	
		}
	}
?>
