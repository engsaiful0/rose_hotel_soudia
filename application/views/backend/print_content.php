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
<body id="main-container" class="default">


<!-- END: Pre Loader-->

<!-- START: Header-->
<div id="header-fix" class="header fixed-top">
    <div class="site-width">
        <nav class="navbar navbar-expand-lg  p-0">
            <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
            </div>


            <div class="navbar-right ml-auto h-100">
                <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                    <li class="d-inline-block align-self-center  d-block d-lg-none">
                        <a href="#" class="nav-link mobilesearch" data-toggle="dropdown" aria-expanded="false"><i class="icon-magnifier h4"></i>
                        </a>
                    </li>

                    <li>
                        <select onchange="language_change(this.value)" name="language_change" id="language_change">
                            <option value="arabic">Arabic</option>
                            <option value="english">English</option>
                        </select>
                    </li>
                    <li class="dropdown user-profile align-self-center d-inline-block">
                        <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
                            <div class="media">
                                <?php
                                $user=$this->db->where('id',$this->session->userdata('id'))->get('user')->row();
                                echo $user->user_name;
                                if($user->picture=='')
                                {
                                    ?>
                                    <img src="<?php echo base_url()?>assets/uploads/users/image_icon.png" alt="" class="d-flex img-fluid rounded-circle"
                                         width="29">
                                    <?php
                                }else{
                                    ?>
                                    <img src="<?php echo base_url()?>assets/uploads/users/<?php echo $user->picture ?>" alt="" class="d-flex img-fluid rounded-circle"
                                         width="29">
                                    <?php
                                }
                                ?>
                            </div>
                        </a>

                        <div class="dropdown-menu border dropdown-menu-right p-0">
                            <a href="<?php echo base_url() ?>admin/log_out"
                               class="dropdown-item px-2 text-danger align-self-center d-flex">
                                <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                        </div>

                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- END: Header-->

<!-- START: Main Menu-->
<div class="sidebar">
    <?php
    include 'left_nav.php';
    ?>
</div>
<!-- END: Main Menu-->

<!-- START: Main Content-->
<main>
    <div class="container-fluid site-width">
    <iframe src="<?php echo base_url($output_content); ?>" name="frame" style="width: 100%; min-height: 3200px; border: 0" id="main_frame"></iframe>
    </div>
</main>
<!-- END: Content-->
<!-- START: Footer-->

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
<!-- END: Page JS-->
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