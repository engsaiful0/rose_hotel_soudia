<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->
<head>
    <meta charset="UTF-8">
    <?php
    $banner = $this->db->where('banner_id', '1')->get('company')->row();
    $title = $this->db->where('banner_id', '1')->get('company')->row();
    ?>
    <title><?php echo $banner->title ?></title>
    <link rel="icon"  type="image/x-icon" href="<?php echo base_url() ?>assets/uploads/banner/<?php echo $title->favicon ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/flags-icon/css/flag-icon.min.css">
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet"  href="<?php echo base_url(); ?>dist/vendors/chartjs/Chart.min.css">
    <!-- END: Page CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/weather-icons/css/pe-icon-set-weather.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/main.css">
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->
<body id="main-container" class="default  bg-primary">
<div class="row">
    <div class="col-md-12">
        <div id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="10000">
            <?php
            if ($this->session->userdata('message') != '') {
                ?>
                <p class="alert alert-success alert-auto-hide dism " style="text-align: center">  <a href="#" class="close" style="text-decoration:none" data-dismiss="alert" aria-label="close">&times;</a> <strong>Failed!</strong>User name or password is incorrect.Please try again.</p>
                <?php
                $sdata['message'] = '';
                $this->session->set_userdata($sdata);
            }
            ?>
        </div>
    </div>
</div>
<?php
$banner = $this->db->where('banner_id', '1')->get('company')->row();
$title = $this->db->where('banner_id', '1')->get('company')->row();
?>
<!-- START: Main Content-->
<div class="container">
    <div class="row vh-100 justify-content-between align-items-center">
        <div class="col-12">

            <form method="post" action="<?php echo base_url() ?>login-function" class="row row-eq-height lockscreen  mt-5 mb-5">
                <div class="lock-image col-12 col-sm-12 bg-primary">
                    <h3 style="text-align: center;color: white">Sign In</h3>
                </div>
                <div class="lock-image col-12 col-sm-5">
                    <img alt="<?php echo $banner->title ?>" style=" width: 100%;height:100%"
                         src="<?php echo base_url() ?>assets/uploads/banner/<?php echo $banner->logo ?>">
                </div>
                <div class="login-form col-12 col-sm-7">
                    <div class="form-group mb-3">
                        <label for="emailaddress">Email address</label>
                        <input class="form-control" value="" name="user_name" required="" placeholder="Enter User Name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input class="form-control" value=""type="password" name="password" placeholder="Enter your password">
                    </div>

                    <div class="form-group mb-0">
                        <button class="btn btn-primary" type="submit"> Sign In </button>
                    </div>
                    </div>
            </form>
        </div>

    </div>
</div>
<!-- END: Content-->

<div class="footer">
    <?php
    include 'footer.php';
    ?>
</div>
<!-- END: Footer-->


<!-- START: Back to top-->
<a href="#" class="scrollup text-center">
    <i class="icon-arrow-up"></i>
</a>
<!-- END: Back to top-->


<!-- START: Template JS-->
<script src="<?php echo base_url(); ?>dist/vendors/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
<!-- END: Template JS-->

<!-- START: APP JS-->
<script src="<?php echo base_url(); ?>dist/js/app.js"></script>
<!-- END: APP JS-->

<!-- START: Page Vendor JS-->
<script src="<?php echo base_url(); ?>dist/vendors/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/morris/morris.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/chartjs/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/starrr/starrr.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/chartjs/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/apexcharts/apexcharts.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- START: Page JS-->
<script src="<?php echo base_url(); ?>dist/js/home.script.js"></script>

<!-- END: Template JS-->
</body>
<!-- END: Body-->
</html>
<script>

    function isNumberKey(txt, evt) {/*Number validation*/
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46) {
            //Check if the text already contains the . character
            if (txt.value.indexOf('.') === -1) {
                return true;
            } else {
                return false;
            }
        } else {
            if (charCode > 31 &&
                (charCode < 48 || charCode > 57))
                return false;
        }
        return true;
    }
</script>