<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="dashboard" class="site_title"><i class="fa fa-paw"></i> <span><?php echo SITE_NAME; ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <!-- <div class="profile clearfix">
              <div class="profile_pic">
                <img src="assets/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
              <div class="clearfix"></div>
            </div> -->
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!-- <h3>General</h3> -->
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="banner">banner</a></li>
                      <li><a href="banner_video">Video</a></li>
                      <li><a href="institute">Official Details</a></li>
                      <li><a href="page">pages</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bell"></i> Notice <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="add-notice">Add Notice</a></li>
                      <li><a href="notice">List Notice</a></li>
                    </ul>
                  </li>
                  <li><a href="courses"><i class="fa fa-book"></i> Courses</span></a>
                  </li>
                  <li><a><i class="fa fa-envelope"></i> Client Activity <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="enquiry">Join Class</a></li>
                      <li><a href="contact">Contact</a></li>
                      <li><a href="subscriber">Subscriber</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-group"></i> Student <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="student">Admit New Student</a></li>
                      <li><a href="student-list">List Student</a></li>
                      <li><a href="successGallery">Success Gallery</a></li>
                      <li><a href="testimonials">Testimonials</a></li>
                      <li><a href="certified">Certified Student</a></li>
                      <li><a href="transaction">Transaction (Payment)</a></li>
                    </ul>
                  </li>
                  <!-- <li><a><i class="fa fa-desktop"></i> Serrvices <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="weddingphotography">Wedding Photography</a></li>
                      <li><a href="computerworkshop">Computer Workshop</a></li>
                      <li><a href="artworkshop">Art Workshop</a></li>
                      <li><a href="scout">Scout</a></li>
                      <li><a href="freecourses">Free Courses</a></li>
                    </ul> -->
                  </li>
                  <li><a href="project"><i class="fa fa-tasks"></i> Project</span></a>
                  </li>
                  <li><a href="gallery"><i class="fa fa-file-image-o"></i> Gallery</span></a>
                  </li>
                  <li><a href="blog"><i class="fa fa-newspaper-o"></i> Blog</span></a>
                  </li>
                  <!-- <li><a href="busfair"><i class="fa fa-bus"></i> Bus Fair</span></a>
                  </li> -->
                  <li><a href="advertisement"><i class="fa fa-dollar"></i> Advertisement</a>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="assets/images/logo.png" alt=""><?php echo $_SESSION['admin_name']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <!-- <li><a href="javascript:;"> Profile</a></li> -->
                    <li><a href="password-change"> Password Change</a></li>
                    <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->