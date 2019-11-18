<?php 
$header = "Notice";
include_once 'inc/header.php'; 
include_once 'inc/checklogin.php';
if ($_GET) {
  if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
    $notice_id = (int)$_GET['id'];
    if ($notice_id) {
      if (isset($_GET['act']) && !empty($_GET['act'])) {
        if ($_GET['act'] == substr(md5("Edit-notice-from-list".$_SESSION['token'].$notice_id), 3,14)) {
          $notice_obj = new notice();
          $notice_info = $notice_obj->getNoticeById($notice_id);
          $notice_info = $notice_info[0];
          // debugger($notice_info);
        }else{
          setFlash('notice-list','error','Action not Supported');
        }
      }else{
        setFlash('notice-list','error','Action not Specified');
      }
    }else{
      setFlash('notice-list','error','Invalid Notice Id');
    }
  }else{
    setFlash('notice-list','error','Invalid Access');
  }
}
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
                <h3>Notice</h3>
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
                    <h2> Add Notice</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form action="process/notice" class="form form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="form-group row">
                            <label for="" class="col-md-2">Description of Notice:</label>
                            <div class="col-md-6">
                              <textarea name="notice" id="notice" rows="10" class="form-control" ><?php echo (isset($notice_info->notice) && !empty($notice_info->notice))?$notice_info->notice:""; ?></textarea>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="" class="col-md-2 col-lg-2">Image</label>
                            <div class="col-md-3">
                             <input type="file" accept="image/*" name="image" id="image"  onchange="showThumbnail(this);">
                            </div>
                             <?php 
                              if (isset($notice_info->image) && !empty($notice_info->image) && file_exists(UPLOAD_DIR.'notice/'.$notice_info->image)) {
                                $thumbnail = UPLOAD_URL.'notice/'.$notice_info->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                            <div class="col-md-2">
                              <img src="<?php echo($thumbnail); ?>" alt="" width='400px' id="thumbnail">
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="hidden" name="id" id="notice_id" value="<?php echo (isset($notice_info->id) && !empty($notice_info->id))?$notice_info->id:''; ?>">
                          <input type="hidden" name="old_image" id="old_image" value="<?php echo (isset($notice_info->image) && !empty($notice_info->image))?$notice_info->image:''; ?>">
                          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php include_once 'inc/footer.php'; ?>
<script src="<?php echo CKEDITOR_PATH; ?>ckeditor.js"></script>
<script type="text/javascript">
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
  
  ckEditor();
  function ckEditor(data=''){
    $('.ck').remove();
    ClassicEditor
        .create( document.querySelector('#notice'),{
          ckfinder:{
            uploadUrl: '<?php echo CKFINDER_PATH; ?>core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
          }
        } )
        .then(editor=>{
          //editor.setData(data);
        })
        .catch( error => {
            console.error( error );
        } );
    }
  
</script>