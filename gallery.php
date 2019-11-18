<?php include 'inc/header.php'; ?>
	<!--page-banner-area start-->
	<div class="page-banner-area bg-5">
		<div class="container">
			<div class="row align-items-center height-400">
				<div class="col-lg-12">
					<div class="page-banner-text text-center text-white">
						<h2>Gallery</h2>
						<ul class="site-breadcrumb">
							<li><a href="javascript:;">Home</a> <span>></span></li>
							<li>Gallery</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--page-banner-area end-->
	<?php 
		$page = 1;
		if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page']>0) {
			$page = $_GET['page'];
		}
		$no_of_item = 8;
		$offset = ($page-1) * $no_of_item;
	?>
	<!--project-area start-->
	<div class="project-area mt-90 sm-mt-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="section-title text-center">
						<h3>Photo Gallery</h3>
					</div>
				</div>
			</div>
			<div class="row mt-35">
				<div class="col-lg-12">
					<div class="project-nav">
						<ul>
							<li data-filter="*" class="active">All Photo</li>
							<li data-filter=".excursion">Excursion</li>
							<li data-filter=".event">Program</li>
							<li data-filter=".classes">Classes</li>
							<li data-filter=".participation">Participation</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row mt-35 project-items">
			<?php 
				$gallery = new gallery();
				$counter = 0;
				$gallerries = $gallery->getallGallery();
				if ($gallerries) {
					$counter = count($gallerries);
				}
				$all_gallery = $gallery->getGalleryUsingLimit($offset,$no_of_item);
				// debugger($all_gallery);
				foreach ($all_gallery as $key => $Gallery) {
			?>

				<div class="col-lg-3 col-md-6 col-sm-12 <?php echo $Gallery->type; ?>">
					<div class="single-project mb-30">
						<?php if (isset($Gallery->featured_image) && !empty($Gallery->featured_image) && file_exists(UPLOAD_DIR.'gallery/'.$Gallery->featured_image)) {
                            $thumbnail = UPLOAD_URL.'gallery/'.$Gallery->featured_image;
                          }else{
                            $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                          } ?>
						<div class="project-thumb">
							<img src="<?php echo $thumbnail; ?>" alt=""/>
						</div>
						<div class="project-desc">
							<a class="venobox" data-gall="projectGallery" href="<?php echo $thumbnail; ?>"><i class="fa fa-expand"></i></a>
							<h4  style="margin-top: -60px;"><a href="gallery-details?gid=<?php echo $Gallery->id; ?>" style="margin-top: -90px;"><?php echo $Gallery->title; ?></a></h4>
						</div>
					</div>
				</div>

			<?php
				}
			?>
			</div>
			<div class="blog-pagination mt-80 sm-mt-60 fix">
				<a href="gallery?page=<?php echo ($page-1) ?>"  class="btn-common btn-left" <?php echo ($page<=1)?'style="display: none"':''; ?> ><i class="fa fa-angle-left"></i> Newer POSTS</a>
				
				<a href="gallery?page=<?php echo ($page+1) ?>" <?php echo ($page>(($counter-1)/$no_of_item))?'style="display: none"':''; ?> class="btn-common btn-right">Older POSTS <i class="fa fa-angle-right"></i></a>
			</div>
		</div>
	</div>
	<!--project-area end-->
	<?php include 'inc/footer.php'; ?>