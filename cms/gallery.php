<?php 
$header = "Gallery";
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
                <h3>Gallery List</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddgallery();">Add Gallery</a>
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
                    <h2>All Gallery</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $gallery = new gallery();
                          $allGallery = $gallery->getallGallery([]);
                          // debugger($allGallery);
                          // debugger($_SESSION);
                          if ($allGallery) {
                            foreach ($allGallery as $key => $gallery) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $gallery->title; ?></td>
                            <td><?php echo $gallery->type; ?></td>
                            <td><?php echo html_entity_decode($gallery->description); ?></td>
                            <td>
                              <?php if (isset($gallery->featured_image) && !empty($gallery->featured_image) && file_exists(UPLOAD_DIR.'gallery/'.$gallery->featured_image)) {
                                $thumbnail = UPLOAD_URL.'gallery/'.$gallery->featured_image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showeditgallery(this);" data-gallery_data='<?php echo json_encode($gallery); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              
                              <?php 
                                $act = substr(md5('Gallery-'.$gallery->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/gallery?id=<?php echo $gallery->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this gallery?');">
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
        <!-- /gallery content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Gallery</h4>
              </div>
              <form action="process/gallery" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <p id="edit"></p>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Title of Gallery</label>
                    <div class="col-md-6">
                      <input type="text" name="title" id="title" required="required" placeholder=" Name of Gallery" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2">Description of Gallery:</label>
                    <div class="col-md-6">
                      <textarea name="description" id="description" rows="10" class="form-control">
                      </textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="" class="col-md-2">Description of Gallery:</label>
                    <div class="col-md-6">
                      <select name="type" id="type" class="form-control">
                        <option value="">--Select the Type--</option>
                        <option value="excursion">Excursion</option>
                        <option value="event">Event</option>
                        <option value="classes">Classes</option>
                        <option value="participation">Participation</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Featured Image</label>
                    <div class="col-md-3">
                     <input type="file" accept="image/*" name="featured_image" id="featured_image" required="required" onchange="showThumbnail(this);">
                    </div>
                    <div class="col-md-2">
                      <img src="<?php echo IMAGES_PATH; ?>/no_thumbnail.png" alt="" width='400px' id="thumbnail">
                    </div>
                  </div>
                  <!-- Multiple upload -->
                   <div class="form-group row" id="related_image">
                    <label for="" class="col-md-2 col-lg-2">Related Images</label>
                    <div class="col-md-3">
                     <input type="file" accept="image/*" name="image[]" id="image" required="required" multiple="multiple">
                    </div>
                    <div class="col-md-2">
                      <img src="<?php echo IMAGES_PATH; ?>/no_thumbnail.png" alt="" width='400px' id="thumbnail">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" id="gallery_id">
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
  function showaddgallery(){
    $('#myModalLabel').html('Add Gallery');
    $('#edit').html('');
    $('#title').val('');
    ckEditor2();
    ckEditor();
    $('#type').val('');
    $('#featured_image').val('');
    $('#thumbnail').attr('src','<?php echo IMAGES_PATH; ?>/no_thumbnail.png');
    $('#related_image').removeAttr('class','hidden');
    $('#image').attr('required','required');
    showform();
  }
  function showform(){
    $('.modal').modal();
  }
  function showeditgallery(element){
    var gallery_info = $(element).data('gallery_data');
    console.log((gallery_info));
    if(typeof(gallery_info) != 'object'){
      gallery_info = JSON.parse('gallery_info');
    }
    $('#myModalLabel').html('Edit Gallery');
    $('#edit').html('Only Featured Image Can Be Changed.');
    $('#title').val(gallery_info.title);
    ckEditor(gallery_info.description);
    $('#type').val(gallery_info.type);
    $('#featured_image').removeAttr('required','required');
    if (gallery_info.featured_image)
      $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>gallery/'+gallery_info.featured_image);
    $('#image').removeAttr('required','required');
    $('#related_image').attr('class','hidden');

    $('#gallery_id').val(gallery_info.id);
    $('#old_image').val(gallery_info.featured_image);
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
        .create( document.querySelector('#description'),{
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