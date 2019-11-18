<?php 
$header = "Page";
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
                <h3>Page List</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddpage();">Add Page</a>
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
                    <h2>All Page</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>summary</th>
                        <th>Status</th>
                        <th>Thumbnail</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $page = new page();
                          $allPage = $page->getallPage([]);
                          // debugger($allPage);
                          // debugger($_SESSION);
                          if ($allPage) {
                            foreach ($allPage as $key => $page) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $page->title; ?></td>
                            <td><?php echo $page->summary; ?></td>
                            <td><?php echo $page->status; ?></td>
                            <td>
                              <?php if (isset($page->image) && !empty($page->image) && file_exists(UPLOAD_DIR.'page/'.$page->image)) {
                                $thumbnail = UPLOAD_URL.'page/'.$page->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showeditpage(this);" data-page_data='<?php echo ($page->id); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> &nbsp;
                              <a href="process/page?id=<?php echo $page->id; ?>&amp;act=<?php echo substr(md5("Page-".$page->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
        <!-- /page content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Page</h4>
              </div>
              <form action="process/page" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Title</label>
                    <div class="col-md-8">
                      <input type="text" name="title" id="title" required="required" placeholder=" Page Title" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Summary</label>
                    <div class="col-md-8">
                      <input type="text" name="summary" id="summary" placeholder=" Page summary" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Description</label>
                    <div class="col-md-8">
                      <textarea name="description" id="description" rows="15"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Status</label>
                    <div class="col-md-8">
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
                  <input type="hidden" name="id" id="page_id">
                  <input type="hidden" name="old_image" id="old_image">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>

<?php include_once 'inc/footer.php'; ?>
<script src="<?php echo CKEDITOR_PATH; ?>ckeditor.js"></script>
<script src="<?php echo JS_PATH; ?>datatables.min.js"></script>
<script type="text/javascript">
  function showaddpage(){
    $('#myModalLabel').html('Add Page');
    $('#title').val('');
    $('#summary').val('');
    $('#status').val('Active');
    $('#thumbnail').attr('src','<?php echo IMAGES_PATH; ?>/no_thumbnail.png');
    showform();
  }
  function showform(data = ''){
    console.log(data);
    $('.modal').modal();
    ckEditor(data);
  }
  function showeditpage(element){
    var page_id = $(element).data('page_data');
    $.ajax({
      url: 'process/api',
      method: 'post',
      data: {
        pid: page_id,
        act: '<?php echo substr(md5("get-page-id".$_SESSION['token']),3,20); ?>'
      }
    })
    .done(function(page_info){
      console.log(page_info);
      if(typeof(page_info) != 'object'){
        page_info = $.parseJSON(page_info);
      }
      page_info = page_info.body[0];
      $('#myModalLabel').html('Edit Page');
      $('#title').val(page_info.title);
      $('#summary').val(page_info.summary);
      $('#status').val(page_info.status);
      $('#image').removeAttr('required','required');
      if (page_info.image)
        $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>page/'+page_info.image);
      $('#page_id').val(page_info.id);
      $('#old_image').val(page_info.image);
      showform(page_info.description);
    })
    .fail(function(data){

    });
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
        var editor = CKEDITOR.replace( 'editor1', { readOnly: true } );

      editor.on( 'description', function() {
          var editable = editor.editable();
          editable.attachListener( editable, 'click', function( evt ) {
              var link = new CKEDITOR.dom.elementPath( evt.data.getTarget(), this ).contains( 'a' );
              if ( link && evt.data.$.button != 2 && link.isReadOnly() ) {
                  window.open( link.getAttribute( 'href' ) );
              }
          }, null, null, 15 );
      } );
  }

</script>

