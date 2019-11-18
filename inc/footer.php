<!--subscribe-area start-->
	<div class="subscribe-area mt-95 sm-mt-75">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="subscribe-form">
						<h3>Subscribe To Our Newletter</h3>
						<p>Get Update</p>
						<?php 
							if (isset($_SERVER['success']) && !empty($_SERVER['success'])) {
						?>
						<p id="sub">Subscribed</p>
						<?php
							}
						 ?>
						<form action="process/subscriber" method="post">
							<input type="email" name="email" placeholder="Your Email" required="required" />
							<button class="btn-common">Subscribe</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--subscribe-area end-->
	
	<!--footer-area start-->
	
	<footer class="footer-area">
		<!--footer-top-->
		<div class="footer-widgets">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-sm-6">
						<div class="footer-widget style-2">
							<h4><?php echo $office->abbr; ?></h4>
							<div class="about-widget">
								<p>Hi!, Warm Welcome to Neo Fusion School Of Computer. We are giving a most skillfull computer training from last 12 years with the objective of better Education</p>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="footer-widget style-2">
							<h4>Contact Info</h4>
							<div class="contact-info style-3">
								<ul>
									<li><i class="fa fa-home"></i><?php echo $office->abbr; ?>, <?php echo $office->location; ?></li>
									<li><i class="fa fa-phone"></i>01 6618155</li>
									<li><i class="fa fa-mobile"></i>+977 <?php echo $office->phone; ?></li>
									<li><i class="fa fa-envelope"></i><?php echo $office->gmail; ?></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="footer-widget style-2">
							<h4>Navigation</h4>
							<div class="fooer-menu">
								<ul class="mr-40">
									<li><a href="all-course">Courses</a></li>
									<li><a href="about">About Us</a></li>
									<li><a href="contact">Contact Us</a></li>
									<li><a href="blog">Blog</a></li>
									<li><a href="#" onclick="linked()">Trace us</a></li>
									<!-- <li><a href="busfair">Bus Fee</a></li> -->
									<!-- <li><a href="javascript:;" onclick="modal()">Trace Us</a></li> -->
									<!-- <li><a href="javascript:;" onclick="redirect();" target="_blank">Trace Us</a></li> -->
								</ul>
								<ul>
									<!-- <li><a href="service-1">Wedding Photography</a></li>
									<li><a href="service-2">Art Workshop</a></li>
									<li><a href="service-3">Computer Workshop</a></li> -->
									<li><a href="gallery">Photo Gallery</a></li>
									<li><a href="successgallery">Success Gallery</a></li>
									<li><a href="certificate">Verify Certificate</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="footer-widget style-2">
							<h4>Working Hours</h4>
							<div class="work-hours">
								<ul class="list-none">
									<li>Sunday <span>06:00-20:00</span></li>
									<li>Monday <span>06:00-20:00</span></li>
									<li>Tuesday <span>06:00-20:00</span></li>
									<li>Wednesday <span>06:00-20:00</span></li>
									<li>Thursday <span>06:00-20:00</span></li>
									<li>Friday <span>06:00-20:00</span></li>
									<li>Saturday <span>CLOSE</span></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--footer copyright-->
		<div class="footer-copyright">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<p><a href="javascript:;" style="color: white;size: 14px;">Designed and Developed By: Niranjan Bekoju</a></p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--footer-area end-->
  
	<!-- modernizr js -->
	<script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
	<!-- jquery-1.12.0 version -->
	<script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
	<!-- bootstra.min js -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- meanmenu js -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- easing js -->
	<script src="assets/js/jquery.easing.min.js"></script>
	<!---venobox-js-->
	<script src="assets/js/venobox.min.js"></script>
	<!---slick-js-->
	<script src="assets/js/slick.min.js"></script>
	<!---waypoints-js-->
	<script src="assets/js/waypoints.js"></script>
	<!---counterup-js-->
	<script src="assets/js/jquery.counterup.min.js"></script>
	<!---isotop-js-->
	<script src="assets/js/isotope.pkgd.min.js"></script>
	<!-- jquery-ui js -->
	<script src="assets/js/jquery-ui.min.js"></script>
	<!-- jquery.countdown js -->
	<script src="assets/js/jquery.countdown.min.js"></script>
	<!-- plugins js -->
	<script src="assets/js/plugins.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>
	
</body>

</html>
<script>
	// function modal(){
	// 	if(navigator.geolocation){
	//         // timeout at 60000 milliseconds (60 seconds)
	//         var options = {timeout:60000};
	//         navigator.geolocation.getCurrentPosition
	//         (showLocation, errorHandler, options);
 //        	$('#modal').modal();
 //        } else{
 //        	alert("Sorry, browser does not support geolocation!");
 //        }
	// }
	// function showLocation(position) {
	//     var latitude = position.coords.latitude;
	//     console.log(latitude);
	//     var longitude = position.coords.longitude;
	//     console.log(longitude);
	//     var latlongvalue = position.coords.latitude + ","
	//     + position.coords.longitude;
	//     var img_url = "https://www.google.com/maps/embed?pb=!1m24!1m12!1m3!1d56536.71419619838!2d85.40507283431812!3d27.669556915318946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m9!3e2!4m3!3m2!1d"+latitude+"999998!2d"+longitude+"99999!4m3!3m2!1d27.6728968!2d85.43374679999999!5e0!3m2!1sen!2snp!4v1553012390131";
	//     // document.getElementById("mapholder").innerHTML ="<img src='"+img_url+"'>";
	//     document.getElementById("map").setAttribute("src",img_url);
 // 	}
	// function errorHandler(err) {
	// 	if(err.code == 1) {
	// 		alert("Error: Access is denied!");
	// 	} else if( err.code == 2) {
	// 		alert("Error: Position is unavailable!");
	// 	}
	// }
</script>
<!--  Modal -->
<!-- <div class="modal fade" tabindex="-1" id="modal" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">">
    <div class="modal-content">
      <div class="modal-body">
		<iframe src="https://www.google.com/maps/embed?pb=!1m24!1m12!1m3!1d56536.71419619838!2d85.40507283431812!3d27.669556915318946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m9!3e2!4m3!3m2!1d27.6485299999998!2d85.409249999999!4m3!3m2!1d27.6728968!2d85.43374679999999!5e0!3m2!1sen!2snp!4v1553012390131" width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen id="map"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->
 
<!-- <script type="text/javascript">
	
	var gps = navigator.geolocation.getCurrentPosition(function (position) {
  		for (key in position.coords) {
	  		document.write(key+’: ‘+ position.coords[key]);
	  		document.write (‘<br>‘);
  		}
 	});
	
</script> -->
