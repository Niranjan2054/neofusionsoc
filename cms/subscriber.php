<?php 
$header = "Subscriber";
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
                <h3>Subscriber Info</h3>
              </div>
              <div class="title_right">
                <a href="javascript:;" class="btn btn-success pull-right hidden" onclick="showaddsubscriber();">Add Subscriber</a>
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
                    <h2>All Subscriber</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-bordered table-hover jambo_table">
                      <thead>
                        <th>S.N</th>
                        <th>Email</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $subscriber = new subscriber();
                          $allSubscriber = $subscriber->getallSubscriber([]);
                          // debugger($allSubscriber);
                          // debugger($_SESSION);
                          if ($allSubscriber) {
                            foreach ($allSubscriber as $key => $subscriber) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $subscriber->email; ?></td>
                            <td style="font-size: 20px;">
                              <a href="javascript:;" class="btn btn-primary hidden" onclick="showeditsubscriber(this);" data-subscriber_data='<?php echo json_encode($subscriber); ?>'>
                                <i class="fa fa-pencil"></i>
                              </a> 
                              <?php 
                                $act = substr(md5('Subscriber-'.$subscriber->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="process/subscriber?id=<?php echo $subscriber->id; ?>&amp;act=<?php echo $act; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this subscriber?');">
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
<?php include_once 'inc/footer.php'; ?>
<script src="<?php echo JS_PATH; ?>datatables.min.js"></script>
