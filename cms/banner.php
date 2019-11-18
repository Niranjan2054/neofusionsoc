<?php 
$header = "Banner";
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
                <h3>Banner List</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddbanner();">Add Banner</a>
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
                    <h2>All Banner</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Thumbnail</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $banner = new banner();
                          $allBanner = $banner->getallBanner([]);
                          // debugger($allBanner);
                          // debugger($_SESSION);
                          if ($allBanner) {
                            foreach ($allBanner as $key => $banner) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $banner->title; ?></td>
                            <td><a href="<?php echo $banner->link; ?>" target="_blank"><?php echo $banner->link; ?></a></td>
                            <td><?php echo $banner->status; ?></td>
                            <td>
                              <?php if (isset($banner->image) && !empty($banner->image) && file_exists(UPLOAD_DIR.'banner/'.$banner->image)) {
                                $thumbnail = UPLOAD_URL.'banner/'.$banner->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showeditbanner(this);" data-banner_data='<?php echo json_encode($banner); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              
                              <?php 
                                $act = substr(md5('Banner-'.$banner->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/banner?id=<?php echo $banner->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this banner?');">
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
        <!-- /banner content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Banner</h4>
              </div>
              <form action="process/banner" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Title</label>
                    <div class="col-md-6">
                      <input type="text" name="title" id="title" required="required" placeholder=" Banner Title" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Link</label>
                    <div class="col-md-6">
                      <input type="url" name="link" id="link" placeholder=" Banner Link" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Status</label>
                    <div class="col-md-6">
                      <select name="status" id="status" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Image</label>
                    <div class="col-md-3">
                     <input type="file" accept="image/*" name="image" id="image" required="required" onchange="showThumbnail(this);">
                    </div>
                    <div class="col-md-2">
                      <img src="<?php echo IMAGES_PATH; ?>/no_thumbnail.png" alt="" width='400px' id="thumbnail">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" id="banner_id">
                  <input type="hidden" name="old_image" id="old_image">
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
  function showaddbanner(){
    $('#myModalLabel').html('Add Banner');
    $('#title').val('');
    $('#link').val('');
    $('#status').val('Active');
    $('#thumbnail').attr('src','<?php echo IMAGES_PATH; ?>/no_thumbnail.png');
    showform();
  }
  function showform(){
    $('.modal').modal();
  }
  function showeditbanner(element){
    var banner_info = $(element).data('banner_data');
    console.log((banner_info));
    if(typeof(banner_info) != 'object'){
      banner_info = JSON.parse('banner_info');
    }
    $('#myModalLabel').html('Edit Banner');
    $('#title').val(banner_info.title);
    $('#link').val(banner_info.link);
    $('#status').val(banner_info.status);
    $('#image').removeAttr('required','required');
    if (banner_info.image)
    $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>banner/'+banner_info.image);
    $('#banner_id').val(banner_info.id);
    $('#old_image').val(banner_info.image);
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

