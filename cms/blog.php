<?php 
$header = "Blog";
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
                <h3>Blog List</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddblog();">Add Blog</a>
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
                    <h2>All Blog</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $blog = new blog();
                          $allBlog = $blog->getallBlog([]);
                          // debugger($allBlog);
                          // debugger($_SESSION);
                          if ($allBlog) {
                            foreach ($allBlog as $key => $blog) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $blog->title; ?></td>
                            <td><?php echo html_entity_decode($blog->description); ?></td>
                            <td>
                              <?php if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_DIR.'blog/'.$blog->image)) {
                                $thumbnail = UPLOAD_URL.'blog/'.$blog->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showeditblog(this);" data-blog_data='<?php echo json_encode($blog); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              
                              <?php 
                                $act = substr(md5('Blog-'.$blog->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/blog?id=<?php echo $blog->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this blog?');">
                                  <i class="fa fa-trash"></i>
                                </a>
                                
                                <?php 
                                  $comments = new comment();
                                  $comments = $comments->getInactiveCommentByPostId($blog->id);
                                  $count = count($comments);
                                ?>
                                <a href="comment?c=<?php echo $blog->id; ?>" class="btn btn-primary"><?php echo ($count >0)?$count:''; ?><i class="fa fa-comment"></i></a>
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
        <!-- /blog content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Blog</h4>
              </div>
              <form action="process/blog" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Title</label>
                    <div class="col-md-6">
                      <input type="text" name="title" id="title" required="required" placeholder=" Name of Blog" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2">Description of Blog:</label>
                    <div class="col-md-6">
                      <textarea name="description" id="description" rows="10" class="form-control">
                      </textarea>
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
                  <input type="hidden" name="id" id="blog_id">
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
  function showaddblog(){
    $('#myModalLabel').html('Add Blog');
    $('#title').val('');
    ckEditor2();
    ckEditor();
    $('#description').val('');
    $('#quote').val('');
    $('#quoteby').val('');
    $('#bypost').val('');
    $('#thumbnail').attr('src','<?php echo IMAGES_PATH; ?>/no_thumbnail.png');
    showform();
  }
  function showform(){
    $('.modal').modal();
  }
  function showeditblog(element){
    var blog_info = $(element).data('blog_data');
    console.log((blog_info));
    if(typeof(blog_info) != 'object'){
      blog_info = JSON.parse('blog_info');
    }
    $('#myModalLabel').html('Edit Blog');
    $('#title').val(blog_info.title);
    ckEditor2(blog_info.description);
    ckEditor(blog_info.quote);
    $('#quoteby').val(blog_info.quoteby);
    $('#bypost').val(blog_info.bypost);
    $('#image').removeAttr('required','required');
    if (blog_info.image)
      $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>blog/'+blog_info.image);
    $('#blog_id').val(blog_info.id);
    $('#old_image').val(blog_info.image);
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
        .create( document.querySelector('#quote'),{
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
</script>