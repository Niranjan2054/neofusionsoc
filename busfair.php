
<?php
$header = "Enquiry";
 include 'inc/header.php'; ?>
 <script>
        window.location.hash = '#location';

 </script>
<style>
.certification-info h1 {
    font-size: 34px;
    margin-bottom: 20px;
    margin-top: 70px;
}

.certification-info p {
    max-width: 380px;
    margin: 0 0 30px;
}

.certificate-container {
    position: relative;
    z-index: 1;
}

.certificate-container .d-flex {
    display: flex;
    margin: 0;
}

.certificate-container:after {
    content: '';
    background: url(assets/images/bin.jpg) no-repeat center;
    background-size: 300px 300px;
    opacity: .1;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: -1;
}
.varified-message .slot-info {
    padding: 10px 0;
}

.varified-message .lbl {
    display: inline-block;
    width: 150px;
}
.varified-message .value {
    font-weight: bold;
}
.certificate-container .form-group .form-control {
    height: 60px;
    width: 100%;
    max-width: 500px;
}
.certificate-container .input-group {
    width: 100%;
}
.certificate-container .btn {
    -webkit-border-radius: 0 5px 5px 0;
    -moz-border-radius: 0 5px 5px 0;
    border-radius: 0 5px 5px 0;
    min-width: 120px;
}
.certificate-container .img-sad {
    width: 60px;
    margin: 0 auto 15px;
    display: block;
}
.certificate-container .alert-danger {
    color: #333;
    background: none;
    border: 1px solid crimson;
    text-align: center;
}
.certificate-container .alert-danger .alert-heading {
    color: crimson;
}
.certificate-container .alert-danger p {
    text-align: center;
    margin: 0 auto;
}

</style>
    <!--page-banner-area start-->

    <div class="page-banner-area bg-7">
        <div class="container">
            <div class="row align-items-center height-400">
                <div class="col-lg-12">
                    <div class="page-banner-text text-white text-center">
                        <h2>Verify Certificate</h2>
                        <ul class="site-breadcrumb">
                            <li><a href="index"  >Home</a> <span>></span></li>
                            <li><a href="#"<?php echo ($_GET)?' id="location"':''; ?>>Verify Certificate</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        if ($_GET && isset($_GET['id']) && !empty($_GET['id']) && $_GET['id']>0) {
            $student_id = $_GET['id'];
            $student = new student();
            $student_info = $student->getStudentById($student_id);
            // debugger($student_info);
            if ($student_info && isset($student_info[0]->certificateno) && !empty($student_info[0]->certificateno)) {
                $student_info = $student_info[0];
    ?>
    <div class="certificate-container" style="margin-top: 40px;">
        <div class="container">
            <div class="section-row row">
                <div class="col-md-3 visible-md visible-lg">
                    <img src="assets/images/certified.jpg" alt="">
                </div>
                <div class="col-md-9">
                    <div class="certification-info">
                        <h1>Online certificate verification</h1>
                        <div class="alert alert-success" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <h4 class="alert-heading">Congratulations!!</h4>
                            <p>Your certificate is verified. We wish you all the best for a successful IT career.</p>
                        </div>
                    </div>
                    <div class="varified-message">
                        <div class="slot-info">
                            <span class="lbl">Student Name:</span>
                            <span class="value"><?php echo $student_info->name; ?></span>
                        </div>
                        <div class="slot-info">
                            <span class="lbl">Certificate no:</span>
                            <span class="value"><?php echo $student_info->certificateno; ?></span>
                        </div>
                        <div class="slot-info">
                            <span class="lbl">Class completed date:</span>
                            <span class="value"><?php echo $student_info->coursecompletiontime; ?></span>
                        </div>
                        <div class="slot-info">
                            <a class="btn btn-primary" href="certificate">Back to verification link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            }else{
    ?>
    <div class="certificate-container" style="margin-top: 40px;">
        <div class="container">
            <div class="section-row row">
                <div class="col-md-3 visible-md visible-lg">
                    <img src="assets/images/certified.jpg" alt="">
                </div>
                <div class="col-md-9">
                    <div class="certification-info">
                        <h1>Online certificate verification</h1>
                    </div>
                    <div class="alert alert-danger" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <img class="img-sad" src="https://broadwayinfosys.com/assets/images/sad.svg" alt="">
                        <h4 class="alert-heading">Sorry!</h4>
                        <?php 
                            $institute = new institute();
                            $institute_info = $institute->getInstituteById(1);
                            $institute_info = $institute_info[0];
                        ?>
                        <p>Your verification code could not be found in our record. Please visit our office for further information or drop us a message at <?php echo $institute_info->gmail; ?> </p>
                    </div>
                    <div class="certification-info">
                        <p>Please enter the verification code.</p>
                    </div>
                    <div class="input-group">
                        <form method="POST" action="process/certificate" accept-charset="UTF-8" class="form-horizontal form-label-left" enctype="multipart/form-data"><input name="_token" type="hidden" value="TJYnFf14CJJd2tIBLggNoazEKrgK8KrpTDaR7pJz">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control" required="" id="code" name="input_code" placeholder="Enter Code">
                                <button type="submit" class="btn btn-primary">Verify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            }
    ?>
    <?php
        }else{
    ?>
    <div class="certificate-container" style="margin-top: 40px;">
        <div class="container">
            <div class="section-row row">
                <div class="col-md-6">
                    <div class="certification-info">
                        <h1>Check Your Bus Fair</h1>
                    </div>
                    <div class="certification-info">
                        <p>Please enter the Place.</p>
                    </div>
                    <div class="input-group">
                        <form method="POST" action="process/busfair" class="form-horizontal" width="100%">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control" required="" id="yourplace" name="yourplace"  placeholder="Enter Your Place"><br>
                                <input type="text" class="form-control" required="" id="destination" name="destination" placeholder="Enter Your Destination">
                                <button type="submit" class="btn btn-primary">Verify</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5 visible-md visible-lg">
                    <img src="assets/images/bus.gif" alt="">
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    
    <?php include 'inc/footer.php'; ?>
<script>
    $('#yourplace').keyup(function(){
        search('yourplace');
    });
    $('#destination').keyup(function(){
        search('destination');
    });
    function search(id){
        var value = $('#'+id).val();
        console.log(value);
    }
</script>