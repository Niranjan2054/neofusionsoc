<?php 
$header = "BusFair";
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
                <h3>BusFair List</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right" onclick="showaddbusfair();">Add BusFair</a>
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
                    <h2>All BusFair</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Price</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $busfair = new busfair();
                          $allBusFair = $busfair->getallBusFair([]);
                          // debugger($allBusFair);
                          // debugger($_SESSION);
                          if ($allBusFair) {
                            foreach ($allBusFair as $key => $busfair) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $busfair->yourplace; ?></td>
                            <td><?php echo $busfair->destination; ?></td>
                            <td><?php echo $busfair->fee; ?></td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary" onclick="showeditbusfair(this);" data-busfair_data='<?php echo json_encode($busfair); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              
                              <?php 
                                $act = substr(md5('BusFair-'.$busfair->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/busfair?id=<?php echo $busfair->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this busfair?');">
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
        <!-- /busfair content -->

        <div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add BusFair</h4>
              </div>
              <form action="process/busfair" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <p id="edit"></p>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">From</label>
                    <div class="col-md-6">
                      <input type="text" name="yourplace" id="yourplace" required="required" placeholder=" Name of BusFair" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">To</label>
                    <div class="col-md-6">
                      <input type="text" name="destination" id="destination" required="required" placeholder=" Name of BusFair" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">From</label>
                    <div class="col-md-6">
                      <input type="number" name="fee" id="fee" required="required" placeholder=" Name of BusFair" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" id="busfair_id">
                  <input type="hidden" name="old_image" id="old_image">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>

            </div>
          </div>
        </div>
        

        <div class="modal fade bs-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add BusFair</h4>
              </div>
              <form action="process/busfair" class="form form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <p id="edit"></p>
                  <div class="form-group row">
                    <label for="" class="col-md-2 col-lg-2">Upload File:</label>
                    <div class="col-md-6">
                      <input type="file" name="csv" id="csv" required="required">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" id="busfair_id">
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
  function showaddbusfair(){
    $('#myModalLabel').html('Add BusFair');
    $('#edit').html('');
    $('#title').val('');
    showform1();
  }
  function showform1(){
    $('#modal1').modal();
  }
  function showform(){
    $('#modal').modal();
  }
  function showeditbusfair(element){
    var busfair_info = $(element).data('busfair_data');
    console.log((busfair_info));
    if(typeof(busfair_info) != 'object'){
      busfair_info = JSON.parse('busfair_info');
    }
    $('#myModalLabel').html('Edit BusFair');
    $('#yourplace').val(busfair_info.yourplace);
    $('#destination').val(busfair_info.destination);
    $('#fee').val(busfair_info.fee);
    $('#busfair_id').val(busfair_info.id);
    $('#old_image').val(busfair_info.featured_image);
    showform();
  }
</script>

<?php 
	// $file_content = file_get_contents("E:\download\images\csvjson.json");
	// $file_content = json_decode($file_content);
	// foreach ($file_content as $key => $value) {
	// 	print_r($value);
	// }
?> 