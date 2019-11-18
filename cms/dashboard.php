<?php 
$header = "Dashboard";
include_once 'inc/header.php'; 
include_once 'inc/checklogin.php';
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <div class="container body">
      <div class="main_container">
        <?php include 'inc/sidebar.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php flashMessage(); ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Dashboard</h3>
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
                        <?php 
                          $comments = new comment(); 
                          $allComments = $comments->getInactiveComments();
                          if($allComments){
                        ?>
                  <div class="x_title">
                    <h2>Comments and Reply</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12">
                       <table class="table table-bordered table-hover jambo_table" id="datatable">
                         <thead>
                           <th>S.N</th>
                           <th>Blog Title</th>
                           <th>Commentor</th>
                           <th>email</th>
                           <th>Comment or Reply</th>
                           <th>Action</th>
                         </thead>
                         <tbody>
                          <?php 
                            
                            foreach ($allComments as $key => $comment) {
                          ?>
                          <tr>
                              <td><?php echo $key+1; ?></td>
                              <td><?php echo $comment->posttitle;?></td>
                              <td><?php echo $comment->commentor;?></td>
                              <td><?php echo $comment->email;?></td>
                              <td><?php echo $comment->comment;?></td>
                          <?php
                              if ($comment->commentid) {
                          ?>
                              <td style="font-size: 20px;">
                              <?php 
                                $act_Del = substr(md5('Reply-Deleted'.$comment->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="dashboardprocess/replys?id=<?php echo $comment->id; ?>&amp;act=<?php echo $act_Del; ?>&amp;rep=<?php echo $comment->commentid ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this comment?');">
                                  <i class="fa fa-trash"></i>
                                </a>
                              <?php 
                                $act_published = substr(md5('Reply-Published'.$comment->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                                 <a href="dashboardprocess/replys?id=<?php echo $comment->id; ?>&amp;act=<?php echo $act_published; ?>&amp;rep=<?php echo $comment->commentid ?>" class="btn btn-primary"> Publish
                                </a>
                            </td>
                          </tr>
                          <?php
                              }else{
                          ?>
                              <td style="font-size: 20px;">
                              <?php 
                                $act = substr(md5('Comment-delete'.$comment->id.'-'.$_SESSION['token']),3,15);
                              ?> 
                              <a href="dashboardprocess/comments?id=<?php echo $comment->id; ?>&amp;act=<?php echo $act; ?>&amp;c=<?php echo $comment->postid; ?>" class="btn btn-danger" onclick="return confirm('Are You sure you want to delete this comment?');">
                                  <i class="fa fa-trash"></i>
                                </a>

                                <?php 
                                  $act = substr(md5('comment-publish'.$comment->id.'-'.$_SESSION['token']), 3,16);
                                ?>
                                <a href="dashboardprocess/comments?id=<?php echo $comment->id; ?>&amp;act=<?php echo $act; ?>&amp;c=<?php echo $comment->postid; ?>" class= "btn btn-primary">Publish</a>
                            </td>
                            </tr>
                          <?php
                              }
                            }
                          ?>
                         </tbody>
                       </table>
                        <?php
                          }
                         ?>
                      </div>
                    </div>
                  </div>
                  <div class="x_title">
                    <h2>Chart and Diagram</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-6">
                        <canvas id="linechart"></canvas>
                      </div>
                      <div class="col-md-6">
                         <canvas id="bardiagram"></canvas>
                      </div>
                    </div>
                  </div>
               
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php include_once 'inc/footer.php'; ?>
<script>
  var ctx = document.getElementById('linechart').getContext('2d');
  var chart = new Chart(ctx, {
      // The type of chart we want to create
      type: 'line',

      // The data for our dataset
      data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [{
              label: 'My First dataset',
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: 'rgb(255, 99, 132)',
              data: [0, 10, 5, 2, 20, 30, 45]
          }]
      },

      // Configuration options go here
      options: {}
  });

  var ctx = document.getElementById('bardiagram').getContext('2d');
  var chart = new Chart(ctx, {
      // The type of chart we want to create
      type: 'bar',

      // The data for our dataset
      data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [{
              label: 'My Second dataset',
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: 'rgb(255, 99, 132)',
              data: [90, 10, 5, 2, 20, 30, 45]
          }]
      },

      // Configuration options go here
      options: {}
  });
</script>
<script src="<?php echo JS_PATH; ?>datatables.min.js"></script>

