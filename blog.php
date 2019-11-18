<?php include 'inc/header.php'; ?>

	<!--page-banner-area start-->
	<div class="page-banner-area bg-8">
		<div class="container">
			<div class="row align-items-center height-400">
				<div class="col-lg-12">
					<div class="page-banner-text text-center text-white">
						<h2>Blog</h2>
						<ul class="site-breadcrumb">
							<li><a href="#">Home</a> <span>></span></li>
							<li>Blog</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--banner-area end-->
	
	<!--blog-area start-->
	<div class="blog-area mt-100 sm-mt-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12">
					<?php 
						if (isset($_GET['pageno']) && !empty($_GET['pageno'])) {
							$pageno = (int)$_GET['pageno'];
						}else{
							$pageno = 1;
						}
						$total_data = 4;
						$offset = ($pageno-1) * $total_data;
						$blogs = new blog();
						$all_blog = $blogs->getallBlog();
						if ($all_blog) {
							$counter =0;
							foreach ($all_blog as $key => $value) {
								$counter++;	
							}
						}
						$page_blog = $blogs->getBlogUsingLimit($offset, $total_data);
						foreach ($page_blog as $key => $blog) {
						// debugger($page_blog);
					?>
					<div class="single-blog style-3 mb-60">
						<div class="row">
							<div class="col-lg-6">
								 <?php if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_DIR.'blog/'.$blog->image)) {
                                $thumbnail = UPLOAD_URL.'blog/'.$blog->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
								<div class="blog-thumb">
									<a href="blog-details?b=<?php echo $blog->id; ?>"><img src="<?php echo $thumbnail; ?>" alt="blog-image"></a>
								</div>
							</div>
							<div class="col-lg-6 p-0">
								<div class="blog-desc text-left">
									<h3><a href="blog-details?b=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
									<ul class="list-none blog-meta">
										<li>
											<a href="#"><?php echo date('M d Y',strtotime($blog->created_date)); ?></a>
										</li>
									</ul>
									<a href="blog-details?b=<?php echo $blog->id; ?>" class="btn-common">Read More</a>
								</div>
							</div>
						</div>
					</div>
					<?php
						}
					?>
					
				<!-- 	<div class="single-blog style-3 mb-60">
						<div class="row">
							<div class="col-lg-6">
								<div class="blog-thumb">
									<a href="#"><img src="assets/images/blog/10.jpg" alt="blog-image"></a>
								</div>
							</div>
							<div class="col-lg-6 p-0">
								<div class="blog-desc text-left">
									<h3><a href="#">Reach for the Treetops!</a></h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
									<a href="#" class="btn-common">Read More</a>
								</div>
							</div>
						</div>
					</div>
					<div class="single-blog style-3 mb-60">
						<div class="row">
							<div class="col-lg-6">
								<div class="blog-thumb">
									<a href="#"><img src="assets/images/blog/10.jpg" alt="blog-image"></a>
								</div>
							</div>
							<div class="col-lg-6 p-0">
								<div class="blog-desc text-left">
									<h3><a href="#">Reach for the Treetops!</a></h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
									<a href="#" class="btn-common">Read More</a>
								</div>
							</div>
						</div>
					</div>
					<div class="single-blog style-3 mb-60">
						<div class="row">
							<div class="col-lg-6">
								<div class="blog-thumb">
									<a href="#"><img src="assets/images/blog/10.jpg" alt="blog-image"></a>
								</div>
							</div>
							<div class="col-lg-6 p-0">
								<div class="blog-desc text-left">
									<h3><a href="#">Reach for the Treetops!</a></h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
									<a href="#" class="btn-common">Read More</a>
								</div>
							</div>
						</div>
					</div>
					 -->
					
					<div class="blog-pagination mt-80 sm-mt-60 fix">
						<a href="blog?pageno=<?php echo ($pageno-1) ?>"  class="btn-common btn-left" <?php echo ($pageno<=1)?'style="display: none"':''; ?> ><i class="fa fa-angle-left"></i> Newer POSTS</a>
						
						<a href="blog?pageno=<?php echo ($pageno+1) ?>" <?php echo ($pageno>(($counter-1)/$total_data))?'style="display: none"':''; ?> class="btn-common btn-right">Older POSTS <i class="fa fa-angle-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12">
					<div class="sidebar sidebar-right">
						<!--recent-post-->
						<div class="single-sidebar no-bg">
							<h4>Recent News</h4>
							<div class="blog-recent-post">
								<ul class="list-none">
									<?php 
										$recent_blog = $blogs->getBlogUsingLimit(0, 4);
										if ($recent_blog) {
											foreach ($recent_blog as $key => $blog) {
									?>
									<li>
										<h5><a href="http://neofusionsoc.com/blog-details?b=<?php echo($blog->id) ?>"><?php echo $blog->title; ?></a></h5><br style="line-height: 0%"><br style="line-height: 0px">
										<small><?php echo date("M d, Y",strtotime((isset($blog->updated_date) && !empty($blog->updated_date))?$blog->updated_date:$blog->created_date)); ?></small>
									</li>
									<?php
											}
										}
									?>
								</ul>
							</div>
						</div>
						<?php
							$advertisement = new advertisement();
							$ads = $advertisement->getlatestadvertisement();
							// $ads = $ads[0];
							if (isset($ads[0]->image) && !empty($ads[0]->image) && file_exists(UPLOAD_DIR.'advertisement/'.$ads[0]->image)) {
								$thumbnail = UPLOAD_URL.'advertisement/'.$ads[0]->image;
						?>
						<div class="ad-placeholder overlay">
							<img src="<?php echo $thumbnail; ?>" alt="" />
							<!-- <div class="adplace-text">
 								<h4>Banner Advertising</h4>
  								<span>350 x 300</span>
 							</div> -->
						</div>
						<?php

							}
						?>
						<!-- <div class="single-sidebar no-bg">
							<h4>Categories</h4>
							<ul class="p-0 ml-20">
								<li><a href="#">Flower Growth (3)</a></li>
								<li><a href="#">Gardening (7)</a></li>
								<li><a href="#">Nature Changes (1)</a></li>
								<li><a href="#">Plant Care (3)</a></li>
								<li><a href="#">Uncategorized (8)</a></li>
							</ul>
						</div>
						<div class="single-sidebar no-bg sm-mb-0">
							<h4>Popular Tags</h4>
							<div class="tags-list style-2">
								<a href="#">Equipments</a>
								<a href="#">Plant</a>
								<a href="#">Seed</a>
								<a href="#">Decoration</a>
								<a href="#">Green</a>
								<a href="#">Pot</a>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--blog-area end-->
	<?php include 'inc/footer.php'; ?>