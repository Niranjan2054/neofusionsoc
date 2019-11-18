<?php include 'inc/header.php'; ?>
	<!--page-banner-area start-->
	<div class="page-banner-area bg-6">
		<div class="container">
			<div class="row align-items-center height-400">
				<div class="col-lg-12">
					<div class="page-banner-text text-center">
						<h2>All Courses</h2>
						<ul class="site-breadcrumb text-black">
							<li><a href="index">Home</a> <span>></span></li>
							<li><a href="#">All Courses</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--page-banner-area end-->

	<!--products-area start-->
	<div class="products-area mt-100 sm-mt-80">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<!--products-area start-->
					<div class="products-area">
						<div class="container">
							<!-- <div class="filter-section">
								<div class="row">
									<div class="col-lg-2 col-md-6">
										<div class="single-sidebar">
											<h4>Sort By</h4>
											<ul class="list-none">
												<li><a href="#">Default</a></li>
												<li><a href="#">Popularity</a></li>
												<li><a href="#">Average rating</a></li>
												<li><a href="#">Price: low to high</a></li>
												<li><a href="#">Price: high to low</a></li>
											</ul>
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="single-sidebar">
											<h4>Price</h4>
											<ul class="list-none">
												<li><a href="#">$0.00 - $50.00</a></li>
												<li><a href="#">$50.00 - $100.00</a></li>
												<li><a href="#">$100.00 - $150.00</a></li>
												<li><a href="#">$150.00 - $200.00</a></li>
												<li><a href="#">$200.00 - 250.00</a></li>
												<li><a href="#">250.00+</a></li>
											</ul>
										</div>
									</div>
									<div class="col-lg-2 col-md-6">
										<div class="single-sidebar no-bg">
											<h4>Categories</h4>
											<ul class="list-none">
												<li><a href="#">Default</a><span>(16)</span></li>
												<li><a href="#">Popularity</a><span>(25)</span></li>
												<li><a href="#">Average rating</a><span>(95)</span></li>
												<li><a href="#">Price: low to high</a><span>(15)</span></li>
												<li><a href="#">Price: high to low</a><span>(10)</span></li>
											</ul>
										</div>
									</div>
									<div class="col-lg-3 col-md-6">
										<div class="single-sidebar">
											<h4>Tags</h4>
											<div class="tags-list style-2">
												<a href="#">Equipments </a>
												<a href="#">Plant</a>
												<a href="#">Seed</a>
												<a href="#">Decoration</a>
												<a href="#">Green</a>
												<a href="#">Pot</a>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 img-100p">
										<a href="#"><img src="assets/images/ad/4.jpg" alt="" /></a>
									</div>
								</div>
							</div> -->
							<div class="row mt-60 sm-mt-80">
								<div class="col-sm-6">
									<!-- <div class="products-sort">
										<form>
											<label>Item Show :</label>
											<select>
												<option>12 Products</option>
												<option>8 Products</option>
												<option>4 Products</option>
											</select>
										</form>
									</div> -->
								</div>
								<div class="col-sm-6">
									<div class="product-view-system pull-right" role="tablist">
										<!-- Nav tabs -->
										<ul class="nav nav-tabs">
											<li><a class="active" data-toggle="tab" href="#home"><i class="fa fa-th-large"></i></a></li>
											<li><a data-toggle="tab" href="#menu1"><i class="fa fa-th-list"></i></a></li>
										</ul>
										
									</div>
								</div>
							</div>
							<div class="tab-content">
								<div id="home" class="tab-pane active">
									<div class="row">
										<?php 
											$courses = new Courses();
											$all_course = $courses->getallCourses();
											if ($all_course) {
												foreach ($all_course as $key => $course) {
										?>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<?php 
														if (isset($course->image) && !empty($course->image) && file_exists(UPLOAD_DIR.'courses/'.$course->image)) {
															$thumbnail = UPLOAD_URL.'courses/'.$course->image;
														}else{
															$thumbnail = IMAGES_PATH.'no_thumbnail.png';
														}
													?>
													<a href="course-detail?c=<?php echo($course->id) ?>"><img src="<?php echo $thumbnail; ?>" alt="" /></a>
													<div class="product-action">
														<a href="course-detail?c=<?php echo($course->id) ?>" class="add-to-cart">
															<span><?php echo $course->title; ?></span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="course-detail?c=<?php echo($course->id) ?>"><?php echo $course->title; ?></a></h4>
													<span class="product-price">Rs. <?php echo $course->price; ?></span>
												</div>
											</div>
										</div>
										<?php
												}
											}
										?>
										<!-- <div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<a href="#"><img src="assets/images/products/2.jpg" alt="" /></a>
													<div class="product-action">
														<a href="#" class="add-to-cart">
															<span>Add to Cart</span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="#">Cactus White</a></h4>
													<span class="product-price">$99.99</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<a href="#"><img src="assets/images/products/3.jpg" alt="" /></a>
													<div class="product-action">
														<a href="#" class="add-to-cart">
															<span>Add to Cart</span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="#">Haworthia Wide Zebra</a></h4>
													<span class="product-price">$29.49</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<a href="#"><img src="assets/images/products/4.jpg" alt="" /></a>
													<div class="product-action">
														<a href="#" class="add-to-cart">
															<span>Add to Cart</span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="#">Aloe vera - herbal</a></h4>
													<span class="product-price">$69.99</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<a href="#"><img src="assets/images/products/5.jpg" alt="" /></a>
													<div class="product-action">
														<a href="#" class="add-to-cart">
															<span>Add to Cart</span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="#">Cactus White</a></h4>
													<span class="product-price">$99.99</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<a href="#"><img src="assets/images/products/6.jpg" alt="" /></a>
													<div class="product-action">
														<a href="#" class="add-to-cart">
															<span>Add to Cart</span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="#">Haworthia Wide Zebra</a></h4>
													<span class="product-price">$29.49</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<a href="#"><img src="assets/images/products/1.jpg" alt="" /></a>
													<div class="product-action">
														<a href="#" class="add-to-cart">
															<span>Add to Cart</span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="#">Aloe vera - herbal</a></h4>
													<span class="product-price">$69.99</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<a href="#"><img src="assets/images/products/2.jpg" alt="" /></a>
													<div class="product-action">
														<a href="#" class="add-to-cart">
															<span>Add to Cart</span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="#">Cactus White</a></h4>
													<span class="product-price">$99.99</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<a href="#"><img src="assets/images/products/3.jpg" alt="" /></a>
													<div class="product-action">
														<a href="#" class="add-to-cart">
															<span>Add to Cart</span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="#">Haworthia Wide Zebra</a></h4>
													<span class="product-price">$29.49</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<a href="#"><img src="assets/images/products/4.jpg" alt="" /></a>
													<div class="product-action">
														<a href="#" class="add-to-cart">
															<span>Add to Cart</span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="#">Aloe vera - herbal</a></h4>
													<span class="product-price">$69.99</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<a href="#"><img src="assets/images/products/5.jpg" alt="" /></a>
													<div class="product-action">
														<a href="#" class="add-to-cart">
															<span>Add to Cart</span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="#">Cactus White</a></h4>
													<span class="product-price">$99.99</span>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<a href="#"><img src="assets/images/products/6.jpg" alt="" /></a>
													<div class="product-action">
														<a href="#" class="add-to-cart">
															<span>Add to Cart</span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="#">Haworthia Wide Zebra</a></h4>
													<span class="product-price">$29.49</span>
												</div>
											</div>
										</div> -->
									</div>
								</div>
								<div id="menu1" class="tab-pane fade">
									<div class="row">
										<div class="col-sm-12">
											<?php 
												if ($all_course) {
													foreach ($all_course as $key => $course) {
											?>	
												<div class="single-product style-3">
												<div class="row">
													<div class="col-lg-4">
														<?php 
															if (isset($course->image) && !empty($course->image) && file_exists(UPLOAD_DIR.'courses/'.$course->image)) {
																$thumbnail = UPLOAD_URL.'courses/'.$course->image;
															}else{
																$thumbnail = IMAGES_PATH.'no_thumbnail.png';
															}
														?>
														<div class="product-thumb-sin">
															<a href="course-detail?c=<?php echo($course->id) ?>"><img src="<?php echo $thumbnail; ?>" alt="" /></a>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="product-text">
															<h4><a href="course-detail?c=<?php echo($course->id) ?>"><?php echo $course->title; ?></a></h4>
															<span class="product-price">Rs. <?php echo $course->price; ?></span>
															<span class="product-price">Duration of Course: <?php echo $course->Duration; ?></span>
															<a href="course-detail?c=<?php echo($course->id) ?>" class="add-to-cart btn-common">View Detail</a>
														</div>
													</div>
												</div>
											</div>		
											<?php
													}
												}
											?>
											
											<!-- <div class="single-product style-3">
												<div class="row">
													<div class="col-lg-4">
														<div class="product-thumb-sin">
															<a href="#"><img src="assets/images/products/2.jpg" alt="" /></a>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="product-text">
															<h4><a href="#">Post Hole Digger</a></h4>
															<span class="product-price">$79.49</span>
															<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nul...</p>
															<a href="#" class="add-to-cart btn-common">Add to Cart</a>
														</div>
													</div>
												</div>
											</div>
											<div class="single-product style-3">
												<div class="row">
													<div class="col-lg-4">
														<div class="product-thumb-sin">
															<a href="#"><img src="assets/images/products/3.jpg" alt="" /></a>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="product-text">
															<h4><a href="#">Expandable Garden Hose</a></h4>
															<span class="product-price">$50.99</span>
															<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nul...</p>
															<a href="#" class="add-to-cart btn-common">Add to Cart</a>
														</div>
													</div>
												</div>
											</div>
											<div class="single-product style-3">
												<div class="row">
													<div class="col-lg-4">
														<div class="product-thumb-sin">
															<a href="#"><img src="assets/images/products/4.jpg" alt="" /></a>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="product-text">
															<h4><a href="#">Pro Garden Gear</a></h4>
															<span class="product-price">$45.00</span>
															<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nul...</p>
															<a href="#" class="add-to-cart btn-common">Add to Cart</a>
														</div>
													</div>
												</div>
											</div>
											<div class="single-product style-3">
												<div class="row">
													<div class="col-lg-4">
														<div class="product-thumb-sin">
															<a href="#"><img src="assets/images/products/5.jpg" alt="" /></a>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="product-text">
															<h4><a href="#">Cactus White</a></h4>
															<span class="product-price">$99.99</span>
															<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nul...</p>
															<a href="#" class="add-to-cart btn-common">Add to Cart</a>
														</div>
													</div>
												</div>
											</div>
											<div class="single-product style-3">
												<div class="row">
													<div class="col-lg-4">
														<div class="product-thumb-sin">
															<a href="#"><img src="assets/images/products/6.jpg" alt="" /></a>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="product-text">
															<h4><a href="#">Aloe vera - herbal</a></h4>
															<span class="product-price">$69.99</span>
															<p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nul...</p>
															<a href="#" class="add-to-cart btn-common">Add to Cart</a>
														</div>
													</div>
												</div>
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="row">
								<div class="col-sm-12">
									<div class="msk-pagination style-3 text-center mt-60 sm-mt-55 fix">
										<ul>
											<li><a href="#">Prev</a></li>
											<li class="active"><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">Next</a></li>
										</ul>
									</div>
								</div>
							</div> -->
						</div>
					</div>
					<!--products-area end-->
				</div>
			</div>
		</div>
	</div>
	<!--products-area end-->
	
	<!--subscribe-area start-->
	<!-- <div class="subscribe-area mt-85 sm-mt-65 xs-mt-50">
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