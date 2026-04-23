<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php
    $banner = $this->db->where('banner_id', '1')->get('company')->row();
    $title = $this->db->where('banner_id', '1')->get('company')->row();
    ?>
    <title><?php echo $banner->title ?></title>
    <link rel="icon" type="image/x-icon"
          href="<?php echo base_url() ?>assets/uploads/banner/<?php echo $title->favicon ?>"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/flags-icon/css/flag-icon.min.css">
    <!-- END Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/datatable/css/dataTables.bootstrap4.min.css"/>
    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/chartjs/Chart.min.css">
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

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/flags-icon/css/flag-icon.min.css">

    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/vendors/datatable/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>select2/css/select2.min.css">
    <!-- END: Custom CSS-->

    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->
<body id="main-container" class="default">

<!-- START: Header-->
<div id="header-fix" class="header fixed-top" >
    <div class="site-width">
        <nav class="navbar navbar-expand-lg  p-0" style="background-color: #EB6709">
            <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
            </div>
            <div class="navbar-right ml-auto h-100">
                <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                    <li class="d-inline-block align-self-center  d-block d-lg-none">
                        <a href="#" class="nav-link mobilesearch" data-toggle="dropdown" aria-expanded="false"><i
                                    class="icon-magnifier h4"></i>
                        </a>
                    </li>
                    <li>
                        <select onchange="language_change(this.value)" name="language_change" id="language_change">
                            <option value="" disabled selected>Change Language</option>
                            <option value="arabic">Arabic</option>
                            <option value="english">English</option>
                        </select>
                    </li>

                    <li class="dropdown user-profile align-self-center d-inline-block">
                        <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
                            <div class="media">
                                <?php
                                $language = $this->session->userdata('language');
                                $user = $this->db->where('id', $this->session->userdata('id'))->get('user')->row();
                                $hotel = $this->db->where('hotel_id', $this->session->userdata('hotel_id'))->get('hotel')->row();
                                if ($language == 'english') {
                                    ?>
                                    <p>User:<b><?php echo $user->user_name ?></b></p>
                                    <p>Hotel:<b><?php echo $hotel->hotel_name_in_english ?></b></p>
                                    <?php
                                } else {
                                    ?>
                                    <p>User:<b><?php echo $user->user_name ?></b></p><br>
                                    <p>Hotel:<b><?php echo $hotel->hotel_name_in_arabic ?></b></p>
                                    <?php

                                }

                                if ($user->picture == '') {
                                    ?>
                                    <img src="<?php echo base_url() ?>assets/uploads/users/image_icon.png" alt=""
                                         class="d-flex img-fluid rounded-circle"
                                         width="29">
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() ?>assets/uploads/users/<?php echo $user->picture ?>"
                                         alt="" class="d-flex img-fluid rounded-circle"
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
<div class="sidebar bg-primary">
    <?php
    include 'backend/left_nav.php';
    ?>
</div>
<!-- END: Main Menu-->

<!-- START: Main Content-->
<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 col-lg-12  mt-3" style="min-height: 800px;">
                <?php

                echo $output_content;

                ?>
            </div>


        </div>
        <!-- END: Card DATA-->
    </div>
</main>
<!-- END: Content-->
<!-- START: Footer-->


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
<script src="<?php echo base_url(); ?>dist/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>

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
<script src="<?php echo base_url(); ?>dist/js/datatable.script.js"></script>
<!-- END: Back to top-->

<!-- START: Page Vendor JS-->
<script src="<?php echo base_url(); ?>dist/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/jszip/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- START: Page Script JS-->
<script src="<?php echo base_url(); ?>dist/js/datatable.script.js"></script>
<script src="<?php echo base_url(); ?>select2/js/select2.js"></script>
<script src="<?php echo base_url(); ?>select2/js/select2.min.js"></script>
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

    function renewSubTotalCalculate() {
        var grand = 0;
        var idControl = $('#idControl').val()
        for (var i = 1; i <= idControl; i++) {
            var rent = $('#rent_' + i).val();
            //alert(i);
            if (!isNaN(rent)) {
                grand += Number(rent);
            }
        }
        $('#grandRent').val(grand);
    }

    function subTotalCalculate() {
        var grand = 0;
        var idControl = $('#idControl').val()
        for (var i = 1; i <= idControl; i++) {
            var rent = $('#rent_' + i).val();
            //alert(i);
            if (!isNaN(rent)) {
                grand += Number(rent);
            }
        }
        $('#grandRent').val(grand);
    }

    $(document).ready(function () {
        $('#language_change').select2();
        $('#guest_unique_id_view').select2();
        $('#country_id').select2();
        $('#hotel_id').select2();
        $('#room_id').select2();
        $('#country_id_all').select2();
        $('#day_or_month_or_year_2').select2();
        $('#day_or_month_or_year_1').select2();
        $('#day_or_month_or_year_3').select2();
        $('#roomnumberid_2').select2();
        $('#roomnumberid_1').select2();
        $('#roomnumberid_3').select2();
        $('#cash_or_credit_1').select2();
        $('#cash_or_credit_2').select2();
        $('#cash_or_credit_3').select2();
        $('#cash_or_credit_4').select2();
        $('#cash_or_credit_5').select2();
    });

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

<script type="text/javascript">
    $(document).ready(function (e) {
        $('#image_1').on('change', function () {
            $('#img').show();
            $('#submit_button').attr('disabled', 'disabled');
            var file_data = $('#image_1').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '<?php echo base_url()?>file_upload', // point to server-side controller method
                dataType: 'text', // what to expect back from the server
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    $('#image_1_name').val(response); // display success response from the server
                    $('#img').hide();
                    $('#submit_button').removeAttr('disabled');
                },
            });
        });
        $('#image_2').on('change', function () {
            $('#img').show();
            $('#submit_button').attr('disabled', 'disabled');
            var file_data = $('#image_2').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '<?php echo base_url()?>file_upload', // point to server-side controller method
                dataType: 'text', // what to expect back from the server
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    $('#image_2_name').val(response); // display success response from the server
                    $('#img').hide();
                    $('#submit_button').removeAttr('disabled');
                }
            });
        });
        $('#image_3').on('change', function () {
            $('#img').show();
            $('#submit_button').attr('disabled', 'disabled');
            var file_data = $('#image_3').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '<?php echo base_url()?>file_upload', // point to server-side controller method
                dataType: 'text', // what to expect back from the server
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    $('#image_3_name').val(response); // display success response from the server
                    $('#img').hide();
                    $('#submit_button').removeAttr('disabled');
                }
            });
        });
    });
</script>
<script>
    function language_change(languageData) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                window.location.reload();
            }
        }
        //                    alert(xhttp.responseText);
        xhttp.open("POST", "<?php echo site_url('CheckinController/language_change'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("languageData=" + languageData);
    }
    function room_load(hotel_id) {
        $('#img_loader').show();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('room_id').innerHTML = xhttp.responseText;
                $('#img_loader').hide();
            }
        }
        //                    alert(xhttp.responseText);
        xhttp.open("POST", "<?php echo site_url('CheckinController/room_load'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("hotel_id=" + hotel_id);
    }

    function infoLoad(guest_unique_id) {

        $('#img').show();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {

                var data = (xhttp.responseText).split('*');
                if (data[0] != '') {
                    $('#guest_name').val(data[0]);
                }
                if (data[1] != '') {
                    $('#place').val(data[1]);
                }
                if (data[2] != '') {
                    $('#mobile').val(data[2]);
                }
                if (data[3] != '') {
                    $('#guest_type').val(data[3]);
                }
                if (data[4] != '') {
                    $('.date_of_birth').val(data[4]);
                }
                if (data[5] != '') {
                    $('#profession_id').val(data[5]);
                }


                $('#img').hide();
            }
            country_load(guest_unique_id);
        }
        //                    alert(xhttp.responseText);
        xhttp.open("POST", "<?php echo site_url('CheckinController/infoLoad'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("guest_unique_id=" + guest_unique_id);
    }

    function country_load(guest_unique_id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('country_id_all').innerHTML = xhttp.responseText;
            }
        }
        //                    alert(xhttp.responseText);
        xhttp.open("POST", "<?php echo site_url('CheckinController/country_load'); ?>", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //            xhttp.send("fname=Henry&lname=Ford");
        xhttp.send("guest_unique_id=" + guest_unique_id);
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datepicker').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker1').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker2').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker3').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker4').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker5').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker6').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker7').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker8').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker9').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#datepicker10').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#dateOfEntry_1').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#dateOfEntry_2').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#dateOfEntry_3').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#dateOfEntry_4').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#dateOfEntry_5').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });

        $('#dateOfExit_1').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#dateOfExit_2').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#dateOfExit_3').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#dateOfExit_4').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#dateOfExit_5').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });

        $('#from_date').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });
        $('#to_date').datepicker({
            "changeMonth": true,
            "changeYear": true,
            "dateFormat": "dd-mm-yy",
            "yearRange": '1995:2030'
        });

    });

</script>

<script type="text/javascript">


    var view_check_in_day_container = $('#view_check_in_day_container').html();
    if (view_check_in_day_container != '') {
       // $('#img').show();
        $.ajax({
            url: '<?php echo base_url()?>view_check_in_day_ajax', // point to server-side controller method
            dataType: 'text', // what to expect back from the server
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            success: function (response) {
                $('#view_check_in_day_container').html(response); // display success response from the server
                $('#img').hide();
            },
        });
    }
    var view_check_in_month_container = $('#view_check_in_month_container').html();
    if (view_check_in_month_container != '') {
       // $('#img').show();
        $.ajax({
            url: '<?php echo base_url()?>view_checkin_month_ajax', // point to server-side controller method
            dataType: 'text', // what to expect back from the server
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            success: function (response) {
                $('#view_check_in_month_container').html(response); // display success response from the server
                $('#img').hide();
            },
        });
    }
    function view_check_day_query()
    {
        var form = $('#view_checkin_day_form')[0];
        var form_data = new FormData(form);
        $('#img').show();
        $.ajax({
            url: '<?php echo base_url()?>view_check_in_day_ajax', // point to server-side controller method
            dataType: 'text', // what to expect back from the server
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                $('#view_check_in_month_container').html(response); // display success response from the server
                $('#img').hide();
            },
        });
    }
    function view_check_month_query()
    {
        var form = $('#view_checkin_month_form')[0];
        var form_data = new FormData(form);
        $('#img').show();
        $.ajax({
            url: '<?php echo base_url()?>view_checkin_month_ajax', // point to server-side controller method
            dataType: 'text', // what to expect back from the server
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                $('#view_check_in_month_container').html(response); // display success response from the server
                $('#img').hide();
            },
        });
    }
</script>