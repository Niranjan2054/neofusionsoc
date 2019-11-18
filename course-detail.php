<?php include 'inc/header.php'; ?>
	<!--page-banner-area start-->
	<div class="page-banner-area bg-6">
		<div class="container">
			<div class="row align-items-center height-400">
				<div class="col-lg-12">
					<div class="page-banner-text text-center">
						<h2>Course Detail</h2>
						<ul class="site-breadcrumb text-black">
							<li><a href="index">Home</a> <span>></span></li>
							<li><a href="#">Product Details</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--page-banner-area end-->
	<?php 
		// debugger($_GET);
		if ($_GET) {
			if (isset($_GET['c']) && !empty($_GET['c']) && $_GET['c']>0) {
				$id = $_GET['c'];
				$courses = new Courses();
				$course = $courses->getCoursesById($id);
				// debugger($course);
				$course = $course[0];
				if (isset($course->image) && !empty($course->image) && file_exists(UPLOAD_DIR.'courses/'.$course->image)) {
					$thumbnail = UPLOAD_URL.'courses/'.$course->image;
				}else{
					$thumbnail = IMAGES_PATH.'no_thumbnail.png';
				}
				// echo $thumbnail;
			}else{
				setflash('all-course');
			}
		}else{
			setflash('all-course');
		}
	 ?>
	<!--product-details-area start-->
	<div class="product-details-area mt-100 sm-mt-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-1 col-md-2 col-sm-12">
					<!-- <ul class="nav nav-tabs products-nav-tabs">
						<li><a class="active" data-toggle="tab" href="#product-1"><img src="assets/images/products/product-details/thumb-1.jpg" alt="" /></a></li>
						<li><a data-toggle="tab" href="#product-2"><img src="assets/images/products/product-details/thumb-2.jpg" alt="" /></a></li>
						<li><a data-toggle="tab" href="#product-3"><img src="assets/images/products/product-details/thumb-3.jpg" alt="" /></a></li>
					</ul> -->
				</div>
				<div class="col-lg-5 col-md-6 col-sm-12">
					<div class="tab-content">
						<div id="product-1" class="tab-pane fade in show active">
							<img src="<?php echo $thumbnail; ?>" alt="" />
						</div>
						<!-- <div id="product-2" class="tab-pane fade">
							<img src="assets/images/products/product-details/2.jpg" alt="" />
						</div>
						<div id="product-3" class="tab-pane fade">
							<img src="assets/images/products/product-details/3.jpg" alt="" />
						</div> -->
					</div>
				</div>
				<div class="col-lg-6">
					<div class="single-product-details">
						<h2><?php echo $course->title; ?></h2>
						<!-- <div class="product-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-o"></i>
							<i class="fa fa-star-o"></i>
						</div> -->
						<span class="product-price">Rs. <?php echo $course->price; ?></span>
						<p>
							<?php echo html_entity_decode($course->summary); ?>
						</p>
						<div class="product-quantity-update mt-50">
							<table>
								<tr>
									<!-- <td>
										<div class="cart-quantity-changer pull-left">
											<a class="value-decrease qtybutton">-</a>
											<input type="text" value="1" />
											<a class="value-increase qtybutton">+</a>
										</div>
									</td> -->
									<td>
										<a href="enquiry?c=<?php echo $course->id; ?>" class="btn-common pull-left">Join Course</a>
									</td>
								</tr>
							</table>
						</div>
						<div class="product-sku-category mt-55">
							<table>
								<!-- <tr>
									<td>SKU:</td>
									<td>515565</td>
								</tr>
								<tr>
									<td>Categories:</td>     
									<td>Plant</td>
								</tr> -->
								<tr>
									<td>Share Link:</td>     
									<td>
										<div class="social-icons">
											<a href="#"><i class="fa fa-facebook"></i></a>
											<a href="#"><i class="fa fa-twitter"></i></a>
											<a href="#"><i class="fa fa-instagram"></i></a>
											<a href="#"><i class="fa fa-youtube"></i></a>
											<a href="#"><i class="fa fa-skype"></i></a>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--product-details-area end-->
	
	<!--product-review-area start-->
	<div class="product-review-area mt-70 pt-60">
		<div class="container">
			<div class="product-review-section">
				<div class="row">
					<div class="col-lg-12">
						<ul class="nav nav-tabs text-center">
							<li><a class="active" data-toggle="tab" href="#product-desc">Description</a></li>
							<li><a data-toggle="tab" href="#product-review" style="visibility: hidden;">Reviews (1)</a></li>
						</ul>
					</div>
				</div>
				<div class="row mt-40">
					<div class="col-lg-8">
						<div class="tab-content product-review-desc">
							<div id="product-desc" class="tab-pane fade in show active">
								<?php echo html_entity_decode($course->detail); ?>
							</div>
							<div id="product-review" class="tab-pane fade">
								<div class="blog-comments product-comments mt-0">
									<ul class="list-none">
										<li>
											<div class="comment-avatar">
												<img src="assets/images/blog/comment/1.jpg" alt="" />
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
											</div>
											<div class="comment-desc">
												<h4>Cobus Bester </h4>
												<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore.</p>
											</div>
										</li>
									</ul>
								</div>
								<div class="blog-comment-form product-comment-form">
									<h4><span>Add Review</span></h4>
									<div class="row mt-30">
										<div class="col-sm-6 single-form">
											<input type="text" placeholder="Name" />
										</div>
										<div class="col-sm-6">
											<input type="text" placeholder="Email" />
										</div>
										<div class="col-sm-12">
											<div class="product-rating style-2">
												<h4>Your Rating:</h4>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div>
										</div>
										<div class="col-sm-12">
											<textarea placeholder="Messages"></textarea>
										</div>
										<div class="col-sm-12">
											<button class="btn-common mt-25">Submit</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--product-review-area end-->
	
	
<?php include 'inc/footer.php'; ?>