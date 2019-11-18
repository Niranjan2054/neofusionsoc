<?php 
$header = "Enquiry";
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
                <h3>Enquiry List</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right hidden" onclick="showaddenquiry();">Add Enquiry</a>
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
                    <h2>All Enquiry</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact no.</th>
                        <th>Courses</th>
                        <th>Message</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $enquiry = new enquiry();
                          $allEnquiry = $enquiry->getallEnquiry([]);
                          // debugger($allEnquiry);
                          // debugger($_SESSION);
                          if ($allEnquiry) {
                            foreach ($allEnquiry as $key => $enquiry) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $enquiry->name; ?></td>
                            <td><?php echo $enquiry->email; ?></td>
                            <td><?php echo $enquiry->contact; ?></td>
                            <td><?php echo $enquiry->courses; ?></td>
                            <td><?php echo $enquiry->message; ?></td>
                            <td style="font-size: 20px;">
                              <a href="student?s=<?php echo $enquiry->id ?>" class="btn btn-primary" data-enquiry_data='<?php echo json_encode($enquiry); ?>'>
                                Admission
                              </a> 
                              <?php 
                                $act = substr(md5('Enquiry-'.$enquiry->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/enquiry?id=<?php echo $enquiry->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this enquiry?');">
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
        <!-- /enquiry content -->
<!-- 
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Enquiry</h4>
              </div>
              <form action="process/enquiry" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Name of Enquiry</label>
                    <div class="col-md-6">
                      <input type="text" name="title" id="title" required="required" placeholder=" Name of Enquiry" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2">Summary of Enquiry:</label>
                    <div class="col-md-6">
                      <textarea name="summary" id="summary" rows="5" class="form-control">
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2">Description of Enquiry:</label>
                    <div class="col-md-6">
                      <textarea name="detail" id="detail" rows="10" class="form-control">
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Price</label>
                    <div class="col-md-6">
                      <input type="number" name="price" id="price" placeholder=" Price of Enquiry" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Instructor</label>
                    <div class="col-md-6">
                      <input type="text" name="instructor" id="instructor" placeholder=" Instructor of Enquiry" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Duration of Enquiry</label>
                    <div class="col-md-6">
                      <input type="text" name="Duration" id="Duration" placeholder=" Duration of Enquiry" class="form-control">
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
                  <input type="hidden" name="id" id="enquiry_id">
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
<!-- <script>
  function showaddenquiry(){
    $('#myModalLabel').html('Add Enquiry');
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
  function showeditenquiry(element){
    var enquiry_info = $(element).data('enquiry_data');
    console.log((enquiry_info));
    if(typeof(enquiry_info) != 'object'){
      enquiry_info = JSON.parse('enquiry_info');
    }
    $('#myModalLabel').html('Edit Enquiry');
    $('#title').val(enquiry_info.title);
    ckEditor2(enquiry_info.summary);
    ckEditor(enquiry_info.detail);
    $('#price').val(enquiry_info.price);
    $('#instructor').val(enquiry_info.instructor);
    $('#Duration').val(enquiry_info.Duration);
    $('#status').val(enquiry_info.status);
    $('#image').removeAttr('required','required');
    if (enquiry_info.image)
      $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>enquiry/'+enquiry_info.image);
    $('#enquiry_id').val(enquiry_info.id);
    $('#old_image').val(enquiry_info.image);
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
</script> -->