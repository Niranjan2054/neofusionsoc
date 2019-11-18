<?php 
$header = "Student";
include_once 'inc/header.php'; 
include_once 'inc/checklogin.php';
if ($_GET) {
  if (isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
    $student_id = (int)$_GET['id'];
    if ($student_id) {
      if (isset($_GET['act']) && !empty($_GET['act'])) {
        if ($_GET['act'] == substr(md5("Edit-student-from-list".$_SESSION['token'].$student_id), 3,14)) {
          $student_obj = new student();
          $student_info = $student_obj->getStudentById($student_id);
          $student_info = $student_info[0];
        }else{
          setFlash('student-list','error','Action not Supported');
        }
      }else{
        setFlash('student-list','error','Action not Specified');
      }
    }else{
      setFlash('student-list','error','Invalid Student Id');
    }
  }else if(isset($_GET['s']) && !empty($_GET['s']) && $_GET['s']>0){
    $enquiry_id = $_GET['s'];
    $enquiry = new enquiry();
    $enquiry_info = $enquiry->getEnquiryById($enquiry_id);
    $enquiry_info = $enquiry_info[0];
  }else{
    setFlash('student-list','error','Invalid Access');
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
                    <h2> Admit Student</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form action="process/student" method="post" enctype="multipart/form-data" class="form form-horizontal">
                        <div class="form-group row">
                          <label for="" class="col-md-2">Name:</label>
                          <div class="col-md-6">
                            <input type="text" name="name" id="name" class="form-control" placeholder=" Student Name" value="<?php echo (isset($student_info->name) && !empty($student_info->name))?$student_info->name:(((isset($enquiry_info->name) && !empty($enquiry_info->name)))?$enquiry_info->name:'') ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">Gender:</label>
                          <div class="col-md-6">
                            <select name="gender" id="gender" class="form-control">
                              <option value="" selected="" disabled="">--Select Gender--</option>
                              <option value="Male" <?php echo (isset($student_info->gender) && !empty($student_info->gender) && $student_info->gender=='Male')?'selected':''; ?>>Male</option>
                              <option value="Female" <?php echo (isset($student_info->gender) && !empty($student_info->gender) && $student_info->gender=='Female')?'selected':''; ?>>Female</option>
                              <option value="Other" <?php echo (isset($student_info->gender) && !empty($student_info->gender) && $student_info->gender=='Other')?'selected':''; ?>>Other</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">Date of Birth:</label>
                          <div class="col-md-6">
                            <input type="date" name="dob" id="dob" class="form-control" placeholder=" Student Name" value="<?php echo (isset($student_info->dob) && !empty($student_info->dob))?$student_info->dob:''?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">Guardian:</label>
                          <div class="col-md-6">
                            <input type="text" name="guardian" id="guardian" class="form-control" placeholder=" Student Guardian" value="<?php echo (isset($student_info->guardian) && !empty($student_info->guardian))?$student_info->guardian:''?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">Address:</label>
                          <div class="col-md-6">
                            <input type="text" name="address" id="address" class="form-control" placeholder=" Student Address" value="<?php echo (isset($student_info->address) && !empty($student_info->address))?$student_info->address:''?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">Contact:</label>
                          <div class="col-md-6">
                            <input type="text" name="contact" id="contact" class="form-control" placeholder=" Student Contact" value="<?php echo (isset($student_info->contact) && !empty($student_info->contact))?$student_info->contact:(((isset($enquiry_info->contact) && !empty($enquiry_info->contact)))?$enquiry_info->contact:'') ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">Gmail:</label>
                          <div class="col-md-6">
                            <input type="email" name="gmail" id="gmail" class="form-control" placeholder=" Student Gmail" value="<?php echo (isset($student_info->gmail) && !empty($student_info->gmail))?$student_info->gmail:(((isset($enquiry_info->email) && !empty($enquiry_info->email)))?$enquiry_info->email:'') ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">School/College:</label>
                          <div class="col-md-6">
                            <input type="text" name="school" id="school" class="form-control" placeholder=" School/College" value="<?php echo (isset($student_info->school) && !empty($student_info->school))?$student_info->school:''?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">Qualification:</label>
                          <div class="col-md-6">
                            <input type="text" name="academiclevel" id="academiclevel" class="form-control" placeholder=" Student Qualification" value="<?php echo (isset($student_info->academicLevel) && !empty($student_info->academicLevel))?$student_info->academicLevel:''?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">Courses:</label>
                          <div class="col-md-6">
                            <select name="courses" id="courses" class="form-control">
                              <option value="" disabled="" selected="">--Select Any One--</option>
                              <?php 
                                $courses = new courses();
                                $course = $courses->getallCourses();
                                if ($course) {
                                  foreach ($course as $key => $cours) {
                                ?>
                                <option value="<?php echo $cours->id; ?>" 
                                  <?php 
                                    if (isset($student_info->courses) && !empty($student_info->courses)  && $cours->title == $student_info->courses) {
                                      echo "selected";
                                    } else if (isset($enquiry_info->courses) && !empty($enquiry_info->courses)  && $cours->title == $enquiry_info->courses) {
                                      echo "selected";
                                    }
                                  ?> ><?php echo $cours->title; ?></option>
                                <?php
                                  }
                                }

                               ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">Time:</label>
                          <div class="col-md-6">
                            <select name="time" id="time" class="form-control">
                              <option value="0" disabled="" selected="">--Select your Best Time--</option>
                              <option value="6 am to 7 am" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='6 am to 7 am')?'selected':''; ?>>6 am to 7 am</option>
                              <option value="7 am to 8 am" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='7 am to 8 am')?'selected':''; ?>>7 am to 8 am</option>
                              <option value="8 am to 9 am" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='8 am to 9 am')?'selected':''; ?>>8 am to 9 am</option>
                              <option value="9 am to 10 am" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='9 am to 10 am')?'selected':''; ?>>9 am to 10 am</option>
                              <option value="10 am to 11 am" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='10 am to 11 am')?'selected':''; ?>>10 am to 11 am</option>
                              <option value="11 am to 12 pm" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='11 am to 12 pm')?'selected':''; ?>>11 am to 12 pm</option>
                              <option value="12 pm to 1 pm" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='12 pm to 1 pm')?'selected':''; ?>>12 pm to 1 pm</option>
                              <option value="1 pm to 2 pm" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='1 pm to 2 pm')?'selected':''; ?>>1 pm to 2 pm</option>
                              <option value="2 pm to 3 pm" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='2 pm to 3 pm')?'selected':''; ?>>2 pm to 3 pm</option>
                              <option value="3 pm to 4 pm" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='3 pm to 4 pm')?'selected':''; ?>>3 pm to 4 pm</option>
                              <option value="4 pm to 5 pm" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='4 pm to 5 pm')?'selected':''; ?>>4 pm to 5 pm</option>
                              <option value="5 pm to 6 pm" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='5 pm to 6 pm')?'selected':''; ?>>5 pm to 6 pm</option>
                              <option value="6 pm to 7 pm" <?php echo (isset($student_info->time) && !empty($student_info->time) && $student_info->time=='6 pm to 7 pm')?'selected':''; ?>>6 pm to 7 pm</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">Discout ( % ):</label>
                          <div class="col-md-6">
                            <input type="number" name="discount" id="discount" class="form-control" value="<?php echo $student_info->discount; ?>" placeholder=" Student Discout (in %)" max="99">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2">Status:</label>
                          <div class="col-md-6">
                            <select name="status" id="status" class="form-control">
                              <option value="Active" <?php echo (isset($student_info->status) && !empty($student_info->status) && $student_info->status=='Active')?'selected':''; ?>>Active</option>
                              <option value="Inactive" <?php echo (isset($student_info->status) && !empty($student_info->status) && $student_info->status=='Inactive')?'selected':''; ?>>Inactive</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2 col-lg-2">Image</label>
                          <div class="col-md-3">
                           <input type="file" accept="image/*" name="image" id="image" onchange="showThumbnail(this);">
                          </div>
                          <div class="col-md-2">
                            <img src="<?php echo (isset($student_info->image) && !empty($student_info->image))?UPLOAD_URL.'student/'.$student_info->image:'IMAGES_PATH; ?>/no_thumbnail.png' ?>" alt="" width='400px' id="thumbnail">
                          </div>
                        </div>
                        <div class="form-group row">
                           <input type="number" class="hidden" name="id" id="id" value="<?php echo($student_id) ?>">
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2"></label>
                          <div class="col-md-6">
                            <button type="reset" class="btn btn-danger"> Reset</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
                          </div>
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
  // $('#category').on('change',function(){
  //   var category_id = $('#category').val();
  //   $.ajax({
  //     url: 'process/api',
  //     method: 'post',
  //     data: {
  //       cat_id: category_id,
  //       act: "<?php echo substr(md5('get-child-cat-by-parent-id'.$_SESSION['token']), 3,18); ?>"
  //     }
  //   })
  //   .done(function(data){
  //     if (typeof(data) != 'object') {
  //       data = $.parseJSON(data);
  //     }
  //     var inner_html = "<option selected disabled>--Select Any One--</option>"
  //     if (data.status) {
  //       //show child cat
  //       $("#sub_cat_div").removeClass('hidden');
  //       $.each(data.body,function(index,value){
  //         inner_html += "<option value ='"+value.id+"'>"+value.title+"</option>"
  //       });
  //       console.log(inner_html);
  //       $('#sub_category').html(inner_html);
  //     }else{
  //       //hidden child cat
  //       $("#sub_cat_div").addClass('hidden');
  //     }
  //   });
  // });
  // ckEditor();
  // ckEditor2();

  // function ckEditor(data=''){
  //   $('.ck').remove();
  //   ClassicEditor
  //       .create( document.querySelector('#description'),{
  //         ckfinder:{
  //           uploadUrl: '<?php echo CKFINDER_PATH; ?>core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
  //         }
  //       } )
  //       .then(editor=>{
  //         //editor.setData(data);
  //       })
  //       .catch( error => {
  //           console.error( error );
  //       } );
  // }
  // function ckEditor2(data=''){
  //   $('.ck').remove();
  //   ClassicEditor
  //       .create( document.querySelector('#meta_keywords'),{
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