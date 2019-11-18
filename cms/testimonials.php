<?php 
$header = "Testimonials";
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
                <h3>Testimonials List</h3>
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
                    <h2>All Testimonials</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Courses</th>
                        <th>Message</th>
                        <th>Image</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $student = new student();
                          $allTestimonials = $student->getallStudentwithTestimonials([]);
                          // debugger($allTestimonials);
                          // debugger($_SESSION);
                          if ($allTestimonials) {
                            foreach ($allTestimonials as $key => $student) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $student->name; ?></td>
                            <td><?php echo $student->courses; ?></td>
                            <td><?php echo html_entity_decode($student->testimonials); ?></td>
                            <td>
                              <?php if (isset($student->image) && !empty($student->image) && file_exists(UPLOAD_DIR.'student/'.$student->image)) {
                                $thumbnail = UPLOAD_URL.'student/'.$student->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showedittestimonials(this);" data-testimonials_data='<?php echo json_encode($student,true); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              
                              <?php 
                                $act = substr(md5('student-'.$student->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/testimonials?id=<?php echo $student->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this Testimonials?');">
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
        <!-- /testimonials content -->

        <div class="modal fade bs-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Testimonials</h4>
              </div>
              <form action="process/testimonials" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Message:</label>
                    <div class="col-md-6">
                      <textarea name="testimonials" id="testimonials" rows="10" class="form-control">
                      </textarea>
                    </div>
                  </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" id="testimonials_id" value="<?php echo $_GET['id']; ?>">
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
  function showaddtestimonials(){
    $('#myModalLabel').html('Add Testimonials');
    $('#title').val('');
    ckEditor2();
    ckEditor();
    $('#detail').val('');
    $('#price').val('');
    $('#instructor').val('');
    $('#Duration').val('');
    $('#status').val('Active');
    $('#thumbnail').attr('src','<?php echo IMAGES_PATH; ?>/no_thumbnail.png');
    showform();
  }
  function showform(){
    $('.modal').modal();
  }
  function showedittestimonials(element){
    var testimonials_info = $(element).data('testimonials_data');
    console.log((testimonials_info));
    if(typeof(testimonials_info) != 'object'){
      testimonials_info = JSON.parse(testimonials_info);
    }
    $('#myModalLabel').html('Edit Testimonials');
    ckEditor(testimonials_info.testimonials);
    $('#testimonials_id').val(testimonials_info.id);
    $('#old_image').val(testimonials_info.image);
    showform();
  }
function insertIntoCkeditor(str){
    CKEDITOR.instances['editor1'].setData(str);
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
<script src="<?php echo CKEDITOR_PATH; ?>ckeditor.js"></script>
<script type="text/javascript">
  ckEditor();
  // ckEditor2();

  function ckEditor(data=''){
    $('.ck').remove();
    ClassicEditor
        .create( document.querySelector('#testimonials'),{
          ckfinder:{
            uploadUrl: '<?php echo CKFINDER_PATH; ?>core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
          }
        } )
        .then(editor=>{
          editor.setData(data);
        })
        .catch( error => {
            console.error( error );
        } );
  }
  // function ckEditor2(data=''){
  //   $('.ck').remove();
  //   ClassicEditor
  //       .create( document.querySelector('#summary'),{
  //         ckfinder:{
  //           uploadUrl: '<?php echo CKFINDER_PATH; ?>core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
  //         }
  //       } )
  //       .then(editor=>{
  //         editor.setData(data);
  //       })
  //       .catch( error => {
  //           console.error( error );
  //       } );
  // }
</script>