<?php 
$header = "Notice";
include_once 'inc/header.php'; 
include_once 'inc/checklogin.php';
?>
<script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>
    <div class="container body">
      <div class="main_container">
        <?php include 'inc/sidebar.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php flashMessage(); ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Notice List</h3>
              </div>
              <div class="title_right">
                <!-- <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddnotice();">Add Notice</a> -->
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
                    <h2>All Notice</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $notice = new notice();
                          $allNotice = $notice->getallNotice([]);
                          // debugger($allNotice);
                          // debugger($_SESSION);
                          if ($allNotice) {
                            foreach ($allNotice as $key => $notice) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo html_entity_decode($notice->notice); ?></td>
                            <td>
                              <?php if (isset($notice->image) && !empty($notice->image) && file_exists(UPLOAD_DIR.'notice/'.$notice->image)) {
                                $thumbnail = UPLOAD_URL.'notice/'.$notice->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td style="font-size: 20px;">
                              <a href="./add-notice?id=<?php echo $notice->id; ?>&amp;act=<?php echo substr(md5("Edit-notice-from-list".$_SESSION['token'].$notice->id), 3,14) ?>"  class="btn btn-primary"><i class="fa fa-pencil"></i></a> 
                              <?php 
                                $act = substr(md5('Notice-'.$notice->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/notice?id=<?php echo $notice->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this notice?');">
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
        <!-- /notice content -->

       <!--  <div class="modal fade bs-example-modal-lg" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Notice</h4>
              </div>
              <form action="process/notice" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2">Description of Notice:</label>
                    <div class="col-md-6">
                      <textarea name="notice" id="notice" rows="10" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Image</label>
                    <div class="col-md-3">
                     <input type="file" accept="image/*" name="image" id="image"  onchange="showThumbnail(this);">
                    </div>
                    <div class="col-md-2">
                      <img src="<?php echo IMAGES_PATH; ?>/no_thumbnail.png" alt="" width='400px' id="thumbnail">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" id="notice_id">
                  <input type="hidden" name="old_image" id="old_image">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>

            </div>
          </div>
        </div> -->
<?php include_once 'inc/footer.php'; ?>
<script src="<?php echo JS_PATH; ?>datatables.min.js"></script>
<script>

//   function showaddnotice(){
//     $('#myModalLabel').html('Add Notice');
//     ckEditor();
//     $('#notice').val('');
//     $('#thumbnail').attr('src','<?php echo IMAGES_PATH; ?>/no_thumbnail.png');
//     showform();
//   }
//   function showform(){
//     $('.modal').modal();
//   }
//   function showeditnotice(element){
//     var notice_info = $(element).data('notice_data');
//     console.log((notice_info));
//     if(typeof(notice_info) != 'object'){
//       notice_info = JSON.parse(notice_info);
//     }
//     $('#myModalLabel').html('Edit Notice');
//     ckEditor(notice_info.notice);
//     $('#image').removeAttr('required','required');
//     if (notice_info.image)
//       $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>notice/'+notice_info.image);
//     $('#notice_id').val(notice_info.id);
//     $('#old_image').val(notice_info.image);
//     showform();
//   }
// function insertIntoCkeditor(str){
//     CKEDITOR.instances['editor1'].setData(str);
// }


// function showThumbnail(input){
//     console.log(input);
//     if(input.files && input.files[0]){
//       var reader = new FileReader();
//     }
//     reader.onload = function(e){
//       $('#thumbnail').attr('src',e.target.result);
//     }
//     reader.readAsDataURL(input.files[0]);
//   }
//     function ckEditor(data=''){
//     $('.ck').remove();
//     ClassicEditor
//         .create( document.querySelector('#notice'),{
//           ckfinder:{
//             uploadUrl: '<?php echo CKFINDER_PATH; ?>core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
//           }
//         } )
//         .then(editor=>{
//           editor.setData(data);
//         })
//         .catch( error => {
//             console.error( error );
//         } );
//   }
</script>