<?php 
$header = "Comment";
include_once 'inc/header.php'; 
include_once 'inc/checklogin.php';
if ($_GET) {
  if (isset($_GET['c']) && !empty($_GET['c']) && $_GET['c']>0) {
    $blog_id = $_GET['c'];
    $blog = new blog();
    $blog_info = $blog->getBlogById($blog_id);
    $blog_info = $blog_info[0];
  }else{
    setFlash('blog');
  }
}else{
  setFlash('blog');
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
                <h3>Comment List(<?php echo $blog_info->title; ?>)</h3>
              </div>
              <div class="title_right">
                <!-- <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddcomment();">Add Comment</a> -->
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
                    <h2>All Comment</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Comment By</th>
                        <th>Comment</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $comment_obj = new comment();
                          $allComment = $comment_obj->getInactiveCommentByPostId($blog_id);
                          if ($allComment) {
                            $counter = 1;
                            $main_cmmt = array();
                            foreach ($allComment as $key => $comment) {
                              if (($comment->commentid) !=0) {
                                $main_comment = $comment_obj->getCommentById($comment->commentid);
                                $reply = 1;
                                $comment = $main_comment[0];
                                if (in_array($comment->id, $main_cmmt)) {
                                  echo "Matched Found";
                                  continue;
                                }
                                array_push($main_cmmt, $comment->id);
                              }else{
                                unset($reply);
                              }
                          ?>
                          <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><?php echo $comment->commentor; ?></td>
                            <td><?php echo $comment->comment; ?></td>
                            <td style="font-size: 20px;">
                              <?php 
                                $act = substr(md5('Comment-delete'.$comment->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/comment?id=<?php echo $comment->id; ?>&amp;act=<?php echo $act; ?>&amp;c=<?php echo $blog_id; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this comment?');">
                                  <i class="fa fa-trash"></i>
                                </a>
                                <?php 
                                  if (isset($reply) && ($reply ==1)) {
                                ?>
                                
                                <a href="reply?rep=<?php echo $comment->id; ?>" class="btn btn-primary"><i class="fa fa-reply"></i></a>

                                <?php
                                  }
                                ?>
                                <?php 
                                  if (isset($reply) && ($reply ==1)) {
                                    # code...
                                  }else{
                                    $act = substr(md5('comment-publish'.$comment->id.'-'.$_SESSION['token']), 3,16);
                                ?>
                                
                                <a href="process/comment?id=<?php echo $comment->id; ?>&amp;act=<?php echo $act; ?>&amp;c=<?php echo $blog_id; ?>" class= "btn btn-primary">Publish</a>
                                <?php
                                  }
                                ?>
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
        <!-- /comment content -->

       <!--  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Comment</h4>
              </div>
              <form action="process/comment" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Title</label>
                    <div class="col-md-6">
                      <input type="text" name="title" id="title" required="required" placeholder=" Name of Comment" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2">Quote:</label>
                    <div class="col-md-6">
                      <textarea name="quote" id="quote" rows="10" class="form-control">
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Quote By</label>
                    <div class="col-md-6">
                      <input type="text" name="quoteby" id="quoteby" placeholder=" Quote By" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Post</label>
                    <div class="col-md-6">
                      <input type="text" name="bypost" id="bypost" placeholder=" Post of Speaker" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2">Description of Comment:</label>
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
                  <input type="hidden" name="id" id="comment_id">
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
  function showaddcomment(){
    $('#myModalLabel').html('Add Comment');
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
  function showeditcomment(element){
    var comment_info = $(element).data('comment_data');
    console.log((comment_info));
    if(typeof(comment_info) != 'object'){
      comment_info = JSON.parse('comment_info');
    }
    $('#myModalLabel').html('Edit Comment');
    $('#title').val(comment_info.title);
    ckEditor2(comment_info.description);
    ckEditor(comment_info.quote);
    $('#quoteby').val(comment_info.quoteby);
    $('#bypost').val(comment_info.bypost);
    $('#image').removeAttr('required','required');
    if (comment_info.image)
      $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>comment/'+comment_info.image);
    $('#comment_id').val(comment_info.id);
    $('#old_image').val(comment_info.image);
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