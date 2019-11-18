<?php 
$header = "Testimonials";
include_once 'inc/header.php'; 
include_once 'inc/checklogin.php';
?>
<style>
  @media screen {
  #printSection {
      display: none;
  }
}
@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}
</style>

<?php 
  // debugger($_GET);
  if ($_GET) {
    if ($_GET['id']) {
      $str = substr(md5("detail-student-from-list".$_SESSION['token'].$_GET['id']), 3,14);
      if($str == $_GET['act']){
        $student = new student();
        $data = $student->getStudentById($_GET['id']);
        // debugger($data);
      }else{
        setFlash('student-list','error','Invalid Action');
      }
    }else{
      setFlash('student-list','error','Invalid Id or Id is empty');
    }
  }else{
    setFlash('student-list','error','Un-authorized Access');
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
                <h3>Student List</h3>
              </div>
              <!-- <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddtestimonials();">Add Testimonials</a>
              </div> -->
              <!-- Single button -->
              <div class="btn-group pull-right">
                <button type="button" class="btn btn-info dropdown-toggle" style="background: #169F85;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="javascript:;" onclick="showaddtestimonials(this);" data-user_data='<?php echo json_encode($data,true) ?>'>Add Testimonials</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="javascript:;" onclick="showaddinsuccess(this);" data-user_data='<?php echo json_encode($data,true) ?>'>Add in Success</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="javascript:;" onclick="showaddpayment(this);" data-user_data='<?php echo json_encode($data,true) ?>'>Add Payment</a></li>
                  <li role="separator" class="divider"></li>
                  <?php 
                    if ((($data[0]->price*(1-$data[0]->discount/100)) - $data[0]->paid)<1) {
                  ?>
                  <li><a href="javascript:;" onclick="showaddcertificate(this);" data-user_data='<?php echo json_encode($data,true) ?>'>Certification</a></li>
                  <?php
                    }
                  ?>

                </ul>
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
                    <h2>Student Detail</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content col-md-6 col-lg-6">
                    
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>Student Id</th>
                        <th>1</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td><span class="hidden">1</span>Name</td>
                          <td><?php echo $data[0]->name; ?></td>  
                        </tr>
                        <tr>
                          <td><span class="hidden">2</span>Image</td>
                          <td>
                            <?php if (isset($data['0']->image) && !empty($data['0']->image)) {
                                $thumbnail = UPLOAD_URL.'student/'.$data['0']->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                          </td>  
                        </tr>
                        <tr>
                          <td><span class="hidden">3</span>Status</td>
                          <td><?php echo $data[0]->status; ?></td>  
                        </tr>
                        <tr>
                          <td>Gender</td>
                          <td><?php echo $data[0]->gender; ?></td>  
                        </tr>
                        <tr>
                          <td>Date of Birth </td>
                          <td><?php echo $data[0]->dob; ?></td>  
                        </tr>
                        <tr>
                          <td>Guardian </td>
                          <td><?php echo $data[0]->guardian; ?></td>  
                        </tr>
                        <tr>
                          <td>Address</td>
                          <td><?php echo $data[0]->address; ?></td>  
                        </tr>
                        <tr>
                          <td>Contact No.</td>
                          <td><?php echo $data[0]->contact; ?></td>  
                        </tr>
                        <tr>
                          <td>Gmail</td>
                          <td><?php echo $data[0]->gmail; ?></td>  
                        </tr>
                        <tr>
                          <td>School/College</td>
                          <td><?php echo $data[0]->school; ?></td>  
                        </tr>
                        <tr>
                          <td>Qualification</td>
                          <td><?php echo $data[0]->academicLevel; ?></td>  
                        </tr>
                        <tr>
                          <td>Date of Admission</td>
                          <td><?php echo $data[0]->dateofadmission; ?></td>  
                        </tr>
                        <tr>
                          <td>Courses</td>
                          <td><?php echo $data[0]->courses; ?></td>  
                        </tr>
                        <tr>
                          <td>Time</td>
                          <td><?php echo $data[0]->time; ?></td>  
                        </tr>
                        <tr>
                          <td>Course Completion Date</td>
                          <td><?php echo $data[0]->coursecompletiontime; ?></td>  
                        </tr>
                        <tr>
                          <td>Price</td>
                          <td><?php echo $data[0]->price; ?></td>  
                        </tr>
                        <tr>
                          <td>Paid</td>
                          <td><?php echo $data[0]->paid; ?></td>  
                        </tr>
                        <tr>
                          <td>Discount</td>
                          <td><?php echo $data[0]->discount; ?></td>  
                        </tr>
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

       
  <!-- Add in SUccesss MODAL -->
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
                  <input type="hidden" name="id" id="testimonials_id" value="<?php echo $_GET['id']; ?>">
                  <input type="hidden" name="old_image" id="old_image">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>

            </div>
          </div>
        </div>

<!-- Add in Certification MODAL -->
        <div class="modal fade bs-example-modal-lg" id="modal5" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Certificate</h4>
              </div>
              <form action="process/certificate" class="form form-horizontal" method="post">
                <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Certificate Code:</label>
                    <div class="col-md-6">
                      <input type="text" name="certificateno" id="certificateno" required="required" class="form-control" placeholder=" Certificate Code">
                    </div>
                  </div>
                <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Course Completion Date:</label>
                    <div class="col-md-6">
                      <input type="date" name="coursecompletiontime" id="coursecompletiontime" required="required" class="form-control" placeholder=" Course Completion Date">
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


 <!-- Add in Add Payment MODAL -->
        <div class="modal fade bs-example-modal-lg" id="modal3" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Payment</h4>
              </div>
              <form action="process/transaction" class="form form-horizontal" method="post" id="form">
                <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Id:</label>
                    <div class="col-md-6">
                      <p class="form-control-static" id="student_id">1</p>
                    </div>
                  </div>
                  <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Name:</label>
                    <div class="col-md-6">
                      <p class="form-control-static" id="student_name">Niranjan Bekoju</p>
                    </div>
                  </div>
                  <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Course:</label>
                    <div class="col-md-6">
                      <p class="form-control-static" id="student_course">Php Web Development</p>
                    </div>
                  </div>
                  <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Total Price:</label>
                    <div class="col-md-6">
                      <p class="form-control-static" id="student_price">3999</p>
                    </div>
                  </div>
                   <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Discount Price:</label>
                    <div class="col-md-6">
                      <p class="form-control-static" id="student_discount">3999</p>
                    </div>
                  </div>
                  <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Total Paid:</label>
                    <div class="col-md-6">
                      <p class="form-control-static" id="student_paid">2000</p>
                    </div>
                  </div>
                  <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Total Remaining:</label>
                    <div class="col-md-6">
                      <p class="form-control-static" id="student_remaining">1999</p>
                    </div>
                  </div>
                <div class="form-group row">
                  <br>
                    <label for="" class="col-md-2">Paid Amount:</label>
                    <div class="col-md-6">
                      <input type="number" name="paid" id="paid" required="required" class="form-control" placeholder=" Currently Paying Amount" max="1999" min="0">
                    </div>
                  </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" id="testimonials_id" value="<?php echo $_GET['id']; ?>">
                  <input type="hidden" name="oldpaid" id="oldpaid" value="<?php echo $data[0]->paid ?>">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="billprint(this)">Save changes</button>
                </div>
              </form>

            </div>
          </div>
        </div>
 

 <!-- Add in Print Modal -->
        <div class="modal fade bs-example-modal-lg" id="modal4" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Print Bill</h4>
              </div>
              <div id="print">
                <?php 
                  $institute = new institute();
                  $institute_info = $institute->getallInstitute();
                  $institute_info = $institute_info[0];
                 ?>
                  <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                      <div class="">
                        <h3><?php echo $institute_info->Name; ?></h3>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <img src="<?php echo(UPLOAD_URL.'/institute/'.$institute_info->image) ?>" alt="" style="width: 100px; height: auto;">
                    </div>
                  </div>
                  <hr style="border-top: 2px solid #000;">
                  <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                      <h4>Bill To:</h4>
                      <h5><?php echo $data[0]->name; ?></h5>
                    </div>
                    <div style="margin-left: 400px;">
                      <h4>Invoice Date:</h4>
                      <h5><?php echo date("M d Y",time()); ?></h5>
                    </div>
                  </div>
                  <hr style="border-top: 2px solid #000;">
                  
                  <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                      <h4>Description</h4>
                    </div>
                    <div style="margin-left: 400px;">
                      <h4>Amount</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                      <h5><?php echo $data[0]->courses; ?></h5>
                    </div>
                    <div style="margin-left: 400px;">
                      <h5 class="pricevalue">3000</h5>
                    </div>
                  </div>

                  <hr style="border-top: 2px solid #000;">
                  <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                      <h5>Total</h5>
                    </div>
                    <div style="margin-left: 400px;">
                      <h5 class="pricevalue">3000</h5>
                    </div>
                  </div>
                  <br><br>
                  <hr>
                  <h5 >Tax Invoice & not Returnable</h5>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnPrint">print</button>
              </div>  
              </form>

            </div>
          </div>
        </div>

<?php include_once 'inc/footer.php'; ?>
<script src="<?php echo JS_PATH; ?>datatables.min.js"></script>
<script>
  function showaddtestimonials(element){
    var user_info = $(element).data('user_data');
    console.log(user_info);
    if (typeof(user_info) != 'object') {
      user_info = JSON.parse(user_info);
    }
    $('#myModalLabel').html('Add Testimonials');
    console.log(user_info[0].testimonials);
    if(user_info[0].testimonials != null)
      ckEditor(user_info[0].testimonials);
    else
      ckEditor();
    showform();
  }
  function showform(){
    $('#modal1').modal();
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
   function showaddinsuccess(element){
    var user_info = $(element).data('user_data');
    console.log(user_info);
    if (typeof(user_info) != 'object') {
      user_info = JSON.parse(user_info);
    }
    $('#myModalLabel').html('Add in Success Gallery');
    if (user_info[0].workat != null) {
      $('#workat').val(user_info[0].workat);
    }else{
      $('#workat').val();
    }

    showform1();
  }
   function showaddcertificate(element){
    var user_info = $(element).data('user_data');
    console.log(user_info);
    if (typeof(user_info) != 'object') {
      user_info = JSON.parse(user_info);
    }
    $('#myModalLabel').html('Add Certificate Number');
    if (user_info[0].certificateno != null) {
      $('#certificateno').val(user_info[0].certificateno);
    }else{
      $('#certificateno').val();
    }
    if (user_info[0].coursecompletiontime != null) {
      $('#coursecompletiontime').val(user_info[0].coursecompletiontime);
    }else{
      $('#coursecompletiontime').val();
    }

    showform5();
  }
  function showform1(){
    $('#modal2').modal();
  }
   function showform5(){
    $('#modal5').modal();
  }
  function showaddpayment(element){
    var user_info = $(element).data('user_data');
    console.log(user_info);
    if (typeof(user_info) != 'object') {
      user_info = JSON.parse(user_info);
    }
    $('#myModalLabel').html('Add in Success Gallery');
    console.log(user_info[0].id);
    $('#student_id').html(user_info[0].id);
    $('#student_name').html(user_info[0].name);
    $('#student_course').html(user_info[0].courses);
    $('#student_price').html(user_info[0].price);
    var discountamt = user_info[0].price*user_info[0].discount/100;
    $('#student_discount').html(discountamt);
    console.log(user_info[0].paid);
    if (user_info[0].paid == null) {
      $('#student_paid').html('0');
    }else{
      $('#student_paid').html(user_info[0].paid);
    }
    var Remaining = user_info[0].price - user_info[0].paid - discountamt;
    $('#student_remaining').html(Remaining);
    $('#paid').attr('max',Remaining);

    showform2();
  }
  function showform2(){
    $('#modal3').modal();
  }
  function billprint(element){
    var user_info = $(element).data('user_data');
    var data = $('#paid').val();
    console.log(data);
    $('.pricevalue').html(data);
    showform3();
  }
  function showform3(){
    $('#modal4').modal();
  }

document.getElementById("btnPrint").onclick = function () {
    printElement(document.getElementById("print"));
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }
    
    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
    submitform();
}
function submitform(){
  $('#form').submit();
}
</script>