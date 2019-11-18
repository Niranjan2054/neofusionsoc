<?php 
$header = "Category";
include_once 'inc/header.php'; 
include_once 'inc/checklogin.php';
?>
<style>
  .ck-editor__editable 
  {
  min-height: 200px;
}
</style>
    <div class="container body">
      <div class="main_container">
        <?php include 'inc/sidebar.php'; ?>

        <!-- category content -->
        <div class="right_col" role="main">
          <div class="">
            <?php flashMessage(); ?>
            <div class="category-title">
              <div class="title_left">
                <h3>Category List</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddcategory();">Add Category</a>
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
                    <h2>All Category</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>summary</th>
                        <th>show_in_menu</th>
                        <th>is_parent</th>
                        <th>parent_id</th>
                        <th>Status</th>
                        <th>Thumbnail</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $category = new category();
                          $allCategory = $category->getallCategory([]);
                          // debugger($allCategory);
                          // debugger($_SESSION);
                          if ($allCategory) {
                            foreach ($allCategory as $key => $category) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $category->title; ?></td>
                            <td><?php echo $category->summary; ?></td>
                            <td><?php echo (isset($category->show_in_menu) && !empty($category->show_in_menu))?'Yes':'No'; ?></td>
                            <td><?php echo (isset($category->is_parent) && !empty($category->is_parent))?'Yes':'No'; ?></td>
                            <td><?php echo (isset($category->parent_cat) && !empty($category->parent_cat))?$category->parent_cat:"Self Parent"; ?></td>
                            <td><?php echo $category->status; ?></td>
                            <td>
                              <?php if (isset($category->image) && !empty($category->image) && file_exists(UPLOAD_DIR.'category/'.$category->image)) {
                                $thumbnail = UPLOAD_URL.'category/'.$category->image;
                              }else{
                                $thumbnail = IMAGES_PATH.'no_thumbnail.png';
                              } ?>
                              <img src="<?php echo $thumbnail; ?>" alt="" style="max-width: 150px" class="image-thumbnail">
                            </td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showeditcategory(this);" data-category_data='<?php echo json_encode($category,true); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              
                              <?php 
                                $act = substr(md5('Category-'.$category->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/category?id=<?php echo $category->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this category?');">
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
        <!-- /category content -->

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Category</h4>
              </div>
              <form action="process/category" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Title</label>
                    <div class="col-md-8">
                      <input type="text" name="title" id="title" required="required" placeholder=" Category Title" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Summary</label>
                    <div class="col-md-8">
                      <input type="text" name="summary" id="summary" placeholder=" Category summary" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Show in Menu</label>
                    <div class="col-md-8">
                      <input type="checkbox" name="show_in_menu" id="show_in_menu" value="1">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Is Parent</label>
                    <div class="col-md-8">
                      <input type="checkbox" name="is_parent" id="is_parent" value="1" checked="checked">
                    </div>
                  </div>
                  <div class="form-group row hidden" id="parent_cat_div">
                    <label for="" class="col-md-2 col-lg-2">Parent Category</label>
                    <div class="col-md-8">
                      <select name="parent_cat_id" id="parent_cat_id" class="form-control">
                        <option value="" disabled selected="">--Choose the parent Category--</option>
                        <?php 
                          $category = new category();
                          $parent_category = $category->getparentcategory();
                          if ($parent_category) {
                            foreach ($parent_category as $key => $parent) {
                          ?>
                            <option value="<?php echo $parent->id; ?>"><?php echo $parent->title; ?></option>
                          <?php
                            }
                          }
                         ?>
                      </select>
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
                  <input type="hidden" name="id" id="category_id">
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
<script>
  function showaddcategory(){
    $('#myModalLabel').html('Add Category');
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
  function showeditcategory(element){
    var category_info = $(element).data('category_data');
    if(typeof(category_info) != 'object'){
      category_info = JSON.parse('category_info');
    }
    $('#myModalLabel').html('Edit Category');
    $('#title').val(category_info.title);
    $('#summary').val(category_info.summary);
    $('#status').val(category_info.status);
    $('#image').removeAttr('required','required');
    if (category_info.image)
      $('#thumbnail').attr('src','<?php echo UPLOAD_URL; ?>category/'+category_info.image);
    $('#category_id').val(category_info.id);
    $('#old_image').val(category_info.image);
    showform(category_info.description);
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
  function ckEditor(data){
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
  $('body').on('click','#is_parent',function(){
    var check_info = $('#is_parent').prop('checked');
    console.log(check_info);
    if(!check_info) {
      $('#parent_cat_div').removeClass('hidden');
      $.ajax({
        url: 'process/api',
        method: 'post',
        data: {

        }
      });
    }else{
      $('#parent_cat_div').addClass('hidden');
    }
  });
</script>

