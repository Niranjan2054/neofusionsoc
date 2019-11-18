<?php 
$header = "Advertisement";
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
                <h3>Advertisement List</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddadvertisement();">Add Advertisement</a>
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
                    <h2>All Advertisement</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Thumbnail</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $advertisement = new advertisement();
                          $allAdvertisement = $advertisement->getallAdvertisement([]);
                          // debugger($allAdvertisement);
                          // debugger($_SESSION);
                          if ($allAdvertisement) {
                            foreach ($allAdvertisement as $key => $advertisement) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><a href="<?php echo $advertisement->link; ?>" target="_blank"><?php echo $advertisement->link; ?></a></td>
                            <td><?php echo $advertisement->status; ?></td>
                            <td>
                              <?php if (isset($advertisement->image) && !empty($advertisement->image) && file_exists(UPLOAD_DIR.'advertisement/'.$advertisement->image)) {
                                $thumbnail = UPLOAD_URL.'advertisement/'.$advertisement->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showeditadvertisement(this);" data-advertisement_data='<?php echo json_encode($advertisement); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              
                              <?php 
                                $act = substr(md5('Advertisement-'.$advertisement->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/advertisement?id=<?php echo $advertisement->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this advertisement?');">
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
        <!-- /advertisement content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Advertisement</h4>
              </div>
              <form action="process/advertisement" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Link</label>
                    <div class="col-md-6">
                      <input type="url" name="link" id="link" placeholder=" Advertisement Link" class="form-control">
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
                  <input type="hidden" name="id" id="advertisement_id">
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
  function showaddadvertisement(){
    $('#myModalLabel').html('Add Advertisement');
    $('#link').val('');
    $('#status').val('Active');
    $('#thumbnail').attr('src','<?php echo IMAGES_PATH; ?>/no_thumbnail.png');
    showform();
  }
  function showform(){
    $('.modal').modal();
  }
  function showeditadvertisement(element){
    var advertisement_info = $(element).data('advertisement_data');
    console.log((advertisement_info));
    if(typeof(advertisement_info) != 'object'){
      advertisement_info = JSON.parse('advertisement_info');
    }
    $('#myModalLabel').html('Edit Advertisement');
    $('#link').val(advertisement_info.link);
    $('#status').val(advertisement_info.status);
    $('#image').removeAttr('required','required');
    if (advertisement_info.image)
    $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>advertisement/'+advertisement_info.image);
    $('#advertisement_id').val(advertisement_info.id);
    $('#old_image').val(advertisement_info.image);
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

