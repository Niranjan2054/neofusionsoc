<?php include 'inc/header.php'; ?>
	<!--page-banner-area start-->
	<div class="page-banner-area bg-5">
		<div class="container">
			<div class="row align-items-center height-400">
				<div class="col-lg-12">
					<div class="page-banner-text text-center text-white">
						<h2>Gallery</h2>
						<ul class="site-breadcrumb">
							<li><a href="#">Home</a> <span>></span></li>
							<li>Gallery Details</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--page-banner-area end-->
	<?php
		if ($_GET) {
		 	if (isset($_GET['gid']) && !empty($_GET['gid']) && $_GET['gid']>0) {
		 		$gallery_id = (int)$_GET['gid'];
				$gallery = new gallery();
		 		$gallery_info = $gallery->getGalleryById($gallery_id);
		 		if ($gallery_info) {
		 			$gallery_info = $gallery_info[0];
		 			$image = new image();
		 			$gallery_image = $image->getImageUsingLimit(0,2,$gallery_id);
		 		}else{
		 			setFlash('gallery');
		 		}
		 	}else{	
		 		setFlash('gallery');
		 	}
		}else{
			setFlash('gallery');
		} 
	?>
	<!--gallery-details start-->
	<div class="gallery-details-area mt-95 sm-mt-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="project-gallery-details">
						<h4><?php echo $gallery_info->title; ?></h4>
						<?php echo html_entity_decode($gallery_info->description); ?>
						<div class="slider slider-for mt-15 sm-mt-45">
							<?php if (isset($gallery_info->featured_image) && !empty($gallery_info->featured_image) && file_exists(UPLOAD_DIR.'gallery/'.$gallery_info->featured_image)) {
                            $thumbnail = UPLOAD_URL.'gallery/'.$gallery_info->featured_image;
                          }else{
                            $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                          } ?>
							<div>
								<img src="<?php echo $thumbnail; ?>" alt="" />
							</div>
							<?php 
								if ($gallery_image) {
									foreach ($gallery_image as $key => $gal) {
							
										if (isset($gal->image) && !empty($gal->image) && file_exists(UPLOAD_DIR.'gallery/'.$gal->image)) {
                           					$thumbnail1 = UPLOAD_URL.'gallery/'.$gal->image;
                          				}else{
                            				$thumbnail1 = IMAGES_PATH.'no_thumbnail.png';
                          				} 
                          	?>
							<div>
								<img src="<?php echo $thumbnail1 ?>" alt="" />
							</div>
							<?php
									}
								}
							?>
							
							<!-- <div>
								<img src="assets/images/projects/gallery-details/3.jpg" alt="" />
							</div> -->
						</div>
						<div class="slider slider-nav mt-15">
							<div class="single-nav">
								<img src="<?php echo $thumbnail; ?>" alt="" />
							</div>
							<?php 
								if ($gallery_image) {
									foreach ($gallery_image as $key => $gal) {
							
										if (isset($gal->image) && !empty($gal->image) && file_exists(UPLOAD_DIR.'gallery/'.$gal->image)) {
                           					$thumbnail1 = UPLOAD_URL.'gallery/'.$gal->image;
                          				}else{
                            				$thumbnail1 = IMAGES_PATH.'no_thumbnail.png';
                          				} 
                          	?>
							
							<div class="single-nav">
								<img src="<?php echo $thumbnail1; ?>" alt="" />
							</div>
							<?php
									}
								}
							?>
							<!-- <div class="single-nav">
								<img src="assets/images/projects/gallery-details/3.jpg" alt="" />
							</div> -->
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="row mt-25">
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="project-info">
						<h5><i class="fa fa-user"></i>Client</h5>
						<p>John Wick</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="project-info">
						<h5><i class="fa fa-map-marker"></i>Location</h5>
						<p>20 Green Farm, New Zealand</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="project-info">
						<h5><i class="fa fa-tag"></i>Categories</h5>
						<p>Redesign , Garden House , Deco</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="project-info">
						<h5><i class="fa fa-calendar"></i>Date</h5>
						<p>June 06, 2017</p>
					</div>
				</div>
			</div> -->
		</div>
	</div>
	<!--gallery-details end-->
<?php include 'inc/footer.php'; ?>