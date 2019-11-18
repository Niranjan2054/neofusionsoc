<?php include 'inc/header.php'; ?>
	<!--page-banner-area start-->
	<div class="page-banner-area bg-6">
		<div class="container">
			<div class="row align-items-center height-400">
				<div class="col-lg-12">
					<div class="page-banner-text text-center">
						<h2>Success Gallery</h2>
						<ul class="site-breadcrumb text-black">
							<li><a href="index">Home</a> <span>></span></li>
							<li><a href="javascript:;">Success Gallery</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--page-banner-area end-->
<?php 
	$pageno = 1;
	if (isset($_GET['page']) && !empty($_GET['page'] && $_GET['page']>0)) {
		$pageno = $_GET['page'];
	}
	$no_of_item = 12;
	$offset = ($pageno-1) * $no_of_item; 
?>
	<!--products-area start-->
	<div class="products-area mt-100 sm-mt-80">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<!--products-area start-->
					<div class="products-area">
						<div class="container">

							<div class="row mt-60 sm-mt-80">
								<div class="col-sm-6">
									
								</div>
								<div class="col-sm-6">
									<div class="product-view-system pull-right" role="tablist">
										<!-- Nav tabs -->
										<ul class="nav nav-tabs">
											<li><a class="active" data-toggle="tab" href="javascript:;home"><i class="fa fa-th-large"></i></a></li>
											<li><a data-toggle="tab" href="javascript:;menu1"><i class="fa fa-th-list"></i></a></li>
										</ul>
										
									</div>
								</div>
							</div>
							<div class="tab-content">
								<div id="home" class="tab-pane active">
									<div class="row">
										<?php 
											$students = new student();
											$all_success_student = $students->getSuccessStudentUsingLimit($offset,$no_of_item);
											$counter = 0;
											if ($all_success_student) {
												foreach ($all_success_student as $key => $student) {
													$counter++;
										?>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="single-product">
												<div class="product-thumb-sin">
													<?php 
														if (isset($student->image) && !empty($student->image) && file_exists(UPLOAD_DIR.'student/'.$student->image)) {
															$thumbnail = UPLOAD_URL.'student/'.$student->image;
														}else{
															$thumbnail = IMAGES_PATH.'no_thumbnail.png';
														}
													?>
													<a href="javascript:;"><img src="<?php echo $thumbnail; ?>" alt="" /></a>
													<div class="product-action">
														<a href="javascript:;" class="add-to-cart">
															<span><?php echo $student->name; ?></span>
														</a>
													</div>
												</div>
												<div class="product-text">
													<h4><a href="javascript:;"><?php echo $student->name; ?></a></h4>
													<span class="product-price"><?php echo $student->workat; ?></span>
												</div>
											</div>
										</div>
										
										<?php
												}
											}
										?>
									</div>
								</div>
								<div id="menu1" class="tab-pane fade">
									<div class="row">
										<div class="col-sm-12">
											<?php 
												if ($all_success_student) {
													foreach ($all_success_student as $key => $student) {
											?>	
												<div class="single-product style-3">
												<div class="row">
													<div class="col-lg-4">
														<?php 
															if (isset($student->image) && !empty($student->image) && file_exists(UPLOAD_DIR.'student/'.$student->image)) {
																$thumbnail = UPLOAD_URL.'student/'.$student->image;
															}else{
																$thumbnail = IMAGES_PATH.'no_thumbnail.png';
															}
														?>
														<div class="product-thumb-sin">
															<a href="javascript:;"><img src="<?php echo $thumbnail; ?>" alt="" /></a>
														</div>
													</div>
													<div class="col-lg-8">
														<div class="product-text">
															<h4><a href="javascript:;"><?php echo $student->name; ?></a></h4>
															<span class="product-price">Working In:<strong><?php echo $student->workat; ?></strong></span>
															<span class="product-price">Course: <strong><?php echo $student->courses; ?></strong></span>
															<span class="product-price">School: <strong><?php echo $student->school; ?></strong></span>
														</div>
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
						</div>
					</div>
					<div class="blog-pagination mt-80 sm-mt-60 fix">
						<a href="successgallery?pageno=<?php echo ($pageno-1) ?>"  class="btn-common btn-left" <?php echo ($pageno<=1)?'style="display: "':''; ?> ><i class="fa fa-angle-left"></i> Newer POSTS</a>
						
						<a href="successgallery?pageno=<?php echo ($pageno+1) ?>" <?php echo ($pageno>(($counter-1)/$no_of_item))?'style="display: "':''; ?> class="btn-common btn-right">Older POSTS <i class="fa fa-angle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<?php include 'inc/footer.php'; ?>