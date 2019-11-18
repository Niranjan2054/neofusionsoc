<?php 
$header = "Courses";
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
                <h3>Courses List</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddcourses();">Add Courses</a>
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
                    <h2>All Courses</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Instructor</th>
                        <th>Duration</th>
                        <th>Image</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $courses = new courses();
                          $allCourses = $courses->getallCourses([]);
                          // debugger($allCourses);
                          // debugger($_SESSION);
                          if ($allCourses) {
                            foreach ($allCourses as $key => $courses) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $courses->title; ?></td>
                            <td><?php echo $courses->price; ?></td>
                            <td><?php echo $courses->instructor; ?></td>
                            <td><?php echo $courses->Duration; ?></td>
                            <td>
                              <?php if (isset($courses->image) && !empty($courses->image) && file_exists(UPLOAD_DIR.'courses/'.$courses->image)) {
                                $thumbnail = UPLOAD_URL.'courses/'.$courses->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showeditcourses(this);" data-courses_data='<?php echo json_encode($courses); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              
                              <?php 
                                $act = substr(md5('Courses-'.$courses->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/courses?id=<?php echo $courses->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this courses?');">
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
        <!-- /courses content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Courses</h4>
              </div>
              <form action="process/courses" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Name of Courses</label>
                    <div class="col-md-6">
                      <input type="text" name="title" id="title" required="required" placeholder=" Name of Courses" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2">Summary of Courses:</label>
                    <div class="col-md-6">
                      <textarea name="summary" id="summary" rows="5" class="form-control">
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2">Description of Courses:</label>
                    <div class="col-md-6">
                      <textarea name="detail" id="detail" rows="10" class="form-control">
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Price</label>
                    <div class="col-md-6">
                      <input type="number" name="price" id="price" placeholder=" Price of Courses" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Instructor</label>
                    <div class="col-md-6">
                      <input type="text" name="instructor" id="instructor" placeholder=" Instructor of Courses" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Duration of Courses</label>
                    <div class="col-md-6">
                      <input type="text" name="Duration" id="Duration" placeholder=" Duration of Courses" class="form-control">
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
                  <input type="hidden" name="id" id="courses_id">
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
  function showaddcourses(){
    $('#myModalLabel').html('Add Courses');
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
  function showeditcourses(element){
    var courses_info = $(element).data('courses_data');
    console.log((courses_info));
    if(typeof(courses_info) != 'object'){
      courses_info = JSON.parse('courses_info');
    }
    $('#myModalLabel').html('Edit Courses');
    $('#title').val(courses_info.title);
    ckEditor2(courses_info.summary);
    ckEditor(courses_info.detail);
    $('#price').val(courses_info.price);
    $('#instructor').val(courses_info.instructor);
    $('#Duration').val(courses_info.Duration);
    $('#status').val(courses_info.status);
    $('#image').removeAttr('required','required');
    if (courses_info.image)
      $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>courses/'+courses_info.image);
    $('#courses_id').val(courses_info.id);
    $('#old_image').val(courses_info.image);
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
  ckEditor2();

  function ckEditor(data=''){
    $('.ck').remove();
    ClassicEditor
        .create( document.querySelector('#detail'),{
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
  function ckEditor2(data=''){
    $('.ck').remove();
    ClassicEditor
        .create( document.querySelector('#summary'),{
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
</script>