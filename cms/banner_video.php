<?php 
$header = "Video";
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
                <h3>Video List</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddvideo();">Add Video</a>
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
                    <h2>All Video</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Link</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $video = new video();
                          $allVideo = $video->getallVideo([]);
                          // debugger($allVideo);
                          // debugger($_SESSION);
                          if ($allVideo) {
                            foreach ($allVideo as $key => $video) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><a href="<?php echo($video->link); ?>" target="_blank"><?php echo $video->link; ?></a></td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showeditvideo(this);" data-video_data='<?php echo json_encode($video); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              
                              <?php 
                                $act = substr(md5('Video-'.$video->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/video?id=<?php echo $video->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this video?');">
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
        <!-- /video content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Video</h4>
              </div>
              <form action="process/video" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Link</label>
                    <div class="col-md-6">
                      <input type="url" name="link" id="link" placeholder=" Video Link" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" id="video_id">
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
  function showaddvideo(){
    $('#myModalLabel').html('Add Video');
    $('#title').val('');
    $('#link').val('');
    $('#status').val('Active');
    $('#thumbnail').attr('src','<?php echo IMAGES_PATH; ?>/no_thumbnail.png');
    showform();
  }
  function showform(){
    $('.modal').modal();
  }
  function showeditvideo(element){
    var video_info = $(element).data('video_data');
    console.log((video_info));
    if(typeof(video_info) != 'object'){
      video_info = JSON.parse('video_info');
    }
    $('#myModalLabel').html('Edit Video');
    $('#title').val(video_info.title);
    $('#link').val(video_info.link);
    $('#status').val(video_info.status);
    $('#image').removeAttr('required','required');
    if (video_info.image)
    $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>video/'+video_info.image);
    $('#video_id').val(video_info.id);
    $('#old_image').val(video_info.image);
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

