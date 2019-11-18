<?php 
$header = "Dashboard";
include_once 'inc/header.php'; 
include_once 'inc/checklogin.php';
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<link rel="stylesheet" href="<?php echo CSS_PATH; ?>dropzone.min.css">

    <div class="container body">
      <div class="main_container">
        <?php include 'inc/sidebar.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php flashMessage(); ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Project</h3>
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
                    <h2>Add Project</h2>
                    <div class="clearfix"></div>
                  </div>
                   <!-- Smart Wizard -->
                  <div class="x_content">
                    <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Step 1<br />
                                              <small>Step 1 Student Info.</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Step 2<br />
                                              <small>Step 2 Student Detail</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Step 3<br />
                                              <small>Step 3 Tool Used</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Step 4<br />
                                              <small>Step 4 Image</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                      <div id="step-1">
                        <h2 class="StepTitle">Step 1 Search Student</h2>
                        <form class="form-horizontal form-label-left" style="overflow: hidden;">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Student Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" name="email" id="email" required="required" class="form-control col-md-7 col-xs-12" onchange="checkstudent()">
                            </div>
                          </div>
                        </form>
                      </div>
                      <div id="step-2">
                        <h2 class="StepTitle">Step 2 Student Detail</h2>
                        <table>
                          <tbody>
                            <tr>
                              <td>Name</td>
                              <td id="detailname"></td>
                            </tr>
                            <tr>
                              <td>Contact</td>
                              <td id="detailContact"></td>
                            </tr>
                            <tr>
                              <td>Email</td>
                              <td id="detailemail"></td>
                            </tr>
                            <tr>
                              <td>Address</td>
                              <td id="detailaddress"></td>
                            </tr>
                            <tr>
                              <td>Image</td>
                              <td id=""><img src="" id="detailimage" class="hidden" style="width: 400px;height: auto;"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div id="step-3">
                        <h2 class="StepTitle">Step 3 Tools Used</h2>
                        <div class="control-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input id="tags_1" type="text" class="tags form-control" value="Photoshop, Illustrator" />
                          <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                        </div>
                      </div>
                      </div>
                      <div id="step-4">
                        <h2 class="StepTitle">Step 4 Content</h2>
                        <form action="/file-upload" class="dropzone" enctype="multiple/form-data">
                          <div class="fallback">
                            <input name="file" type="file" multiple />
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- End SmartWizard Content -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php include_once 'inc/footer.php'; ?>

<script src="<?php echo JS_PATH; ?>datatables.min.js"></script>
<script src="<?php echo JS_PATH; ?>wizard.js"></script>
<script src="<?php echo JS_PATH; ?>dropzone.min.js"></script>
<script src="<?php echo JS_PATH; ?>tags.js"></script>

<script>
  function checkstudent() {
    var gmail = $('#email').val();
    console.log('<?php echo substr((md5('Search-Student-Using-Email'.$_SESSION['token'].'email')), 3,15) ?>');
    $.ajax({
      url:'process/api',
      method:'post',
      data:{
        act: '<?php echo substr((md5('Search-Student-Using-Email'.$_SESSION['token'].'email')), 3,15) ?>',
        email:gmail
      }
    })
    .done(function(ret){
      // console.log(ret)
      if(typeof(ret) != 'object'){
        ret = $.parseJSON(ret);
      }
      ret = ret.body[0]
      $('#detailname').html(ret['name']);
      $('#detailContact').html(ret['contact']);
      $('#detailemail').html(ret['gmail']);
      $('#detailaddress').html(ret['image']);
      $('#detailimage').attr({'src':'<?php echo UPLOAD_URL."student/"; ?>'+ret['image']});
      $('#detailimage').removeClass('hidden');
    });
  }
</script>