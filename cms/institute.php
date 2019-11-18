<?php 
$header = "Institute";
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
                <h3>Office List</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddinstitute();">Add Institute</a>
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
                    <h2>All Office</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>IsHead</th>
                        <th>Estd</th>
                        <th>Phone</th>
                        <th>gmail</th>
                        <th>Head of Office</th>
                        <th>Image</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $institute = new institute();
                          $allInstitute = $institute->getallInstitute([]);
                          // debugger($allInstitute);
                          // debugger($_SESSION);
                          if ($allInstitute) {
                            foreach ($allInstitute as $key => $institute) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $institute->Name; ?></td>
                            <td><?php echo $institute->location; ?></td>
                            <td><?php echo $institute->ishead; ?></td>
                            <td><?php echo $institute->estd; ?></td>
                            <td><?php echo $institute->phone; ?></td>
                            <td><?php echo $institute->gmail; ?></td>
                            <td><?php echo $institute->director; ?></td>
                            <td>
                              <?php if (isset($institute->image) && !empty($institute->image) && file_exists(UPLOAD_DIR.'institute/'.$institute->image)) {
                                $thumbnail = UPLOAD_URL.'institute/'.$institute->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showeditinstitute(this);" data-institute_data='<?php echo json_encode($institute); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              
                              <?php 
                                $act = substr(md5('Institute-'.$institute->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/institute?id=<?php echo $institute->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this institute?');">
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
        <!-- /institute content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Institute</h4>
              </div>
              <form action="process/institute" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Name of Institute</label>
                    <div class="col-md-6">
                      <input type="text" name="Name" id="Name" required="required" placeholder=" Name of Institute" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Abbreviation of Institute</label>
                    <div class="col-md-6">
                      <input type="text" name="abbr" id="abbr" placeholder=" Abbreviation of Institute" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Location</label>
                    <div class="col-md-6">
                      <input type="text" name="location" id="location" placeholder=" Location of Institute" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Establisment Date of Institute</label>
                    <div class="col-md-6">
                      <input type="date" name="estd" id="estd" placeholder=" Establisment Date of Institute" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Contact Number of Institute</label>
                    <div class="col-md-6">
                      <input type="text" name="phone" id="phone" placeholder=" Contact Number of Institute" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Director of Institute</label>
                    <div class="col-md-6">
                      <input type="text" name="director" id="director" placeholder=" Director of Institute" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Gmail of Institute</label>
                    <div class="col-md-6">
                      <input type="email" name="gmail" id="gmail" placeholder=" Director of Institute" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Map of Institute</label>
                    <div class="col-md-6">
                      <input type="url" name="map" id="map" placeholder=" Google Map URL of Institute" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Is Head</label>
                    <div class="col-md-6">
                      <select name="ishead" id="ishead" class="form-control">
                        <option value="Head">Head</option>
                        <option value="Branch">Branch</option>
                      </select>
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
                  <input type="hidden" name="id" id="institute_id">
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
  function showaddinstitute(){
    $('#myModalLabel').html('Add Institute');
    $('#Name').val('');
    $('#addr').val('');
    $('#location').val('');
    $('#director').val('');
    $('#gmail').val('');
    $('#estd').val('');
    $('#phone').val('');
    $('#map').val('');
    $('#status').val('Active');
    $('#IsHead').val('Head');
    $('#thumbnail').attr('src','<?php echo IMAGES_PATH; ?>/no_thumbnail.png');
    showform();
  }
  function showform(){
    $('.modal').modal();
  }
  function showeditinstitute(element){
    var institute_info = $(element).data('institute_data');
    console.log((institute_info));
    if(typeof(institute_info) != 'object'){
      institute_info = JSON.parse('institute_info');
    }
    $('#myModalLabel').html('Edit Institute');
    $('#Name').val(institute_info.Name);
    $('#abbr').val(institute_info.abbr);
    $('#director').val(institute_info.director);
    $('#location').val(institute_info.location);
    $('#gmail').val(institute_info.gmail);
    $('#estd').val(institute_info.estd);
    $('#phone').val(institute_info.phone);
    $('#map').val(institute_info.map);
    $('#ishead').val(institute_info.ishead);
    $('#estd').val(institute_info.estd);
    $('#link').val(institute_info.link);
    $('#status').val(institute_info.status);
    $('#image').removeAttr('required','required');
    if (institute_info.image)
      $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>institute/'+institute_info.image);
    $('#institute_id').val(institute_info.id);
    $('#old_image').val(institute_info.image);
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

