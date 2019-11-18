
<?php
$header = "Contact Us";
 include 'inc/header.php'; ?>
	<!--page-banner-area start-->
	<div class="page-banner-area bg-7">
		<div class="container">
			<div class="row align-items-center height-400">
				<div class="col-lg-12">
					<div class="page-banner-text text-white text-center">
						<h2>Contact Us</h2>
						<ul class="site-breadcrumb">
							<li><a href="index">Home</a> <span>></span></li>
							<li><a href="#">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--page-banner-area end-->
	
	<!--contact-area start-->
	<div class="contact-area mt-100 sm-mt-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="contact-info">
						<h3>Keep In Touch</h3>
						<div class="single-contact-info">
							<h4><i class="fa fa-map-marker"></i>Address</h4>
							<p>Neo Fusion School Of Computuer,<br>Liwali, Bhaktapur Nepal </p>
						</div>
						<div class="single-contact-info">
							<h4><i class="fa fa-phone"></i>Phone</h4>
							<p>Mobile: (+977) 9843 025 317</p>
							<p>Hotline: 01– 6618 155</p>
						</div>
						<div class="single-contact-info">
							<h4><i class="fa fa-envelope"></i>Email</h4>
							<p>info@neofusionsoc.com</p>
							<p>neofusion014@gmail.com</p>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-8 sm-mt-75">
					<div class="contact-form style-3">
						<form id="contactForm" data-toggle="validator" method="POST" action="process/contact">
							<div class="row">
								<div class="col-lg-6">
									<input type="text" placeholder="Name" id="name" name="name" required data-error="NEW ERROR MESSAGE" />
								</div>
								<div class="col-lg-6">
									<input type="text" placeholder="Email" id="email" name="email" required/>
								</div>
								<div class="col-lg-6">
									<input type="number" placeholder="Contact" id="contact" name="contact" required/>
								</div>
								<div class="col-lg-6">
									<input type="url" placeholder="Website (Optional)" id="web" name="web" />
								</div>
								<div class="col-lg-12">
									<input type="text" placeholder="Subject" id="subject" name="subject" required/>
								</div>
								<div class="col-lg-12">
									<textarea placeholder="Message" id="message" name="message" required></textarea>
								</div>
								<div class="col-lg-4">
									<button class="btn-common" id="form-submit">Send message</button>
								</div>
								<div class="col-lg-8 text-left pt-30">
									<div id="msgSubmit" class="hidden"></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--contact-area end-->
	
	<!--google-map area start-->
	<div class="google-map-area mt-80 sm-mt-75 xs-mt-50">
		<div id="googleMap" class="gmap-two"></div>
	</div>
	<!--google-map area end-->
	
	<!--brands-area start-->
	<!-- <div class="brand-area bg-white">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="brand-items">
						<div class="brand-item">
							<a href="#">
								<img class="brand-static" src="assets/images/brands/1.png" alt="" />
								<img class="brand-dynamic" src="assets/images/brands/1-hover.png" alt="" />
							</a>
						</div>
						<div class="brand-item">
							<a href="#">
								<img class="brand-static" src="assets/images/brands/2.png" alt="" />
								<img class="brand-dynamic" src="assets/images/brands/2-hover.png" alt="" />
							</a>
						</div>
						<div class="brand-item">
							<a href="#">
								<img class="brand-static" src="assets/images/brands/3.png" alt="" />
								<img class="brand-dynamic" src="assets/images/brands/3-hover.png" alt="" />
							</a>
						</div>
						<div class="brand-item">
							<a href="#">
								<img class="brand-static" src="assets/images/brands/4.png" alt="" />
								<img class="brand-dynamic" src="assets/images/brands/4-hover.png" alt="" />
							</a>
						</div>
						<div class="brand-item">
							<a href="#">
								<img class="brand-static" src="assets/images/brands/5.png" alt="" />
								<img class="brand-dynamic" src="assets/images/brands/5-hover.png" alt="" />
							</a>
						</div>
						<div class="brand-item">
							<a href="#">
								<img class="brand-static" src="assets/images/brands/6.png" alt="" />
								<img class="brand-dynamic" src="assets/images/brands/6-hover.png" alt="" />
							</a>
						</div>
						<div class="brand-item">
							<a href="#">
								<img class="brand-static" src="assets/images/brands/7.png" alt="" />
								<img class="brand-dynamic" src="assets/images/brands/7-hover.png" alt="" />
							</a>
						</div>
						<div class="brand-item">
							<a href="#">
								<img class="brand-static" src="assets/images/brands/8.png" alt="" />
								<img class="brand-dynamic" src="assets/images/brands/8-hover.png" alt="" />
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!--brands-area end-->
	
	<!--subscribe-area start-->
	<!-- <div class="subscribe-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="subscribe-form">
						<h3>Subscribe To Our Newletter</h3>
						<p>We will send you the monthly Newsletter</p>
						<input type="email" placeholder="Your Email" />
						<button class="btn-common">Subscribe</button>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!--subscribe-area end-->
	<?php include 'inc/footer.php'; ?>
	<?php include 'inc/map.php'; ?>