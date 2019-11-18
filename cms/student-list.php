<?php 
$header = "Dashboard";
include_once 'inc/header.php'; 
include_once 'inc/checklogin.php';
?>
    <div class="container body">
      <div class="main_container">
        <?php include 'inc/sidebar.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php flashMessage(); ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Student</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Student List</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Gmail</th>
                        <th>Courses</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $student = new student();
                          $students = $student->getallStudent([]);
                          if ($students) {
                            foreach ($students as $key => $student) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $student->name; ?></td>
                            <td><?php echo $student->contact; ?></td>
                            <td><?php echo $student->gmail; ?></td>
                            <td><?php echo $student->courses; ?></td>
                            <td>
                              <?php if (isset($student->image) && !empty($student->image) && file_exists(UPLOAD_DIR.'student/'.$student->image)) {
                                $thumbnail = UPLOAD_URL.'student/'.$student->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td><?php echo $student->status; ?></td>
                            <td>
                              <a href="./student?id=<?php echo $student->id; ?>&amp;act=<?php echo substr(md5("Edit-student-from-list".$_SESSION['token'].$student->id), 3,14) ?>"  class="btn btn-primary"><i class="fa fa-pencil"></i></a> 
                              <?php 
                                $act = substr(md5('student-'.$student->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/student?id=<?php echo $student->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this Student from LIST?');">
                                  <i class="fa fa-trash"></i>
                                </a>

                               <a href="./student-detail?id=<?php echo $student->id; ?>&amp;act=<?php echo substr(md5("detail-student-from-list".$_SESSION['token'].$student->id), 3,14) ?>" class="btn btn-info"><i class="fa fa-info"></i></a></td>
                          </tr>
                          <?php
                            }
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php include_once 'inc/footer.php'; ?>
<script src="<?php echo JS_PATH; ?>datatables.min.js"></script>
