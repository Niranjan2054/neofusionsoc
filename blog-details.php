<?php include 'inc/header.php'; ?>
	<!--page-banner-area start-->
	<div class="page-banner-area bg-8">
		<div class="container">
			<div class="row align-items-center height-400">
				<div class="col-lg-12">
					<div class="page-banner-text text-center text-white">
						<h2>Blog Details</h2>
						<ul class="site-breadcrumb">
							<li><a href="#">Home</a> <span>></span></li>
							<li>Blog Details</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--banner-area end-->
	<?php 
		if ($_GET) {
			if (isset($_GET['b']) && !empty($_GET['b']) && $_GET['b']>0) {
				$b = $_GET['b'];
				$blogs = new blog();
				$blog = $blogs->getBlogById($b);
				$blog = $blog[0];
			}
		}else{
			setFlash('blog');
		}
	?>
	<!--blog-area start-->
	<div class="blog-area mt-100 sm-mt-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12">
					<div class="blog-details">
						<?php if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_DIR.'blog/'.$blog->image)) {
                                $thumbnail = UPLOAD_URL.'blog/'.$blog->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
						<div class="blog-thumb mb-30">
							<img src="<?php echo $thumbnail; ?>" alt="" />
						</div>
						<div class="blog-details-title">
							<h3><?php echo $blog->title; ?></h3>
						</div>
						<div class="blog-details-text">
							<?php echo html_entity_decode($blog->description); ?>
						</div>
					</div>
					<?php 
						$comments = new comment();
						$all_comment = $comments->getActiveCommentByPostId($b);
						$count = count($all_comment);
					 ?>
					<div class="blog-tag-social">
						<div class="row align-items-center">
							<div class="col-lg-6">
								<div class="tags-list">
									<a href="#">Equipments </a>
									<a href="#">Plant</a>
									<a href="#">Seed</a>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="social-icons style-3 style-4 pull-right">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a name="fb_share" type="button" href="https://www.facebook.com/sharer.php?u=<?php echo("google.com") ?>&t=TEst" target="_blank">share on Facebook</a>

									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-instagram"></i></a>
									<a href="#"><i class="fa fa-youtube"></i></a>
									<a href="#"><i class="fa fa-skype"></i></a>
								</div>
								<div class="comments-list pull-right">
									<a href="#"><i class="fa fa-comment-o"></i><?php echo $count; ?></a>
									<span>|</span>
								</div>
							</div>
						</div>
					</div>
					<div class="blog-comments">
						<h4><?php echo $count; ?> Comments</h4>
						<ul class="list-none">

						<?php 

							if ($all_comment) {
								foreach ($all_comment as $key => $main_comment) {
									if ($main_comment->commentid !=0  || ($main_comment->status=='Inactive')) {
										continue;
									}
						?>
						<li>
								<div class="comment-avatar">
									<img src="assets/images/logo.png" alt="" />
								</div>
								<div class="comment-desc">
									<small><?php echo date('d M Y', strtotime((isset($main_comment->updated_date) && !empty($main_comment->updated_date))?$main_comment->updated_date:$main_comment->created_date)); ?></small>
									<h4><?php echo $main_comment->commentor; ?></h4>
								<p><?php echo $main_comment->comment; ?></p>
									<div class="comment-reaction">
										
										<!-- <a href="#" data-like_id="<?php echo $main_comment->id; ?>" onclick="likes(this)"> -->
										<!-- <?php 
											$like = new like();
											$all_like = $like->getLikeByCommentId($main_comment->id);
											if ($all_like) {
												echo $all_like[0]->likes." ";
											}
										?>
										Like</a> -->
										<a href="#section" data-comment_id="<?php echo $main_comment->id; ?>" onclick="entry(this);">Reply</a>
									</div>
								</div>
								<ul class="list-none">
								<?php 
									foreach ($all_comment as $key => $child_comment) {
										if(($child_comment->commentid)==0 || ($child_comment->commentid) != ($main_comment->id) || ($child_comment->status=='Inactive')){
											continue;
										}
								?>
									<li>
										<div class="comment-avatar">
											<img src="assets/images/logo.png" alt="" />
										</div>
										<div class="comment-desc">
											<small><?php echo date('d M Y', strtotime((isset($child_comment->updated_date) && !empty($child_comment->updated_date))?$child_comment->updated_date:$child_comment->created_date)); ?></small>
											<h4><?php echo $child_comment->commentor; ?></h4>
											<p><?php echo $child_comment->comment; ?></p>
											<div class="comment-reaction">
												<!-- <a href="#" data-like_id="<?php echo $child_comment->id; ?>" onclick="likes(this)">
												<?php 
													$like = new like();
													$all_like = $like->getLikeByCommentId($child_comment->id);
													if ($all_like) {
														echo $all_like[0]->likes." ";
													}
												?>
												Like</a> -->
												<!-- <a href="#">Reply</a> -->
											</div>
										</div>
									</li>
								<?php
									}
								?>
								</ul>
							</li>
						<?php		
								}
							}
						?>




							<!-- <li>
								<div class="comment-avatar">
									<img src="assets/images/blog/comment/1.jpg" alt="" />
								</div>
								<div class="comment-desc">
									<small>27 Aug 2016</small>
									<h4>Brandon Kelley</h4>
									<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam.</p>
									<div class="comment-reaction">
										<a href="#">Like</a>
										<a href="#">Reply</a>
									</div>
								</div>
								<ul class="list-none">
									<li>
										<div class="comment-avatar">
											<img src="assets/images/blog/comment/4.jpg" alt="" />
										</div>
										<div class="comment-desc">
											<small>27 Aug 2016</small>
											<h4>Alex Manning</h4>
											<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam.</p>
											<div class="comment-reaction">
												<a href="#">Like</a>
												<a href="#">Reply</a>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<li>
								<div class="comment-avatar">
									<img src="assets/images/blog/comment/2.jpg" alt="" />
								</div>
								<div class="comment-desc">
									<small>27 Aug 2016</small>
									<h4>Jackson Nash</h4>
									<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam.</p>
									<div class="comment-reaction">
										<a href="#">Like</a>
										<a href="#">Reply</a>
									</div>
								</div>
							</li>
							<li>
								<div class="comment-avatar">
									<img src="assets/images/blog/comment/3.jpg" alt="" />
								</div>
								<div class="comment-desc">
									<small>27 Aug 2016</small>
									<h4>Ollie Schneider</h4>
									<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam.</p>
									<div class="comment-reaction">
										<a href="#">Like</a>
										<a href="#">Reply</a>
									</div>
								</div>
							</li> -->
						</ul>
					</div>
					<div class="blog-comment-form mt-50">
						<div id="section" style="height: 60px;"></div>
						<h4>Leave A Comment</h4>
						<form class="row mt-30">
							<div class="col-sm-6 single-form">
								<input type="number" name="b" id="b" value="<?php echo $b ?>" style="display: none;" />
								<input type="text" name="posttitle" id="posttitle" value="<?php echo $blog->title; ?>" style="display: none;" />
							</div>
							<div class="col-sm-6 single-form">
								<input type="number" name="commentid" id="commentid" style="display: none;"/>
							</div>
							<div class="col-sm-6 single-form">
								<input type="text" placeholder="Name" name="commentor" id="commentor" />
							</div>
							<div class="col-sm-6">
								<input type="text" placeholder="Email" name="email" id="email" />
							</div>
							<div class="col-sm-12 mt-30">
								<textarea placeholder="Message" id="comment"></textarea>
							</div>
							<div class="col-sm-12">
								<button type="button" class="btn-common mt-25" id="submit_comment">Send Comment</button>
								<span id="comment-message">Comments Will Be Added After Verification!</span>
							</div>
						</form>
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
										<h5><a href="blog-details?b=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h5><br style="line-height: 0%"><br style="line-height: 0px">
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
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--blog-area end-->
	
<?php include 'inc/footer.php'; ?>
<script>
	$('#submit_comment').click(function(){
		var b = $('#b').val();
		var commentid = $('#commentid').val();
		var posttitle = $('#posttitle').val();
		var commentor = $('#commentor').val();
		var email = $('#email').val();
		var comment = $('#comment').val();
	    $.ajax({
	      url: 'process/api',
	      method: 'post',
	      data: {
	        b: b,
	        commentid: commentid,
	        commentor: commentor,
	        comment: comment,
	        posttitle: posttitle,
	        email: email,
	        act: '<?php echo substr(md5("insert-comment"),3,20); ?>'
	      }
	    })
	    .done(function(ret){
	      console.log(ret);
	      if(typeof(ret) != 'object'){
	        ret = $.parseJSON(ret);
	      }
	      ret = ret.body[0];
	      console.log(ret);
	      if (ret >=1) {
	      	$('#comment-message').css('display', 'inline-block')
	      }
	    })
	    .fail(function(data){
	    });
	});
	function entry(element){
		var commentid = $(element).data('comment_id');
		console.log(commentid);
		$('#commentid').val(commentid);
	}
	function likes(element){
		var like_id = $(element).data('like_id');
		console.log(like_id);
		$.ajax({
			url: 'process/api',
			method: 'post',
			data: {
				act: '<?php echo substr(md5("Hit Like"), 3,10) ?>',
				id: like_id
			}
		})
		.done(function(ret){
			console.log(ret);
		});
	}
</script>