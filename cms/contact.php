<?php 
$header = "Contact";
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
                <h3>Contact Info</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right hidden" onclick="showaddcontact();">Add Contact</a>
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
                    <h2>All Contact</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact no.</th>
                        <th>Website</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $contact = new contact();
                          $allContact = $contact->getallContact([]);
                          // debugger($allContact);
                          // debugger($_SESSION);
                          if ($allContact) {
                            foreach ($allContact as $key => $contact) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $contact->name; ?></td>
                            <td><?php echo $contact->email; ?></td>
                            <td><?php echo $contact->contact; ?></td>
                            <td><?php echo $contact->web; ?></td>
                            <td><?php echo $contact->subject; ?></td>
                            <td><?php echo $contact->message; ?></td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary hidden" onclick="showeditcontact(this);" data-contact_data='<?php echo json_encode($contact); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              <?php 
                                $act = substr(md5('Contact-'.$contact->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/contact?id=<?php echo $contact->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this contact?');">
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
        <!-- /contact content -->
<!-- 
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Contact</h4>
              </div>
              <form action="process/contact" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Name of Contact</label>
                    <div class="col-md-6">
                      <input type="text" name="title" id="title" required="required" placeholder=" Name of Contact" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2">Summary of Contact:</label>
                    <div class="col-md-6">
                      <textarea name="summary" id="summary" rows="5" class="form-control">
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2">Description of Contact:</label>
                    <div class="col-md-6">
                      <textarea name="detail" id="detail" rows="10" class="form-control">
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Price</label>
                    <div class="col-md-6">
                      <input type="number" name="price" id="price" placeholder=" Price of Contact" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Instructor</label>
                    <div class="col-md-6">
                      <input type="text" name="instructor" id="instructor" placeholder=" Instructor of Contact" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Duration of Contact</label>
                    <div class="col-md-6">
                      <input type="text" name="Duration" id="Duration" placeholder=" Duration of Contact" class="form-control">
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
                  <input type="hidden" name="id" id="contact_id">
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
  function showaddcontact(){
    $('#myModalLabel').html('Add Contact');
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
  function showeditcontact(element){
    var contact_info = $(element).data('contact_data');
    console.log((contact_info));
    if(typeof(contact_info) != 'object'){
      contact_info = JSON.parse('contact_info');
    }
    $('#myModalLabel').html('Edit Contact');
    $('#title').val(contact_info.title);
    ckEditor2(contact_info.summary);
    ckEditor(contact_info.detail);
    $('#price').val(contact_info.price);
    $('#instructor').val(contact_info.instructor);
    $('#Duration').val(contact_info.Duration);
    $('#status').val(contact_info.status);
    $('#image').removeAttr('required','required');
    if (contact_info.image)
      $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>contact/'+contact_info.image);
    $('#contact_id').val(contact_info.id);
    $('#old_image').val(contact_info.image);
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