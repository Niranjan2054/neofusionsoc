<?php 
$header = "Success Gallery";
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
                <h3>Success Student List</h3>
              </div>
              <div class="title_right">
                <!-- <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddgallery();">Add Gallery</a> -->
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
                    <h2>All Success Student</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>School/College</th>
                        <th>Academic Level</th>
                        <th>Course</th>
                        <th>Work At</th>
                        <th>Image</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $gallery = new student();
                          $allGallery = $gallery->getallStudentwithSuccess([]);
                          // debugger($allGallery);
                          // debugger($_SESSION);
                          if ($allGallery) {
                            foreach ($allGallery as $key => $gallery) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $gallery->name; ?></td>
                            <td><?php echo $gallery->school; ?></td>
                            <td><?php echo $gallery->academicLevel; ?></td>
                            <td><?php echo $gallery->courses; ?></td>
                            <td><?php echo $gallery->workat; ?></td>
                            <td>
                              <?php if (isset($gallery->image) && !empty($gallery->image) && file_exists(UPLOAD_DIR.'student/'.$gallery->image)) {
                                $thumbnail = UPLOAD_URL.'student/'.$gallery->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showeditgallery(this);" data-gallery_data='<?php echo json_encode($gallery); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              
                              <?php 
                                $act = substr(md5('Gallery-'.$gallery->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/successgallery?id=<?php echo $gallery->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this gallery?');">
                                  <i class="fa fa-trash"></i>
                                </a>
                            </td>
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
        <!-- /gallery content -->

        <div class="modal fade bs-example-modal-lg" id="modal2" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add in Success Gallery</h4>
              </div>
              <form action="process/successGallery" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Work At:</label>
                    <div class="col-md-6">
                      <input type="text" name="workat" id="workat" required="required" class="form-control" placeholder=" Currently Working Place">
                    </div>
                  </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" id="successGallery_id" value="">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>

            </div>
          </div>
        </div>
<?php include_once 'inc/footer.php'; ?>
<script src="<?php echo JS_PATH; ?>datatables.min.js"></script>
<script>
  function showaddgallery(){
    $('#myModalLabel').html('Add Gallery');
    $('#Name').val('');
    $('#school').val('');
    $('#courses').val('');
    $('#academicLevel').val('');
    $('#workat').val('');
    $('#thumbnail').attr('src','<?php echo IMAGES_PATH; ?>/no_thumbnail.png');
    showform();
  }
  function showform(){
    $('.modal').modal();
  }
  function showeditgallery(element){
    var gallery_info = $(element).data('gallery_data');
    console.log((gallery_info));
    if(typeof(gallery_info) != 'object'){
      gallery_info = JSON.parse('gallery_info');
    }
    $('#myModalLabel').html('Edit Gallery');
    $('#workat').val(gallery_info.workat);
    $('#successGallery_id').val(gallery_info.id);
    showform();
  }

  function showThumbnail(input){
    console.log(input);
    if(input.files && input.files[0]){
      var reader = new FileReader();
    }
    reader.onload = function(e){
      $('#thumbnail').attr('src',e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
</script>

